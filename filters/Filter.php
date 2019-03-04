<?php
/**
 *  Filter.php
 * 
 *  Base class for filters
 */

/**
 *  Class definition
 */
abstract class Filter extends SqlFramework\Filter
{
    /**
     *  Create new filter, based on another one
     *  @param  Filter
     *  @return Filter
     */
    static public function create(Filter $filter = null): Filter
    {
        // Get the called class
        $class = get_called_class();

        // If we have no filter, create one
        if (is_null($filter)) return new $class();

        // Otherwise just return it
        return $filter;
    }

    /**
     *  Limit the IDs
     *  @param  string      the subquery
     *  @return Filter
     */
    public function limitIDs(string $subquery): Filter
    {
        // Set property
        $this->addCondition("id in ({$subquery})");

        // Allow chaining
        return $this;
    }

    /**
     *  Add a subquery
     *  @param  string
     *  @return Filter 
     */
    public function addSubquery(string $subquery): Filter
    {
        // Set property
        $this->addCondition($subquery);

        // Allow chaining
        return $this;
    }
}