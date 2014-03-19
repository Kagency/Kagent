<?php

namespace Kagency\Kagent;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\Dumper\PhpDumper;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Yaml\Parser;

/**
 * Class: App
 *
 * Main class handling module loading and building the Dependency Injection
 * Container from all those modules.
 *
 * @version $Revision$
 */
class App
{
    /**
     * Service container
     *
     * @var \Symfony\Component\DependencyInjection\ContainerBuilder
     */
    public $container;

    /**
     * Directory to cache compiled service container in
     *
     * @var string
     */
    private $cacheDir;

    /**
     * Default Directory for configuration
     *
     * @var string
     */
    private $configDir;

    /**
     * Is the App in debug mode
     *
     * @var bool
     */
    private $debug;

    /**
     * Registered application modules
     *
     * @var Module[]
     */
    private $modules;

    /**
     * @param string $configDir
     * @param string|null $cacheDir
     */
    public function __construct($configDir, $cacheDir, array $modules = array(), $debug = false)
    {
        $this->configDir = $configDir;
        $this->cacheDir = $cacheDir;
        $this->debug = $debug;

        foreach ($modules as $module) {
            $this->registerModule($module);
        }
    }

    /**
     * Register module
     *
     * @param Module $module
     * @return void
     */
    public function registerModule(Module $module)
    {
        $this->modules[] = $module;
        $module->initialize($this);
    }

    /**
     * Get service container
     *
     * @return \Symfony\Component\DependencyInjection\ContainerBuilder
     */
    public function getContainer()
    {
        if ($this->container === null) {
            $this->initializeContainer();
        }

        return $this->container;
    }

    /**
     * Initialize container
     *
     * Creates a cache, which is only used in non-debug mode.
     *
     * @TODO: Load service defintions from modules
     *
     * @return void
     */
    private function initializeContainer()
    {
        $cachefile = $this->cacheDir . '/services.php';

        if (!$this->debug && file_exists($cachefile)) {
            require_once $cachefile;
            $this->container = new \ProjectServiceContainer();
            return;
        }

        $this->container = new ContainerBuilder();
        foreach ($this->getConfiguration() as $key => $value) {
            $this->container->setParameter($key, $value);
        }

        $loader = new XmlFileLoader($this->container, new FileLocator($this->configDir));
        $loader->load('services.xml');

        $this->container->compile();

        if (!file_exists($this->cacheDir)) {
            mkDir($this->cacheDir, 0777, true);
        }

        $dumper = new PhpDumper($this->container);
        file_put_contents($cachefile, $dumper->dump());
    }

    /**
     * Get application configuration
     *
     * @TODO: Load configuration from modules
     *
     * @return array
     */
    public function getConfiguration()
    {
        $yamlParser = new Parser();

        $files = array(
            $this->configDir . '/config.yml',
        );

        foreach ($files as $file) {
            if (file_exists($file)) {
                return $yamlParser->parse(file_get_contents($file));
            }
        }

        return array();
    }
}
