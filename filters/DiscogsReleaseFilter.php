<?php
/**
 *  DiscogsReleaseFilter.php
 * 
 *  Filter for releases
 */

/**
 *  Class defintion
 */
class DiscogsReleaseFilter extends Filter
{
    /**
     *  Set the URL
     *  @param  string 
     *  @return DiscogsReleaseFilter
     */
    public function setUrl(string $url): DiscogsReleaseFilter
    {
        // Set parameter
        $this->addCondition('url = ?', array($url));

        // Allow chaining
        return $this;
    }
}