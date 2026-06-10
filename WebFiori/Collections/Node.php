<?php
/**
 * This file is licensed under MIT License.
 *
 * Copyright (c) 2020 WebFiori Framework
 *
 * For more information on the license, please visit:
 * https://github.com/WebFiori/.github/blob/main/LICENSE
 *
 */

namespace WebFiori\Collections;

/**
 * A linked node that can be used to construct different data structures.
 *
 * Supports both singly and doubly linked usage. The prev pointer is optional
 * and defaults to null if not set.
 *
 * @author Ibrahim
 */
class Node {
    /**
     * The data that the node is holding.
     *
     * @var mixed
     */
    private $data;
    /**
     * The next node.
     *
     * @var Node|null
     */
    private $next;
    /**
     * The previous node.
     *
     * @var Node|null
     */
    private $prev;
    /**
     * Constructs a new node with specific data and next node.
     *
     * Note that the method will only accept references.
     *
     * @param mixed $data The data that the node will hold.
     *
     * @param Node|null $next The next node. If null is given or the given
     * value is not an instance of Node, the next node will be set to
     * null.
     *
     * @param Node|null $prev The previous node. If null is given, the previous
     * node will be set to null.
     */
    public function __construct(mixed &$data, ?Node &$next, ?Node &$prev = null) {
        $this->setData($data);
        $this->setNext($next);
        $this->setPrev($prev);
    }
    /**
     * Returns the data that is stored in the node.
     *
     * @return mixed The data that is stored in the node.
     */
    public function &data() {
        return $this->data;
    }
    /**
     * Returns a reference to the next linked node.
     *
     * @return Node|null If no linked node is set, null is returned. Else,
     * an instance of Node is returned.
     */
    public function &next(): ?Node {
        return $this->next;
    }
    /**
     * Returns a reference to the previous linked node.
     *
     * @return Node|null If no linked node is set, null is returned. Else,
     * an instance of Node is returned.
     */
    public function &prev(): ?Node {
        return $this->prev;
    }
    /**
     * Sets the data that the node will hold.
     *
     * Note that the method will only accept a reference to the data.
     *
     * @param mixed $data A reference to the data that the node will hold.
     */
    public function setData(mixed &$data) {
        $this->data = $data;
    }
    /**
     * Sets the reference to the next linked node.
     *
     * Note that the method can only accept a reference to the next node.
     *
     * @param Node|null $next The next node. If null is given, the next node
     * will be set to null. If the given value is not an instance of Node,
     * it will be not set.
     */
    public function setNext(?Node &$next) {
        if ($next instanceof Node) {
            $this->next = $next;
        } else if ($next === null) {
            $this->next = null;
        }
    }
    /**
     * Sets the reference to the previous linked node.
     *
     * @param Node|null $prev The previous node. If null is given, the previous
     * node will be set to null.
     */
    public function setPrev(?Node &$prev) {
        if ($prev instanceof Node) {
            $this->prev = $prev;
        } else if ($prev === null) {
            $this->prev = null;
        }
    }
}
