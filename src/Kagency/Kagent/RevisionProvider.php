<?php

namespace Kagency\Kagent;

/**
 * Class: RevisionProvider
 *
 * Base class for revision providers, generating revisions. Those revisions
 * must *always* be incremental (strictly monoton).
 *
 * @version $Revision$
 */
abstract class RevisionProvider
{
    /**
     * Get next revision
     *
     * @return string
     */
    abstract public function next();
}
