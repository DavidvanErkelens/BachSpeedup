<?php
/**
 *  Backend.php
 * 
 *  Class that contains the backend
 */

/**
 *  Class definition
 */
class Backend
{
    /**
     *  The framework for running SQL queries
     *  @var SqlFramework
     */
    private $sql;

    /**
     *  Constructor
     *  @param SqlFramework\ConnectionSettings
     */
    public function __construct(SqlFramework\ConnectionSettings $settings)
    {
        // Create SQL framework
        $this->sql = new SqlFramework\SqlFramework($settings, __DIR__ . '/tables');
    }

    /**
     *  Expose the data model
     *  @return SqlFramework
     */
    public function sql(): SqlFramework\SqlFramework
    {
        return $this->sql;
    }

    /**
     *  Create a release
     *  @param  array       the parameters for this release
     *  @return DiscogsRelease
     */
    public function createRelease(array $params): DiscogsRelease
    {
        // Create entity
        $entity = $this->sql()->create('DiscogsRelease', $params);

        // Set the backend
        $entity->setBackend($this);

        // Return entity
        return $entity;
    }

    /**
     *  Get a work by ID
     *  @param  int
     *  @return Work
     */
    public function work(int $id): ?Work
    {
        // Get entity
        if (!$work = $this->sql()->getEntity('Work', $id)) return null;

        // Set backend
        $work->setBackend($this);

        // Return
        return $work;
    }

    /**
     *  Get a release by ID
     *  @param  int
     *  @return DiscogsRelease
     */
    public function release(int $id): ?DiscogsRelease
    {
        // Get entity
        if (!$release = $this->sql()->getEntity('DiscogsRelease', $id)) return null;

        // Set backend
        $release->setBackend($this);

        // Return
        return $release;
    }


    /**
     *  Get worktracks entry by id (should not be used - testing purposes)
     *  @param  int
     *  @return WorkTracks
     */
    public function worktrack(int $id): ?WorkTracks
    {
        // Get entity
        if (!$worktracks = $this->sql()->getEntity('WorkTracks', $id)) return null;

        // Set backend
        $worktracks->setBackend($this);

        // Return
        return $worktracks;
    }

    /**
     *  Get worktracks collection for a work
     *  @param  WorkTracksFilter
     *  @return WorkTracksCollection
     */
    public function worktracks(WorkTracksFilter $filter = null): WorkTracksCollection
    {
        // Pass on to sql
        return $this->sql()->getCollection('WorkTracks', $filter)->setBackend($this);
    }
    
    /**
     *  Get tracks 
     *  @param  TrackFilter
     *  @return TrackCollection
     */
    public function tracks(TrackFilter $filter = null): TrackCollection
    {
        // Pass on to sql
        return $this->sql()->getCollection('Track', $filter)->setBackend($this);
    }

    /**
     *  Get track entry by id
     *  @param  int
     *  @return Track
     */
    public function track(int $id): ?Track
    {
        // Get entity
        if (!$track = $this->sql()->getEntity('Track', $id)) return null;

        // Set backend
        $track->setBackend($this);

        // Return
        return $track;
    }
}
