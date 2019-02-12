<?php
/**
 *  ArtistFilter.php
 * 
 *  Filter for releases
 */

/**
 *  Class defintion
 */
class ArtistFilter extends Filter
{
    /**
     *  Set the discogs ID for this artist
     *  @param  int
     *  @return ArtistFilter
     */
    public function setDiscogsID(int $id): ArtistFilter
    {
        // Set parameter
        $this->addCondition('discogs_id = ?', array($id));

        // Allow chaining
        return $this;
    }
}