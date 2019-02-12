<?php
/**
 *  TrackFilter.php
 */

/**
 *  Class defintion
 */
class TrackFilter extends Filter
{
    /**
     *  Set the release
     *  @param  DiscogsRelease
     *  @return TrackFilter
     */
    public function setRelease(DiscogsRelease $release): TrackFilter
    {
        // Set parameter
        $this->addCondition('fk_release = ?', array($release->ID()));

        // Allow chaining
        return $this;
    }

    /**
     *  Set the index
     *  @param  int
     *  @return TrackFilter
     */
    public function setIndex(int $index): TrackFilter
    {
        // Set parameter
        $this->addCondition('position = ?', array($index));

        // Allow chaining
        return $this;
    }
}