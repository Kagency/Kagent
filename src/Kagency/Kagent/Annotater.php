<?php

namespace Kagency\Kagent;

/**
 * Class: Annotater
 *
 * An annotater annotates the context of a user with additional information.
 * This can be something trivial like the current time, but also more complex
 * information like currently running events or something alike.
 *
 * @version $Revision$
 */
abstract class Annotater
{
    /**
     * Annotate user context with additional information
     *
     * @param Context $context
     * @return void
     */
    abstract public function annotateContext(Context $context);
}
