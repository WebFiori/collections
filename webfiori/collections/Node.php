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
 * A singly linked node that can be used to construct different data structures.
 * 
 * It is somehow the core class of this library.
 * 
 * @author Ibrahim
 * 
 * @version 1.1
 */
class Node {
    /**
     * The data that the node is holding.
     * 
     * @var mixed
     * 
     * @since 1.0 
     */
    private $data;
    /**
     * The next node.
     * 
     * @var Node
     * 
     * @since 1.0 
     */
    private $next;
    /**
     * Constructs a new node with specific data and next node.
     * 
     * Note that the method will only accept references.
     * 
     * @param mixed $data The data that the node will hold.
     * 
     * @param Node $next The next node. If null is given or the given 
     * value is not an instance of Node, the next node will be set to 
     * null.
     * 
     * @since 1.0
     */
    public function __construct(mixed &$data, ?Node &$next) {
        $this->setData($data);
        $this->setNext($next);
    }
    /**
     * Returns the data that is stored in the node.
     * 
     * @return mixed The data that is stored in the node.
     * 
     * @since 1.0
     */
    public function &data() {
        return $this->data;
    }
    /**
     * Returns a reference to the next linked node. 
     * 
     * @return null|Node If no linked node is set, null is returned. Else, 
     * an instance of Node is returned.
     * 
     * @since 1.0
     */
    public function &next() : ?Node {
        return $this->next;
    }
    /**
     * Sets the data that the node will hold.
     * 
     * Note that the method will only accept a reference to the data.
     * 
     * @param mixed $data A reference to the data that the node will hold.
     * 
     * @since 1.0
     */
    public function setData(mixed &$data) {
        $this->data = $data;
    }
    /**
     * Sets the reference to the next linked node.
     * 
     * Note that the method can only accept a reference to the next node.
     * 
     * @param Node $next The next node. If null is given, the next node 
     * will be set to null. If the given value is not an instance of Node, 
     * it will be not set.
     * 
     * @since 1.0
     */
    public function setNext(?Node &$next) {
        if ($next instanceof Node) {
            $this->next = $next;
        } else if ($next === null) {
            $this->next = null;
        }
    }
}
