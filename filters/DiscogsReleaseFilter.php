<?php
/**
 *  DiscogsReleaseFilter.php
 * 
 *  Filter for releases
 */

/**
 *  Class defintion
 */
class DiscogsReleaseFilter extends Filter
{
    /**
     *  Set the URL
     *  @param  string 
     *  @return DiscogsReleaseFilter
     */
    public function setUrl(string $url): DiscogsReleaseFilter
    {
        // Set parameter
        $this->addCondition('url = ?', array($url));

        // Allow chaining
        return $this;
    }

    /**
     *  Set the quality
     *  @param  string
     *  @return DiscogsReleaseFilter
     */
    public function setQuality(string $quality = 'Correct'): DiscogsRelease
    {
        // Set the parameter
        $this->addCondition('quality like "%?%"', array($quality));

        // Allow chaining
        return $this;
    }

    /**
     *  Set the work that releases have been tagged for
     *  @param  Work
     *  @return DiscogsReleaseFilter
     */
    public function taggedForWork(Work $work): DiscogsReleaseFilter
    {
        // Set subquery
        $this->limitIDs("select fk_release from WorkTracks where fk_work = {$work->ID()} and trackrange <> 'SKIP'");

        // Allow chaining
        return $this;
    }

    /**
     *  Set if this release is tagged for any work
     *  @return DiscogsReleaseFilter
     */
    public function taggedForAnyWork(): DiscogsReleaseFilter
    {
        // Set subquery
        $this->limitIDs("select distinct fk_release from WorkTracks where trackrange <> 'SKIP'");

        // Allow chaining
        return $this;
    }
}