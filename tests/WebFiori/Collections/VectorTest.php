<?php
namespace WebFiori\Collections\Tests;

use WebFiori\Collections\Vector;
use OutOfRangeException;
use PHPUnit\Framework\TestCase;

class VectorTest extends TestCase {
    /**
     * @test
     */
    public function testEmptyVector() {
        $v = new Vector();
        $this->assertEquals(0, $v->size());
        $this->assertEquals(0, $v->count());
        $this->assertEquals([], $v->toArray());
    }
    /**
     * @test
     */
    public function testAdd() {
        $v = new Vector();
        $el = 'hello';
        $this->assertTrue($v->add($el));
        $this->assertEquals(1, $v->size());
        $this->assertEquals('hello', $v->get(0));
    }
    /**
     * @test
     */
    public function testAddMultiple() {
        $v = new Vector();
        $a = 1;
        $b = 2;
        $c = 3;
        $v->add($a);
        $v->add($b);
        $v->add($c);
        $this->assertEquals(3, $v->size());
        $this->assertEquals(1, $v->get(0));
        $this->assertEquals(2, $v->get(1));
        $this->assertEquals(3, $v->get(2));
    }
    /**
     * @test
     */
    public function testGetInvalidIndex() {
        $this->expectException(OutOfRangeException::class);
        $v = new Vector();
        $v->get(0);
    }
    /**
     * @test
     */
    public function testGetNegativeIndex() {
        $this->expectException(OutOfRangeException::class);
        $v = new Vector();
        $el = 'x';
        $v->add($el);
        $v->get(-1);
    }
    /**
     * @test
     */
    public function testSet() {
        $v = new Vector();
        $el = 'old';
        $v->add($el);
        $v->set(0, 'new');
        $this->assertEquals('new', $v->get(0));
    }
    /**
     * @test
     */
    public function testSetInvalidIndex() {
        $this->expectException(OutOfRangeException::class);
        $v = new Vector();
        $v->set(0, 'val');
    }
    /**
     * @test
     */
    public function testInsertAtBeginning() {
        $v = new Vector();
        $a = 'B';
        $v->add($a);
        $v->insert('A', 0);
        $this->assertEquals('A', $v->get(0));
        $this->assertEquals('B', $v->get(1));
        $this->assertEquals(2, $v->size());
    }
    /**
     * @test
     */
    public function testInsertAtEnd() {
        $v = new Vector();
        $a = 'A';
        $v->add($a);
        $v->insert('B', 1);
        $this->assertEquals('A', $v->get(0));
        $this->assertEquals('B', $v->get(1));
    }
    /**
     * @test
     */
    public function testInsertInMiddle() {
        $v = new Vector();
        $a = 'A';
        $c = 'C';
        $v->add($a);
        $v->add($c);
        $v->insert('B', 1);
        $this->assertEquals(['A', 'B', 'C'], $v->toArray());
    }
    /**
     * @test
     */
    public function testInsertOutOfBounds() {
        $this->expectException(OutOfRangeException::class);
        $v = new Vector();
        $v->insert('X', 5);
    }
    /**
     * @test
     */
    public function testRemoveAt() {
        $v = new Vector();
        $a = 'A';
        $b = 'B';
        $c = 'C';
        $v->add($a);
        $v->add($b);
        $v->add($c);
        $removed = $v->removeAt(1);
        $this->assertEquals('B', $removed);
        $this->assertEquals(2, $v->size());
        $this->assertEquals(['A', 'C'], $v->toArray());
    }
    /**
     * @test
     */
    public function testRemoveAtOutOfBounds() {
        $this->expectException(OutOfRangeException::class);
        $v = new Vector();
        $v->removeAt(0);
    }
    /**
     * @test
     */
    public function testRemoveElement() {
        $v = new Vector();
        $a = 'A';
        $b = 'B';
        $v->add($a);
        $v->add($b);
        $removed = $v->remove('A');
        $this->assertEquals('A', $removed);
        $this->assertEquals(1, $v->size());
        $this->assertEquals('B', $v->get(0));
    }
    /**
     * @test
     */
    public function testRemoveElementNotFound() {
        $v = new Vector();
        $a = 'A';
        $v->add($a);
        $this->assertNull($v->remove('Z'));
        $this->assertEquals(1, $v->size());
    }
    /**
     * @test
     */
    public function testIndexOf() {
        $v = new Vector();
        $a = 'X';
        $b = 'Y';
        $c = 'Z';
        $v->add($a);
        $v->add($b);
        $v->add($c);
        $this->assertEquals(0, $v->indexOf('X'));
        $this->assertEquals(1, $v->indexOf('Y'));
        $this->assertEquals(2, $v->indexOf('Z'));
        $this->assertEquals(-1, $v->indexOf('W'));
    }
    /**
     * @test
     */
    public function testIndexOfStrictComparison() {
        $v = new Vector();
        $a = '1';
        $b = 1;
        $v->add($a);
        $v->add($b);
        $this->assertEquals(1, $v->indexOf(1));
        $this->assertEquals(0, $v->indexOf('1'));
    }
    /**
     * @test
     */
    public function testIndexOfDuplicates() {
        $v = new Vector();
        $a = 'A';
        $b = 'A';
        $v->add($a);
        $v->add($b);
        $this->assertEquals(0, $v->indexOf('A'));
    }
    /**
     * @test
     */
    public function testClear() {
        $v = new Vector();
        $a = 1;
        $b = 2;
        $v->add($a);
        $v->add($b);
        $v->clear();
        $this->assertEquals(0, $v->size());
        $this->assertEquals([], $v->toArray());
    }
    /**
     * @test
     */
    public function testReplace() {
        $v = new Vector();
        $a = 'old';
        $v->add($a);
        $this->assertTrue($v->replace('old', 'new'));
        $this->assertEquals('new', $v->get(0));
    }
    /**
     * @test
     */
    public function testReplaceNotFound() {
        $v = new Vector();
        $a = 'A';
        $v->add($a);
        $this->assertFalse($v->replace('Z', 'new'));
    }
    /**
     * @test
     */
    public function testIterator() {
        $v = new Vector();
        $a = 'A';
        $b = 'B';
        $c = 'C';
        $v->add($a);
        $v->add($b);
        $v->add($c);
        $result = [];

        foreach ($v as $key => $val) {
            $result[$key] = $val;
        }
        $this->assertEquals([0 => 'A', 1 => 'B', 2 => 'C'], $result);
    }
    /**
     * @test
     */
    public function testIteratorEmpty() {
        $v = new Vector();
        $result = [];

        foreach ($v as $val) {
            $result[] = $val;
        }
        $this->assertEquals([], $result);
    }
    /**
     * @test
     */
    public function testToString() {
        $v = new Vector();
        $a = 'hello';
        $b = 42;
        $v->add($a);
        $v->add($b);
        $str = (string) $v;
        $this->assertStringContainsString('hello', $str);
        $this->assertStringContainsString('42', $str);
    }
    /**
     * @test
     */
    public function testCountable() {
        $v = new Vector();
        $a = 1;
        $b = 2;
        $v->add($a);
        $v->add($b);
        $this->assertCount(2, $v);
    }
}
