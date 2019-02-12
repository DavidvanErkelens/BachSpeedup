<?php
/**
 *  Track.php
 * 
 *  Class that contains one track 
 */

/**
 *  Class definition
 */
class Track extends Entity
{
    /**
     *  Get the duration of this track, string format (e.g. 15:15)
     *  @return string
     */ 
    public function durationString(): string
    {
        // Expose member
        return $this->row->duration;
    }

    /**
     *  Get the duration in float format
     *  @return float
     */
    public function duration(): float
    {
        // Get duration string
        if (strlen($duration = $this->durationString()) == 0) return 0.0;

        // Split string
        list($minutes, $seconds) = array_map('intval', explode(':', $duration));

        // Calculate and return value
        return $minutes + ($seconds / 60.0);
    }
}