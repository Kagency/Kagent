<?php

namespace Kagency\Kagent;

/**
 * Class: Module
 *
 * This is a base class for modules. It exposes all relevant classes of a
 * module.
 *
 * By default the module does nothing. Methods should be overwritten, as
 * required, to return the respective implementations the module can provide.
 *
 * @TODO: Split up optional module methods into dedicated interfaces? Or just
 * use DIC tags to discover the respective entities?
 *
 * @version $Revision$
 */
abstract class Module
{
    /**
     * Initialize module
     *
     * @param App $app
     * @return void
     */
    public function initialize(App $app)
    {
        foreach ($this->getEventSources() as $name => $eventSource) {
            $app->getContainer()->get('kagency.kagent.factory.event_source')->registerEventSource($name, $eventSource);
        }

        foreach ($this->getAgents() as $agent) {
            $app->getContainer()->get('kagency.kagent.agent_dispatcher')->addAgent($agent);
        }

        // @TODO: Register module services
        // @TODO: Register module configuration
        // @TODO: Register module assets
    }

    /**
     * Get event sources
     *
     * @return EventSource[]
     */
    public function getEventSources()
    {
        return array();
    }

    /**
     * Get data providers
     *
     * @return DataProvider[]
     */
    public function getDataProviders()
    {
        return array();
    }

    /**
     * Get annotaters
     *
     * @return Annotater[]
     */
    public function getAnnotaters()
    {
        return array();
    }

    /**
     * Get filters
     *
     * @return Filter[]
     */
    public function getFilters()
    {
        return array();
    }

    /**
     * Get agents
     *
     * @return Agent[]
     */
    public function getAgents()
    {
        return array();
    }
}
