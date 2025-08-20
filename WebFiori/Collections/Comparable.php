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

/**
 * An interface that is used to compare objects. It is used by the class 
 * LinkedList's sorting method in order to compare objects.
 * 
 * @author Ibrahim
 * 
 * @version 1.0
 */
interface Comparable {
    /**
     * Compare the given instance with another object.
     * 
     * The implementation of this method should be as follows. 
     * If the two objects are equal, the method should return 0. 
     * If the current instance is greater, the method should return positive number. 
     * If the object at the parameter is greater, the method should return a negative number.
     * 
     * @param mixed $other The other variable that will be compared 
     * with.
     * 
     * @return int Negative value, 0 or positive value.
     * 
     * @since 1.0
     */
    public function compare($other) : int;
}
