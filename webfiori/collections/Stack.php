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
 * A class that represents a stack data structure.
 *
 * @author Ibrahim
 * @version 1.1.2
 */
class Stack extends AbstractCollection {
    /**
     * The bottom node of the stack.
     * @var Node
     * @since 1.0 
     */
    private $head;
    /**
     * The maximum number of elements the stack can hold.
     * @var int
     * @since 1.0 
     */
    private $max;
    /**
     * A null guard for the methods that return null reference.
     * @since 1.1
     */
    private $null;
    /**
     * The number of elements in the stack.
     * @var Node
     * @since 1.0 
     */
    private $size;
    /**
     * The top node of the stack.
     * @var Node
     * @since 1.0 
     */
    private $tail;
    /**
     * Constructs a new instance of the class.
     * 
     * @param int $max The maximum number of elements the stack can hold. 
     * if a negative number is given or 0, the stack will have unlimited number 
     * of elements. Also, if the given value is not an integer, the maximum will be set
     * to unlimited. Default is 0.
     */
    public function __construct(int $max = 0) {
        $this->null = null;
        $this->head = null;
        $this->tail = null;
        $this->size = 0;

        if (gettype($max) == 'integer') {
            $this->max = $max;
        } else {
            $this->max = 0;
        }
    }
    /**
     * Returns the element that exist on the top of the stack.
     * 
     * This method will return the last element that was added to the stack.
     * 
     * @return mixed The element at the top. If the stack is empty, the method 
     * will return null.
     * 
     * @since 1.0
     */
    public function &peek() {
        if ($this->size() == 1) {
            return $this->head->data();
        } else if ($this->size() > 1) {
            return $this->tail->data();
        } else {
            return $this->null;
        }
    }
    /**
     * Removes an element from the top of the stack.
     * 
     * The method will remove the last element that was added to the stack.
     * 
     * @return mixed The element after removal from the stack. If the stack is 
     * empty, the method will return null.
     * 
     * @since 1.0
     */
    public function &pop() {
        if ($this->size() == 0) {
            return $this->null;
        } else if ($this->size() == 1) {
            $data = $this->head->data();
            $this->head = null;
            $this->tail = null;
            $this->size--;

            return $data;
        } else {
            $node = $this->head;
            $nextNode = $this->head->next();

            while ($nextNode->next() !== null) {
                $node = $nextNode;
                $nextNode = $nextNode->next();
            }
            $data = $nextNode->data();
            $node->setNext($this->null);
            $this->tail = $node;
            $this->size--;

            return $data;
        }
    }
    /**
     * Returns the number of maximum elements the stack can hold.
     * 
     * @return int If the maximum number of elements was set to 0 or a 
     * negative number, the method will return -1 which indicates that 
     * the stack can have infinite number of elements. Other than that, 
     * the method will return the maximum number of elements.
     * 
     * @since 1.0
     */
    public function max() : int {
        if ($this->max <= 0) {
            return -1;
        }

        return $this->max;
    }
    /**
     * Adds new element to the top of the stack.
     * 
     * @param mixed $el The element that will be added. If it is null, the 
     * method will not add it.
     * 
     * @return bool The method will return true if the element is added.
     * The method will return false only in two cases, If the maximum 
     * number of elements is reached and trying to add new one or the given element 
     * is null.
     * 
     * @since 1.0
     */
    public function add(&$el) : bool {
        return $this->push($el);
    }
    /**
     * Adds new element to the top of the stack.
     * 
     * @param mixed $el The element that will be added. If it is null, the 
     * method will not add it.
     * 
     * @return bool The method will return true if the element is added.
     * The method will return false only in two cases, If the maximum 
     * number of elements is reached and trying to add new one or the given element 
     * is null.
     * 
     * @since 1.0
     */
    public function push($el) : bool {
        if ($el !== null && $this->validateSize()) {
            if ($this->size() == 0) {
                $this->head = new Node($el);
                $this->size++;

                return true;
            } else if ($this->size() == 1) {
                $this->tail = new Node($el);
                $this->head->setNext($this->tail);
                $this->size++;

                return true;
            } else {
                $node = $this->tail;
                $this->tail = new Node($el);
                $node->setNext($this->tail);
                $this->size++;

                return true;
            }
        }

        return false;
    }

    /**
     * Returns the number of elements in the stack.
     * 
     * @return int The number of elements in the stack.
     * 
     * @since 1.0
     */
    public function size() : int {
        return $this->size;
    }

    /**
     * Returns an indexed array that contains the elements of the stack.
     * 
     * @return array An indexed array that contains the elements of the stack.
     * 
     * @since 1.1.2
     */
    public function toArray() : array {
        $elsArray = [];

        if ($this->size() == 1) {
            $elsArray[] = $this->head->data();
        } else {
            if ($this->size() != 0) {
                $node = $this->head;

                while ($node->next() !== null) {
                    $elsArray[] = $node->data();
                    $node = $node->next();
                }
                $elsArray[] = $node->data();
            }
        }

        return $elsArray;
    }
    /**
     * Checks if the stack can hold more elements or not.
     * 
     * @return bool true if the stack can hold more elements.
     * 
     * @since 1.0
     */
    private function validateSize() : bool {
        $maxSize = $this->max();

        if ($maxSize == -1) {
            return true;
        }

        if ($maxSize > $this->size()) {
            return true;
        }

        return false;
    }
}
