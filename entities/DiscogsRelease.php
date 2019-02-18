<?php
/**
 *  DiscogsRelease.php
 * 
 *  Class that contains one release
 */

/**
 *  Class definition
 */
class DiscogsRelease extends Entity
{
    /**
     *  Get the title of this release
     *  @return string
     */
    public function title(): string
    {
        // expose member
        return $this->row->title;
    }

    /**
     *  Get the year of the release
     *  @return int
     */
    public function year(): int
    {
        // expose member
        return $this->row->year;
    }

    /**
     *  Add a track to this release
     *  @param  string      the duration
     *  @param  string      the position
     *  @param  string      the type of track
     *  @param  string      the title of the track 
     *  @return Track
     */
    public function addTrack(string $dur, string $pos, string $type, string $title): Track
    {
        // Create entity
        $entity = $this->backend()->sql()->create('Track', array(
            'fk_release'    =>      $this->ID(),
            'duration'      =>      $dur,
            'position'      =>      $pos,
            'type'          =>      $type,
            'title'         =>      $title
        ));

        // Set backend
        $entity->setBackend($this->backend());

        // Done
        return $entity;
    }

    /**
     *  Add an artist to this release
     *  @param  string      the name   
     *  @param  int         the discogs release
     *  @return Artist
     */
    public function addArtist(string $name, int $id): Artist
    {
        // Get artist object
        $artist = $this->getArtist($name, $id);

        // Create link
        $this->backend()->sql()->create('ReleaseArtist', array(
            'fk_release'        =>  $this->ID(),
            'fk_artist'         =>  $artist->ID()
        ));

        // Return artist object
        return $artist;
    }

    /**
     *  Get an artist object for a name and ID
     *  @param  string      the name   
     *  @param  int         the discogs release
     *  @return Artist
     */
    private function getArtist(string $name, int $id): Artist
    {
        // Create filter
        $filter = new ArtistFilter();

        // Set property
        $filter->setDiscogsID($id);

        // Get collection
        $collection = $this->backend()->sql()->getCollection('Artist', $filter);

        // Loop over result
        foreach ($collection as $item) return $item->setBackend($this->backend());

        // Create new entry
        $entity = $this->backend()->sql()->create('Artist', array(
            'name'  =>  $name,
            'discogs_id'    =>  $id
        ));

        // Set backend
        $entity->setBackend($this->backend());

        // Return entity
        return $entity;
    }

    /**
     *  Get a track by position
     *  @param  int | string
     *  @return Track | null
     */
    public function trackByPosition($pos): ?Track
    {
        // Create track filter
        $filter = new TrackFilter();

        // Set properties
        $filter->setIndex($pos)->setRelease($this);

        // Loop over results
        foreach ($this->backend()->tracks($filter) as $t) return $t;

        // Noting found
        return null;
    }

    /**
     *  Get a track by index (0-indexed, of course)
     *  @param  int
     *  @return Track | null
     */
    public function trackByID(int $id): ?Track
    {
        // Create track filter
        $filter = new TrackFilter();

        // Set properties
        $filter->setRelease($this);

        // Loop over results
        foreach ($this->backend()->tracks($filter) as $i => $t) if ($i == $id) return $t;

        // Noting found
        return null;
    }

    /**
     *  Get all tracks in this release
     *  @return TrackCollection
     */
    public function tracks(): TrackCollection
    {
        // Create track filter
        $filter = new TrackFilter();

        // Set properties
        $filter->setRelease($this);

        // Return
        return $this->backend()->tracks($filter);
    }
}