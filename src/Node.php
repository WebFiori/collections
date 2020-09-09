<?php
/*
 * The MIT License
 *
 * Copyright (c) 2020 Ibrahim BinAlshikh, WebFiori Collections.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
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
    public function __construct(&$data,&$next = null) {
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
    public function &next() {
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
    public function setData(&$data) {
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
    public function setNext(&$next) {
        if ($next instanceof Node) {
            $this->next = $next;
        } else if ($next == null) {
            $this->next = null;
        }
    }
}
