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

            // Only get releases that are longer than 10 mins
            if ($wtracks->duration() < 10) continue;

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
     *  Fit a line though the data points
     *  @return ???
     */
    public function fitLine()
    {
        // @see https://halfelf.org/2017/linear-regressions-php/

        // Array to store everything in
        $result = array();

        // Create filter and set work
        $filter = WorkTracksFilter::create();
        $filter->setWork($this);

        foreach ($this->backend()->worktracks($filter) as $wtracks)
        {
            // Skip?
            if ($wtracks->trackrange() == 'SKIP') continue;

            // Get release
            if (!$release = $wtracks->release()) continue;

            // Only get releases that are longer than 10 mins
            if ($wtracks->duration() < 10) continue;

            // Already seen this year?
            if (!array_key_exists($release->year(), $result)) $result[$release->year()] = array();

            // Add data
            $result[$release->year()][] = $wtracks->duration();
        }

        // Create averages
        foreach ($result as $year => $releases)
        {
            // Average for year
            $result[$year] = array_sum($releases) / count($releases);
        }

        $x = array_keys($result);
        $y = array_values($result);

        $n     = count($x);     // number of items in the array
        $x_sum = array_sum($x); // sum of all X values
        $y_sum = array_sum($y); // sum of all Y values
     
        $xx_sum = 0;
        $xy_sum = 0;
     
        for($i = 0; $i < $n; $i++) {
            $xy_sum += ( $x[$i]*$y[$i] );
            $xx_sum += ( $x[$i]*$x[$i] );
        }
     
        // Slope
        $slope = ( ( $n * $xy_sum ) - ( $x_sum * $y_sum ) ) / ( ( $n * $xx_sum ) - ( $x_sum * $x_sum ) );
     
        // calculate intercept
        $intercept = ( $y_sum - ( $slope * $x_sum ) ) / $n;
     
        return array( 
            'slope'     => $slope,
            'intercept' => $intercept,
        );
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
            // Skip?
            if ($wtracks->trackrange() == 'SKIP') continue;

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
                    foreach ($releases as $r) echo "{$r->title()} | ID: {$r->ID()}". PHP_EOL;
                    
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

    /**
     *  Create a trackrange for this work
     *  @param  DiscogsRelease
     *  @param  string              the range
     *  @return WorkTracks
     */
    public function createTrackRange(DiscogsRelease $release, string $range): WorkTracks
    {
        // Insert item
        $entity = $this->backend()->sql()->create('WorkTracks', array(
            'fk_work'       =>  $this->ID(),
            'fk_release'    =>  $release->ID(),
            'trackrange'    =>  $range
        ));

        // Set backend
        $entity->setBackend($this->backend());

        // Done
        return $entity;
    }
}