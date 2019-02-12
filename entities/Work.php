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
}