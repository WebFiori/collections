<?php
/**
 * This file is licensed under MIT License.
 *
 * Copyright (c) 2020 Ibrahim BinAlshikh
 *
 * For more information on the license, please visit:
 * https://github.com/WebFiori/.github/blob/main/LICENSE
 *
 */
namespace webfiori\collections;

use Countable;
/**
 * A base class that can be used to create different collections.
 *
 * @author Ibrahim
 * @version 1.0
 */
abstract class AbstractCollection implements Countable {
    /**
     * Returns a string that represents the collection and its element.
     * 
     * @return string A string that represents the collection and its element.
     */
    public function __toString() {
        $retVal = get_class($this)."[\n";
        $elementsArr = $this->toArray();
        $comma = ',';
        $elsCount = count($elementsArr);

        for ($x = 0 ; $x < $elsCount ; $x++) {
            $data = $elementsArr[$x];
            $dataType = gettype($data);

            if ($x + 1 == $elsCount) {
                $comma = '';
            }

            if ($dataType == 'object' || $dataType == 'array') {
                $retVal .= '    ['.$x.']=>('.$dataType.")$comma\n";
            } else {
                $retVal .= '    ['.$x.']=>'.$data.'('.$dataType.")$comma\n";
            }
        }

        return $retVal.']';
    }
    /**
     * Adds new element to the collection.
     * 
     * @param mixed $el The element that will be added. It can be of any type. Note 
     * that the value is passed by reference.
     * 
     * @return bool The method should be implemented in a way that it returns
     * true if the element is added and returns false otherwise.
     * 
     * @since 1.0
     */
    public abstract function add(&$el);
    /**
     * Returns the number of elements in the collection.
     * 
     * This one is similar to calling the method "AbstractCollection::<a href="#size">size()</a>".
     * 
     * @return int Number of elements in the collection.
     * 
     * @since 1.0
     */
    public function count() : int {
        return $this->size();
    }
    /**
     * Returns the number of elements in the collection.
     * 
     * @return int The number of elements in the collection.
     * 
     * @since 1.0
     */
    public abstract function size() : int ;
    /**
     * Returns an array that contains the elements of the collection.
     * 
     * @return array An array that contains the elements of the collection.
     * 
     * @since 1.0
     */
    public abstract function toArray() : array;
}
