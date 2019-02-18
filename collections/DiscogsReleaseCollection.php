<?php
/**
 *  DiscogsReleaseCollection.php
 * 
 *  Collection of releases in the database
 */

/**
 *  Class definition
 */
class DiscogsReleaseCollection extends Collection
{
    /**
     *  Make sure releases have at least one track with a duration
     *  @param  boolean
     *  @return DiscogsReleaseCollection
     */
    public function hasTracksWithDuration(bool $hasduration = true): DiscogsReleaseCollection
    {
        // Loop over items
        $this->items = array_filter($this->items, function ($value) use ($hasduration) {

            // Loop over tracks
            foreach ($value->tracks() as $track) if (strlen($track->duration() > 0)) return $hasduration;

            // No track with duration
            return !$hasduration;
        });

        // Allow chaining
        return $this;
    }

    /**
     *  Make sure release has a year
     *  @param  boolean
     *  @return DiscogsReleaseCollection
     */
    public function hasYear(bool $hasyear = true): DiscogsReleaseCollection
    {
        // Loop over items
        $this->items = array_filter($this->items, function($value) use ($hasyear) {

            // Check property
            if (intval($value->year()) > 0) return $hasyear;

            // Done
            return !$hasyear;
        });

        // Allow chaining
        return $this;
    }

    /**
     *  Filter releases that are already tagged for a certain work
     *  @param  Work
     *  @param  boolean
     *  @param  boolean
     *  @return DiscogsReleaseCollection
     */
    public function taggedForWork(Work $work, bool $tagged = true, bool $skip = false): DiscogsReleaseCollection
    {
        // Loop over items
        $this->items = array_filter($this->items, function($value) use ($work, $tagged, $skip) {

            // Create filter
            $filter = new WorkTracksFilter();

            // Set properties
            $filter->setWork($work)->setRelease($value);

            // Get collection
            $collection = $value->backend()->worktracks($filter);

            // Loop over collection
            foreach ($collection as $value) if($value->trackrange() != 'SKIP' || $skip) return $tagged;

            // Return inverse value
            return !$tagged;
        });

        // Allow chaining
        return $this;
    }
}