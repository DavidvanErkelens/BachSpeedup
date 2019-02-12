<?php
/**
 *  Work.php
 * 
 *  Class that contains one work (e.g. BWV 1043) 
 */

/**
 *  Class definition
 */
class Work extends Entity
{
    /**
     *  Expose the name
     *  @return string
     */
    public function name(): string
    {
        // Expose member
        return $this->row->name;
    }

    /**
     *  Format everything about this work so that it can be plotted
     *  @return array
     */
    public function plotData(): array
    {
        // Array to store everything in
        $result = array();

        // Create filter and set work
        $filter = WorkTracksFilter::create();
        $filter->setWork($this);

        foreach ($this->backend()->worktracks($filter) as $wtracks)
        {
            // Get release
            if (!$release = $wtracks->release()) continue;

            // Add data
            $result[] = array(
                $release->year(),
                $wtracks->durationString(),
                $wtracks->duration(),
                $release->title()
            );
        }

        // Return result
        return $result;
    }

    /**
     *  Find duplicates in this works (only checked indexed entries)
     *  @param  bool        print in the meanwhile
     *  @return array
     */
    public function findDuplicates(bool $print = false): array
    {
        // Array to store everything in
        $result = array();

        // Create filter and set work
        $filter = WorkTracksFilter::create();
        $filter->setWork($this);

        foreach ($this->backend()->worktracks($filter) as $wtracks)
        {
            // Get release
            if (!$release = $wtracks->release()) continue;

            // Did we already see this year?
            if (!array_key_exists($release->year(), $result)) $result[$release->year()] = array();

            // Did we already see this duration?
            if (!array_key_exists($wtracks->durationString(), $result[$release->year()])) $result[$release->year()][$wtracks->durationString()] = array();

            // Add to array
            $result[$release->year()][$wtracks->durationString()][] = $release;
        }

        // Sort results by year
        ksort($result);

        // Array to store possible duplicates
        $possibles = array();

        // Loop
        foreach ($result as $year => $durations)
        {
            // Loop 
            foreach ($durations as $duration => $releases)
            {
                // One release == no duplicate
                if (count($releases) == 1) continue;

                // Should we print this?
                if ($print)
                {
                    // Statement
                    echo "The following releases are {$duration} long and released in {$year}:" . PHP_EOL;
                    foreach ($releases as $r) echo $r->title() . PHP_EOL;
                    
                    // Extra newline
                    print PHP_EOL;
                }

                // Add to array
                $possibles[] = $releases;
            }
        }

        // Return result
        return $possibles;
    }
}