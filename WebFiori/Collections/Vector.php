<?php
/**
 * This file is licensed under MIT License.
 *
 * Copyright (c) 2026 WebFiori Framework
 *
 * For more information on the license, please visit:
 * https://github.com/WebFiori/.github/blob/main/LICENSE
 *
 */

namespace WebFiori\Collections;

use Iterator;
use OutOfRangeException;

/**
 * A class that represents an array-backed list with O(1) index access.
 *
 * @author Ibrahim
 */
class Vector extends AbstractCollection implements Iterator {
    /**
     * The array that holds the elements.
     *
     * @var array
     */
    private $elements;
    /**
     * Iterator position.
     *
     * @var int
     */
    private $position;

    /**
     * Creates new instance of the class.
     */
    public function __construct() {
        $this->elements = [];
        $this->position = 0;
    }

    /**
     * Adds new element to the end of the vector.
     *
     * @param mixed $el The element to add.
     *
     * @return bool Always true since the vector has no size limit.
     */
    public function add(&$el): bool {
        $this->elements[] = $el;

        return true;
    }

    /**
     * Returns the element at the specified index.
     *
     * @param int $index The index of the element.
     *
     * @return mixed The element at the given index.
     *
     * @throws OutOfRangeException If the index is out of bounds.
     */
    public function get(int $index): mixed {
        if ($index < 0 || $index >= count($this->elements)) {
            throw new OutOfRangeException("Index $index is out of range. Size is " . $this->size() . ".");
        }

        return $this->elements[$index];
    }

    /**
     * Sets the element at the specified index.
     *
     * @param int $index The index to set.
     * @param mixed $element The new element.
     *
     * @throws OutOfRangeException If the index is out of bounds.
     */
    public function set(int $index, mixed $element): void {
        if ($index < 0 || $index >= count($this->elements)) {
            throw new OutOfRangeException("Index $index is out of range. Size is " . $this->size() . ".");
        }
        $this->elements[$index] = $element;
    }

    /**
     * Inserts an element at the specified position.
     *
     * Elements at and after the position are shifted to the right.
     *
     * @param mixed $element The element to insert.
     * @param int $index The position to insert at.
     *
     * @throws OutOfRangeException If the index is out of bounds.
     */
    public function insert(mixed $element, int $index): void {
        if ($index < 0 || $index > count($this->elements)) {
            throw new OutOfRangeException("Index $index is out of range. Size is " . $this->size() . ".");
        }
        array_splice($this->elements, $index, 0, [$element]);
    }

    /**
     * Removes the element at the specified index.
     *
     * @param int $index The index of the element to remove.
     *
     * @return mixed The removed element.
     *
     * @throws OutOfRangeException If the index is out of bounds.
     */
    public function removeAt(int $index): mixed {
        if ($index < 0 || $index >= count($this->elements)) {
            throw new OutOfRangeException("Index $index is out of range. Size is " . $this->size() . ".");
        }
        $removed = $this->elements[$index];
        array_splice($this->elements, $index, 1);

        return $removed;
    }

    /**
     * Removes the first occurrence of the specified element.
     *
     * @param mixed $element The element to remove.
     *
     * @return mixed The removed element, or null if not found.
     */
    public function remove(mixed $element): mixed {
        $index = $this->indexOf($element);

        if ($index === -1) {
            return null;
        }

        return $this->removeAt($index);
    }

    /**
     * Returns the index of the first occurrence of the specified element.
     *
     * Uses strict comparison (===).
     *
     * @param mixed $element The element to search for.
     *
     * @return int The index, or -1 if not found.
     */
    public function indexOf(mixed $element): int {
        $count = count($this->elements);

        for ($i = 0; $i < $count; $i++) {
            if ($this->elements[$i] === $element) {
                return $i;
            }
        }

        return -1;
    }

    /**
     * Returns the number of elements in the vector.
     *
     * @return int The number of elements.
     */
    public function size(): int {
        return count($this->elements);
    }

    /**
     * Removes all elements from the vector.
     */
    public function clear(): void {
        $this->elements = [];
    }

    /**
     * Replaces the first occurrence of an element with a new one.
     *
     * @param mixed $old The element to replace.
     * @param mixed $new The replacement element.
     *
     * @return bool True if replaced, false if the old element was not found.
     */
    public function replace(mixed $old, mixed $new): bool {
        $index = $this->indexOf($old);

        if ($index === -1) {
            return false;
        }
        $this->elements[$index] = $new;

        return true;
    }

    /**
     * Returns an array containing all elements of the vector.
     *
     * @return array A copy of the internal array.
     */
    public function toArray(): array {
        return $this->elements;
    }

    #[\ReturnTypeWillChange]
    public function current(): mixed {
        return $this->elements[$this->position] ?? null;
    }

    #[\ReturnTypeWillChange]
    public function key(): int {
        return $this->position;
    }

    #[\ReturnTypeWillChange]
    public function next(): void {
        $this->position++;
    }

    #[\ReturnTypeWillChange]
    public function rewind(): void {
        $this->position = 0;
    }

    public function valid(): bool {
        return $this->position < count($this->elements);
    }
}
