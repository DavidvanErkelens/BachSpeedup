<?php
/**
 *  WorkReleases.php
 */

/**
 *  Class definition
 */
class WorkReleases extends Entity
{
    /**
     *  Get the release
     *  @return DiscogsRelease
     */
    public function release(): DiscogsRelease
    {
        // parse member
        return $this->backend()->sql()->getEntity('DiscogsRelease', $this->row->fk_release);
    }
}