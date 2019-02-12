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
}