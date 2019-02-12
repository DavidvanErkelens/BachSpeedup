<?php
/**
 *  Collection.php
 * 
 *  Base class for all collections
 */

/**
 *  Class definition
 */
abstract class Collection extends SqlFramework\Collection implements Countable
{
    /**
     *  Set the backend for this collection
     *  @param  Backend
     *  @return Collection
     */
    public function setBackend(Backend $backend): Collection
    {
        // Set backend
        foreach ($this as $item) $item->setBackend($backend);

        // Allow chaining
        return $this;
    }

    /**
     *  Count values
     *  @return int
     */
    public function count(): int
    {
        // return number of items
        return count($this->items);
    }
}