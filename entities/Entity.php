<?php
/**
 *  Entity.php
 * 
 *  Base class for entities
 */

/**
 *  Class definition
 */
abstract class Entity extends SqlFramework\Entity
{
    /**
     *  The backend 
     *  @var Backend
     */
    protected $backend;

    /**
     *  Get the backend
     *  @return Backend
     */
    public function backend(): Backend
    {
        // Expose member
        return $this->backend;
    }

    /**
     *  Set the backend
     *  @param  Backend
     *  @return Entity
     */
    public function setBackend(Backend $backend): Entity
    {
        // Set backend
        $this->backend = $backend;

        // Allow chaining
        return $this;
    }
}