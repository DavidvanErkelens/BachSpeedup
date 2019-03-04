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
     *  The worktracks we've fetched
     *  @var array
     */
    private $tracks = null;


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
     *  Return the search query
     *  @return string
     */
    public function query(): string
    {
        // expose member
        return $this->row->query;
    }

    /**
     *  Helper function to get the associated tracks
     */
    private function getTracks(): void
    {
        // Already set?
        if (!is_null($this->tracks)) return;

        // Store values
        $this->tracks = array();

        // Create filter and set work
        $filter = WorkTracksFilter::create();
        $filter->setWork($this)->excludeSkip();

        foreach ($this->backend()->worktracks($filter) as $wtracks)
        {
            // Get release
            if (!$release = $wtracks->release()) continue;

            // filter on quality
            // if (strpos('Correct', $release->quality()) === FALSE) continue;

            // Longer than 0 minutes?
            if ($wtracks->duration() == 0) continue;

            // Add to array
            $this->tracks[] = $wtracks;
        }
    }

    /**
     *  Format everything about this work so that it can be plotted
     *  @param  int
     *  @param  int
     *  @return array
     */
    public function plotData(int $startyear = 0, int $endyear = 2100): array
    {
        // Array to store everything in
        $result = array();

        // Create color object
        $colors = new Colors(array('Unknown'));

        // Do we have to fetch the tracks?
        if (is_null($this->tracks)) $this->getTracks();

        // Loop over tracks
        foreach ($this->tracks as $wtracks)
        {
            // Get release
            if (!$release = $wtracks->release()) continue;

            // In range?
            if ($release->year() < $startyear || $release->year() > $endyear) continue;

            // Add data
            $result[] = array(
                'year'          =>  $release->year(),
                'durationstr'   =>  $wtracks->durationString(),
                'duration'      =>  $wtracks->duration(),
                'title'         =>  $release->title(),
                'color'         =>  $colors->map($release->format()),
                'infobox'       =>  $wtracks->infobox()
            );
        }

        // Add test unit
        // $result[] = array(
        //     'year'          =>  1950,
        //     'durationstr'   =>  "10:00",
        //     'duration'      =>  10,
        //     'title'         =>  "bac",
        //     'color'         =>  $colors->map("Unknown"),
        //     'infobox'       =>  "testunit"
        // );

        // Return result
        return $result;
    }

    /**
     *  Fit a line though the data points
     *  @param  int
     *  @param  int
     *  @return array
     */
    public function fitLine(int $startyear = 0, int $endyear = 2100): array
    {
        // @see https://halfelf.org/2017/linear-regressions-php/

        // Array to store everything in
        $result = array();

        // Do we have to fetch the tracks?
        if (is_null($this->tracks)) $this->getTracks();

        // Looperdieloop
        foreach ($this->tracks as $wtracks)
        {
            // Get release
            if (!$release = $wtracks->release()) continue;

            // In range?
            if ($release->year() < $startyear || $release->year() > $endyear) continue;

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

    /**
     *  Add a downloaded release to this work
     *  @param  DiscogsRelease
     *  @return WorkReleases
     */
    public function addDownloadedRelease(DiscogsRelease $release): WorkReleases
    {
        // Insert item
        $entity = $this->backend()->sql()->create('WorkReleases', array(
            'fk_work'       =>  $this->ID(),
            'fk_release'    =>  $release->ID()
        ));

        // Set backend
        $entity->setBackend($this->backend());

        // Done
        return $entity;
    }
}