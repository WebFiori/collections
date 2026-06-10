# WebFiori Collections

Basic data structures used by WebFiori framework.

<p align="center">
  <a href="https://github.com/WebFiori/collections/actions">
    <img src="https://github.com/WebFiori/collections/actions/workflows/php83.yaml/badge.svg?branch=main">
  </a>
  <a href="https://codecov.io/gh/WebFiori/collections">
    <img src="https://codecov.io/gh/WebFiori/collections/branch/main/graph/badge.svg" />
  </a>
  <a href="https://sonarcloud.io/dashboard?id=WebFiori_collections">
      <img src="https://sonarcloud.io/api/project_badges/measure?project=WebFiori_collections&metric=alert_status" />
  </a>
  <a href="https://github.com/WebFiori/collections/releases">
      <img src="https://img.shields.io/github/release/WebFiori/collections.svg?label=latest" />
  </a>
  <a href="https://packagist.org/packages/webfiori/collections">
      <img src="https://img.shields.io/packagist/dt/webfiori/collections?color=light-green">
  </a>
  <img src="https://img.shields.io/badge/php-%3E%3D8.1-blue" alt="PHP 8.1+">
</p>

## Table of Contents

- [Key Features](#key-features)
- [Supported PHP Versions](#supported-php-versions)
- [Installation](#installation)
- [Quick Start](#quick-start)
- [Usage](#usage)
  - [LinkedList](#linkedlist)
  - [Stack](#stack)
  - [Queue](#queue)
  - [Vector](#vector)
- [Advanced Usage](#advanced-usage)
- [API Reference](#api-reference)
- [Testing](#testing)
- [Contributing](#contributing)
- [License](#license)
- [Support](#support)
- [Changelog](#changelog)

## Key Features

- **LinkedList** — Doubly-linked list with O(1) add/removeLast and full iterator support
- **Stack** — LIFO structure with O(1) push/pop
- **Queue** — FIFO structure with O(1) enqueue/dequeue
- **Vector** — Array-backed list with O(1) index access, `ArrayAccess`, and `JsonSerializable`
- All collections implement `Countable`
- Optional size limits on all collections
- Sorting support via `Comparable` interface

## Supported PHP Versions

|                                                                                               Build Status                                                                                                |
|:---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------:|
| <a target="_blank" href="https://github.com/WebFiori/collections/actions/workflows/php81.yaml"><img src="https://github.com/WebFiori/collections/actions/workflows/php81.yaml/badge.svg?branch=main"></a> |
| <a target="_blank" href="https://github.com/WebFiori/collections/actions/workflows/php82.yaml"><img src="https://github.com/WebFiori/collections/actions/workflows/php82.yaml/badge.svg?branch=main"></a> |
| <a target="_blank" href="https://github.com/WebFiori/collections/actions/workflows/php83.yaml"><img src="https://github.com/WebFiori/collections/actions/workflows/php83.yaml/badge.svg?branch=main"></a> |
| <a target="_blank" href="https://github.com/WebFiori/collections/actions/workflows/php84.yaml"><img src="https://github.com/WebFiori/collections/actions/workflows/php84.yaml/badge.svg?branch=main"></a> |

## Installation

```bash
composer require webfiori/collections
```

## Quick Start

```php
<?php
use WebFiori\Collections\LinkedList;
use WebFiori\Collections\Stack;
use WebFiori\Collections\Queue;
use WebFiori\Collections\Vector;

// LinkedList — doubly-linked, iterable
$list = new LinkedList();
$list->add("A");
$list->add("B");
echo $list->get(0); // "A"

// Stack — LIFO
$stack = new Stack();
$stack->push("Bottom");
$stack->push("Top");
echo $stack->pop(); // "Top"

// Queue — FIFO
$queue = new Queue();
$queue->enqueue("First");
$queue->enqueue("Second");
echo $queue->dequeue(); // "First"

// Vector — O(1) index access, array bracket syntax
$vector = new Vector();
$vector[] = "Hello";
$vector[] = "World";
echo $vector[0]; // "Hello"
echo json_encode($vector); // ["Hello","World"]
```

## Usage

### LinkedList

The `LinkedList` class provides a doubly-linked list implementation with full iterator support.

```php
<?php
use WebFiori\Collections\LinkedList;

// Create a new linked list
$list = new LinkedList();

// Add elements
$list->add("First");
$list->add("Second");
$list->add("Third");

// Access elements by index
echo $list->get(0); // "First"
echo $list->get(1); // "Second"

// Insert at specific position
$list->insert("Inserted", 1); // Insert at index 1

// Remove elements
$removed = $list->remove(0); // Remove first element
$removed = $list->removeElement("Second"); // Remove by value

// Check if element exists
if ($list->contains("Third")) {
    echo "Found Third!";
}

// Get element index
$index = $list->indexOf("Third");

// Iterate through the list
foreach ($list as $item) {
    echo $item . "\n";
}

// Convert to array
$array = $list->toArray();

// Sort the list (works with strings, numbers, and Comparable objects)
$list->insertionSort(); // Ascending
$list->insertionSort(false); // Descending

// Get list size
echo "Size: " . $list->size();

// Clear all elements
$list->clear();
```

#### LinkedList with Size Limit

```php
// Create a list with maximum 5 elements
$limitedList = new LinkedList(5);

// This will return false if limit is reached
$success = $limitedList->add("Item");
```

### Stack

The `Stack` class implements a Last-In-First-Out (LIFO) data structure.

```php
<?php
use WebFiori\Collections\Stack;

// Create a new stack
$stack = new Stack();

// Push elements onto the stack
$stack->push("Bottom");
$stack->push("Middle");
$stack->push("Top");

// Peek at the top element without removing it
echo $stack->peek(); // "Top"

// Pop elements from the stack
$top = $stack->pop(); // "Top"
$middle = $stack->pop(); // "Middle"

// Check stack size
echo "Size: " . $stack->size();

// Convert to array
$array = $stack->toArray();

// You can also use add() method (alias for push)
$stack->add("New Top");
```

#### Stack with Size Limit

```php
// Create a stack with maximum 10 elements
$limitedStack = new Stack(10);

// This will return false if limit is reached
$success = $limitedStack->push("Item");
```

### Queue

The `Queue` class implements a First-In-First-Out (FIFO) data structure.

```php
<?php
use WebFiori\Collections\Queue;

// Create a new queue
$queue = new Queue();

// Enqueue elements
$queue->enqueue("First");
$queue->enqueue("Second");
$queue->enqueue("Third");

// Peek at the front element without removing it
echo $queue->peek(); // "First"

// Dequeue elements
$first = $queue->dequeue(); // "First"
$second = $queue->dequeue(); // "Second"

// Check queue size
echo "Size: " . $queue->size();

// Convert to array
$array = $queue->toArray();

// You can also use add() method (alias for enqueue)
$queue->add("Fourth");
```

#### Queue with Size Limit

```php
// Create a queue with maximum 100 elements
$limitedQueue = new Queue(100);

// This will return false if limit is reached
$success = $limitedQueue->enqueue("Item");
```

### Vector

The `Vector` class provides an array-backed list with O(1) index access.

```php
<?php
use WebFiori\Collections\Vector;

// Create a new vector
$vector = new Vector();

// Add elements
$vector->add("First");
$vector->add("Second");

// O(1) index access
echo $vector->get(0); // "First"

// Set element at index
$vector->set(0, "Modified");

// Insert at position
$vector->insert("Middle", 1);

// Remove by index or value
$vector->removeAt(0);
$vector->remove("Middle");

// Array bracket syntax (ArrayAccess)
$vector[] = "New";
$vector[0] = "Replaced";
echo $vector[0]; // "Replaced"
isset($vector[0]); // true
unset($vector[0]);

// JSON serialization
echo json_encode($vector); // ["New"]

// Find elements
$index = $vector->indexOf("New"); // 0 or -1 if not found

// Replace
$vector->replace("New", "Newer");

// Iterate
foreach ($vector as $index => $value) {
    echo "$index: $value\n";
}
```

## Advanced Usage

### Custom Object Sorting

To sort custom objects in a LinkedList, implement the `Comparable` interface:

```php
<?php
use WebFiori\Collections\Comparable;
use WebFiori\Collections\LinkedList;

class Person implements Comparable {
    private $name;
    private $age;
    
    public function __construct($name, $age) {
        $this->name = $name;
        $this->age = $age;
    }
    
    public function compare($other): int {
        if (!($other instanceof Person)) {
            return 1;
        }
        
        if ($this->age == $other->age) {
            return 0;
        }
        
        return $this->age > $other->age ? 1 : -1;
    }
    
    public function getName() {
        return $this->name;
    }
    
    public function getAge() {
        return $this->age;
    }
}

// Usage
$list = new LinkedList();
$list->add(new Person("Alice", 30));
$list->add(new Person("Bob", 25));
$list->add(new Person("Charlie", 35));

// Sort by age
$list->insertionSort(); // Ascending by age
```

### Working with References

All collections work with references, allowing you to modify objects after adding them:

```php
$data = ["key" => "value"];
$list = new LinkedList();
$list->add($data);

// Modify the original data
$data["key"] = "modified";

// The list contains the modified data
$retrieved = $list->get(0);
echo $retrieved["key"]; // "modified"
```

## API Reference

### Common Methods (All Collections)

- `add(&$element): bool` - Add an element to the collection
- `size(): int` - Get the number of elements
- `toArray(): array` - Convert collection to array
- `count(): int` - Get element count (implements Countable)

### LinkedList Specific Methods

- `get($index): mixed` - Get element at index
- `getFirst(): mixed` - Get first element
- `getLast(): mixed` - Get last element
- `remove($index): mixed` - Remove element at index
- `removeFirst(): mixed` - Remove first element
- `removeLast(): mixed` - Remove last element (O(1))
- `removeElement(&$element): mixed` - Remove specific element
- `insert(&$element, $position): bool` - Insert at position
- `indexOf($element): int` - Find element index
- `contains(&$element): bool` - Check if element exists
- `countElement(&$element): int` - Count occurrences
- `replace(&$old, &$new): bool` - Replace element
- `insertionSort($ascending = true): bool` - Sort elements
- `clear(): void` - Remove all elements
- `max(): int` - Get maximum capacity (-1 for unlimited)

### Stack Specific Methods

- `push($element): bool` - Add element to top
- `pop(): mixed` - Remove and return top element (O(1))
- `peek(): mixed` - View top element without removing
- `max(): int` - Get maximum capacity (-1 for unlimited)

### Queue Specific Methods

- `enqueue($element): bool` - Add element to rear
- `dequeue(): mixed` - Remove and return front element
- `peek(): mixed` - View front element without removing
- `max(): int` - Get maximum capacity (-1 for unlimited)

### Vector Specific Methods

- `get(int $index): mixed` - Get element at index (O(1))
- `set(int $index, mixed $element): void` - Set element at index
- `insert(mixed $element, int $index): void` - Insert at position
- `removeAt(int $index): mixed` - Remove element at index
- `remove(mixed $element): mixed` - Remove first occurrence
- `indexOf(mixed $element): int` - Find element index (-1 if not found)
- `replace(mixed $old, mixed $new): bool` - Replace first occurrence
- `clear(): void` - Remove all elements
- `jsonSerialize(): array` - JSON serialization support
- Implements `ArrayAccess`: `$vector[0]`, `$vector[] = x`, `isset($vector[0])`, `unset($vector[0])`

### Node Methods

The `Node` class supports both singly and doubly linked usage:

- `data(): mixed` - Get the stored data
- `next(): ?Node` - Get the next node
- `prev(): ?Node` - Get the previous node
- `setData(mixed &$data): void` - Set the stored data
- `setNext(?Node &$next): void` - Set the next node
- `setPrev(?Node &$prev): void` - Set the previous node

All collections use doubly-linked nodes internally, enabling O(1) `removeLast()` on LinkedList and O(1) `pop()` on Stack.

## Testing

```bash
# Install dependencies
composer install

# Run tests
composer test
```

## Contributing

Contributions are welcome! Please open an issue or submit a pull request on [GitHub](https://github.com/WebFiori/collections).

## License

This library is licensed under the MIT License. See the [LICENSE](LICENSE) file for more details.

## Support

If you encounter any issues, please [open an issue](https://github.com/WebFiori/collections/issues) on GitHub.

## Changelog

See [CHANGELOG.md](CHANGELOG.md) for a list of changes.
