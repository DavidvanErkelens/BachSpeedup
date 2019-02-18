<?php
/**
 *  WorkTracksFilter.php
 */

/**
 *  Class defintion
 */
class WorkTracksFilter extends Filter
{
    /**
     *  Set the work
     *  @param  Work
     *  @return WorkTracksFilter
     */
    public function setWork(Work $work): WorkTracksFilter
    {
        // Set parameter
        $this->addCondition('fk_work = ?', array($work->ID()));

        // Allow chaining
        return $this;
    }

    /**
     *  Set the release
     *  @param  DiscogsRelease
     *  @return WorkTracksFilter
     */
    public function setRelease(DiscogsRelease $release): WorkTracksFilter
    {
        // Set parameter
        $this->addCondition('fk_release = ?', array($release->ID()));

        // Allow chaining
        return $this;
    }
}