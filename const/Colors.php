<?php
/**
 *  Colors.php
 *  
 *  Class to map a certain value to a color
 *  
 */

/**
 *  Class definition 
 */
class Colors
{
    /**
     *  Set of pre-defined colors
     */
    private $colors = array(
        '#C0C0C0',     // Silver
        '#000000',     // Black
        '#FF0000',     // Red
        '#800000',     // Maroon
        '#FFFF00',     // Yellow
        '#808000',     // Olive
        '#00FF00',     // Lime
        '#008000',     // Green
        '#00FFFF',     // Aqua
        '#008080',     // Teal
        '#0000FF',     // Blue
        '#000080',     // Navy
        '#FF00FF',     // Fuchsia
        '#800080',     // Purple
        // '#808080',     // Gray
    );

    /**
     *  The values that we're mapping
     *  @param array
     */
    private $values = array();

    /**
     *  Constructor
     *  @param  array       the values that need to be mapped to colors
     */
    public function __construct(array $values = array())
    {
        // Store values
        $this->values = $values;
    }

    /**
     *  Map an item to a color
     *  @param  string      the item
     *  @param  boolean     should we append the item if not seen before?
     *  @return string | null
     */
    public function map(string $item, bool $append = true): ?string
    {
        // Do we know the item?
        if (in_array($item, $this->values)) return $this->colors[array_search($item, $this->values) % count($this->colors)];

        // Should we insert it?
        if (!$append) return null;

        // Add item
        $this->values[] = $item;

        // Return value
        return $this->colors[array_search($item, $this->values) % count($this->colors)];
    }
}