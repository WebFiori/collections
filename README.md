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
</p>

## Supported PHP Versions
|                                                                                               Build Status                                                                                                |
|:---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------:|
| <a target="_blank" href="https://github.com/WebFiori/collections/actions/workflows/php81.yaml"><img src="https://github.com/WebFiori/collections/actions/workflows/php81.yaml/badge.svg?branch=main"></a> |
| <a target="_blank" href="https://github.com/WebFiori/collections/actions/workflows/php82.yaml"><img src="https://github.com/WebFiori/collections/actions/workflows/php82.yaml/badge.svg?branch=main"></a> |
| <a target="_blank" href="https://github.com/WebFiori/collections/actions/workflows/php83.yaml"><img src="https://github.com/WebFiori/collections/actions/workflows/php83.yaml/badge.svg?branch=main"></a> |
| <a target="_blank" href="https://github.com/WebFiori/collections/actions/workflows/php84.yaml"><img src="https://github.com/WebFiori/collections/actions/workflows/php84.yaml/badge.svg?branch=main"></a> |

## Supported Collections
* Linked List
* Stack
* Queue

## Installation

You can install the library through Composer:

```bash
composer require webfiori/collections
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
        
        // Compare by age
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
- `removeLast(): mixed` - Remove last element
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
- `pop(): mixed` - Remove and return top element
- `peek(): mixed` - View top element without removing
- `max(): int` - Get maximum capacity (-1 for unlimited)

### Queue Specific Methods

- `enqueue($element): bool` - Add element to rear
- `dequeue(): mixed` - Remove and return front element
- `peek(): mixed` - View front element without removing
- `max(): int` - Get maximum capacity (-1 for unlimited)


## License

This library is licensed under the MIT License. See the [LICENSE](LICENSE) file for more details.
