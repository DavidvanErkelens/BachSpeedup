<?php
/**
 *  Work.php
 * 
 *  Class that describes the tracks for a release that release that contain a 
 *  certain work
 */

/**
 *  Class definition
 */
class WorkTracks extends Entity
{
    /**
     *  Get the actual trackrange (e.g. 4-6)
     *  @return  string
     */
    public function trackrange(): string
    {
        // Expose member
        return $this->row->trackrange;
    }

    /**
     *  Get the tracks (array of ints)
     *  @return array
     */
    public function trackIDs(): array
    {
        // Should we skip?
        if ($this->trackrange() == 'SKIP') return array();

        // Store result
        $result = array();

        // Split string by comma
        $parts = explode(',', $this->trackrange());

        // Loop
        foreach ($parts as $part)
        {
            // Already int?
            if (is_numeric($part)) 
            {
                // Add to result
                $result[] = intval($part);

                // Next part
                continue;
            }

            // Otherwise, it's a range
            list($start, $end) = array_map('intval', explode('-', $part));

            // Add all to result
            for ($x = $start; $x <= $end; $x++) $result[] = $x;
        }

        // Return result
        return $result;
    }

    /**
     *  Get the release associated with this entry
     *  @return DiscogsRelease | null
     */
    public function release(): ?DiscogsRelease
    {
        // Ask backend
        return $this->backend()->release($this->row->fk_release);
    }

    /**
     *  Get the total duration of this set of tracks
     *  @return float
     */
    public function duration(): float
    {
        // Store total
        $total = 0.0;

        // Get the release
        if (!$release = $this->release()) return $total;

        // Loop over tracks
        foreach ($this->trackIDs() as $track)
        {
            // Get the track entry
            if (!$track = $release->trackByID($track)) continue;

            // Add to total
            $total += $track->duration();
        }

        // Return total
        return $total;
    }

    /**
     *  Get the duration string for this set of tracks
     *  @return string
     */
    public function durationString(): string
    {
        // Get duration
        $duration = $this->duration();

        // Get the minutes
        $minutes = intval(floor($duration));

        // Get the seconds
        $seconds = intval(round(60 * ($duration - $minutes)));

        // Format
        $seconds = str_pad((string) $seconds, 2, '0', STR_PAD_LEFT);

        // Format string
        return "{$minutes}:{$seconds}";
    }

    /**
     *  Format the infobox for this entry
     *  @return  string
     */
    public function infobox(): string
    {
        // Create smarty object
        $parser = new Smarty;

        // Get the release
        $release = $this->release();

        // Assign parameters
        $parser->assign("name", $release->title());
        $parser->assign("duration", $this->durationString());
        $parser->assign("id", $release->ID());
        $parser->assign("tid", $this->ID());
        $parser->assign("year", $release->year());
        $parser->assign("country", $release->country());
        $parser->assign("format", $release->format());
        $parser->assign("quality", $release->quality());

        // Create track variable
        $tracks = array();

        // Loop over tracks
        foreach ($this->trackIDs() as $track)
        {
            // Get the track entry
            if (!$element = $release->trackByID($track)) continue;

            // Add to total
            $tracks[] = array(
                'title'     =>    $element->title(),
                'num'       =>    $track
            );
        }

        // Add to parser
        $parser->assign("tracks", $tracks);

        // Format template location
        $loc = __DIR__ . "/../static/templates/infobox.tpl";

        // Fetch it
        return $parser->fetch($loc);
    }

    /**
     *  Get the tracks used for calculation 
     *  @param  int         margin
     *  @return array
     */
    private function usedTracks($margin = 1): array
    {
        // // store in array
        // $range = array();

        // // Get the range
        // $dbrange = $this->trackIDs();

        // // Loop over items in range
        // foreach ($dbrange as $item)
        // {
        //     // Make sure item is set
        //     $range[$item] = array(
        //         'value' =>  
        //     );

        //     // Loop over range
        //     for ($x = $item - $margin; $x < $item + $margin + 1; $x ++)
        //     {
        //         // Make sure item is valid and is in array
        //         if (!in_array)
        //     }
        // }
    }
}