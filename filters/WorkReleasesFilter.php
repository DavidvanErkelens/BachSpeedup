<?php
/**
 *  WorkReleasesFilter.php
 */

/**
 *  Class defintion
 */
class WorkReleasesFilter extends Filter
{
    /**
     *  Set the work
     *  @param  Work
     *  @return WorkReleasesFilter
     */
    public function setWork(Work $work): WorkReleasesFilter
    {
        // Set parameter
        $this->addCondition('fk_work = ?', array($work->ID()));

        // Allow chaining
        return $this;
    }

    /**
     *  Set the release
     *  @param  DiscogsRelease
     *  @return WorkReleasesFilter
     */
    public function setRelease(DiscogsRelease $release): WorkReleasesFilter
    {
        // Set parameter
        $this->addCondition('fk_release = ?', array($release->ID()));

        // Allow chaining
        return $this;
    }
}