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

    /**
     *  Filter releases that were downloaded for a certain work
     *  @param  Work
     *  @param  boolean
     *  @return DiscogsReleaseCollection
     */
    public function downloadedForWork(Work $work, bool $forwork = true): DiscogsReleaseCollection
    {
        // Create filter
        $filter = new WorkReleasesFilter();

        // Set work
        $filter->setWork($work);

        // Create array
        $releases = array();

        // Backend pointer
        $backend = array_values($this->items)[0]->backend();

        // Get the downloads for this work
        if (count($this->items) > 0) foreach ($backend->sql()->getCollection('WorkReleases', $filter) as $r) 
        {
            // Backend hack
            $r->setBackend($backend);

            // Store ID
            $releases[] = $r->release()->ID();
        }

        // Loop over items
        $this->items = array_filter($this->items, function ($value) use ($forwork, $releases) {
            
            if (in_array($value->ID(), $releases)) return $forwork;
            return !$forwork;
            
        });
        
        // Allow chaining
        return $this;
    }

    /**
     *  Set the range for the releases to be included
     *  @param  int     start year
     *  @param  int     end year
     *  @return DiscogsReleaseCollection
     */
    public function range(int $start, int $end): DiscogsReleaseCollection
    {
        // Loop over items
        $this->items = array_filter($this->items, function($value) use ($start, $end) {

            // Check requirements
            return $value->year() >= $start && $value->year() <= $end;
        });

        // Allow chaining
        return $this;
    }
}