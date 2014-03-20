<?php

namespace Kagency\Kagent\RevisionProvider;

use Kagency\Kagent\RevisionProvider;

/**
 * Class: Time
 *
 * Simple time base revision provider. May only be used in non-distributed
 * environments. Ensures only locally increasing revisions.
 *
 * Under high load this *will* generate dublicate revisions. Do NOT use in high
 * load scenarios.
 *
 * @version $Revision$
 */
class Time extends RevisionProvider
{
    /**
     * Get next revision
     *
     * @return string
     */
    public function next()
    {
        list($subSeconds, $seconds) = explode(" ", microtime(false));
        return $seconds . substr($subSeconds, 1, 9);
    }
}
