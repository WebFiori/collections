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
 * A class that represents a queue data structure.
 * 
 * The queue is implemented in a way that the first element that comes in will 
 * be the first element to come out (FIFO queue).
 * 
 * @author Ibrahim
 * 
 * @version 1.1.2
 */
class Queue extends AbstractCollection {
    /**
     * The first element in the queue.
     * @var Node
     * @since 1.0 
     */
    private $head;
    /**
     * The maximum number of elements in the queue.
     * 
     * @var int If the value is 0 or a negative number, the maximum number of 
     * in the queue will be unlimited.
     * 
     * @since 1.0 
     */
    private $max;
    /**
     * A null guard for the methods that return null reference.
     * 
     * @since 1.1
     */
    private $null;
    /**
     * The number of elements in the queue.
     * 
     * @var int
     * 
     * @since 1.0 
     */
    private $size;
    /**
     * The last queued element.
     * 
     * @var Node
     * 
     * @since 1.0 
     */
    private $tail;

    /**
     * Constructs a new instance of the class.
     *
     * @param int $max The maximum number of elements the queue can hold.
     * if a negative number is given or 0, the queue will have unlimited number
     * of elements. Also, if the given value is not an integer, the maximum will be set
     * to unlimited. Default is 0.
     *
     * @since 1.0
     */
    public function __construct(int $max = 0) {
        $this->head = null;
        $this->tail = null;
        $this->null = null;
        $this->size = 0;

        if (gettype($max) == 'integer') {
            $this->max = $max;
        } else {
            $this->max = 0;
        }
    }
    /**
     * Returns the element that exist on the top of the queue.
     * 
     * This method will return the first element that was added to the queue.
     * 
     * @return mixed The element at the top. If the queue is empty, the method 
     * will return null.
     * 
     * @since 1.0
     */
    public function &peek() {
        if ($this->size() >= 1) {
            return $this->head->data();
        } else {
            return $this->null;
        }
    }
    /**
     * Removes the top element from the queue.
     * 
     * @return mixed The element after removal from the queue. If the queue is 
     * empty, the method will return null.
     * 
     * @since 1.0
     */
    public function &dequeue() {
        if ($this->size > 1) {
            $data = $this->head->data();
            $this->head = $this->head->next();
            $this->size--;

            return $data;
        } else if ($this->size == 1) {
            $data = $this->head->data();
            $this->head = null;
            $this->tail = null;
            $this->size--;

            return $data;
        } else {
            return $this->null;
        }
    }
    /**
     * Adds new element to the bottom of the queue.
     * 
     * @param mixed $el The element that will be added. If it is null, the 
     * method will not add it.
     * 
     * @return bool The method will return true if the element is added.
     * The method will return false only in two cases, If the maximum 
     * number of elements is reached and trying to add new one or the given element 
     * is null.
     * 
     * @since 1.1.2
     */
    public function add(&$el) : bool {
        return $this->enqueue($el);
    }
    /**
     * Adds new element to the bottom of the queue.
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
    public function enqueue($el) : bool {
        if ($this->validateSize() && $el !== null) {
            if ($this->size() == 0) {
                $this->head = new Node($el, self::$NULL);
                $this->size++;

                return true;
            } else if ($this->size() == 1) {
                $this->tail = new Node($el, self::$NULL);
                $this->head->setNext($this->tail);
                $this->size++;

                return true;
            } else {
                $node = $this->head;

                while ($node->next() !== null) {
                    $node = $node->next();
                }
                $this->tail = new Node($el, self::$NULL);
                $node->setNext($this->tail);
                $this->size++;

                return true;
            }
        }

        return false;
    }
    /**
     * Returns the number of maximum elements the queue can hold.
     * 
     * @return int If the maximum number of elements was set to 0 or a 
     * negative number, the method will return -1 which indicates 
     * that the queue can have any number of elements. Other than that, 
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
     * Returns the number of elements in the queue.
     * 
     * @return int The number of elements in the queue.
     * 
     * @since 1.0
     */
    public function size() : int {
        return $this->size;
    }
    /**
     * Returns an indexed array that contains the elements of the queue.
     * 
     * @return array An indexed array that contains the elements of the queue.
     * 
     * @since 1.1.2
     */
    public function toArray() : array {
        $array = [];

        if ($this->size() == 1) {
            $array[] = $this->head->data();
        } else {
            if ($this->size() != 0) {
                $node = $this->head;

                while ($node->next() !== null) {
                    $array[] = $node->data();
                    $node = $node->next();
                }
                $array[] = $node->data();
            }
        }

        return $array;
    }
    /**
     * Checks if the queue can hold more elements or not.
     * 
     * @return bool true if the queue can hold more elements.
     * 
     * @since 1.0
     */
    private function validateSize() : bool {
        $maxEls = $this->max();

        if ($maxEls == -1) {
            return true;
        }

        if ($maxEls > $this->size()) {
            return true;
        }

        return false;
    }
}
