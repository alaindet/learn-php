<?php

class CollectionTest extends \PHPUnit\Framework\TestCase
{
    public function testEmptyInstantiatedCollectionToReturnNoItems()
    {
        $collection = new \App\Support\Collection;

        $this->assertEmpty($collection->get());
    }

    public function testCountIsCorrect()
    {
        $array = ['one', 'two', 'three'];
        $collection = new \App\Support\Collection($array);

        $this->assertEquals(3, $collection->count());

        // Alternative
        // $this->assertCount(3, $collection->get());
    }

    public function testItemsReturnedMatchItemsPassedIn()
    {
        $array = ['one', 'two', 'three'];
        $collection = new \App\Support\Collection($array);

        $this->assertEquals(3, $collection->count());
        $this->assertEquals('one', $collection->get()[0]);
        $this->assertEquals('two', $collection->get()[1]);
        $this->assertEquals('three', $collection->get()[2]);
    }

    public function testCollectionIsInstanceOfIteratorAggregate()
    {
        $collection = new \App\Support\Collection;

        $this->assertInstanceOf(IteratorAggregate::class, $collection);
    }

    public function testCollectionCanBeIterated()
    {
        $array = ['one', 'two', 'three'];
        $collection = new \App\Support\Collection($array);
        $items = [];
        foreach ($collection as $item) {
            $items[] = $item;
        }

        $this->assertCount(3, $items);
        $this->assertInstanceOf(ArrayIterator::class, $collection->getIterator());
    }

    public function testCollectionCanBeMergedWithAnotherOne()
    {
        $array1 = ['one', 'two'];
        $array2 = ['three', 'four', 'five'];
        $collection1 = new \App\Support\Collection($array1);
        $collection2 = new \App\Support\Collection($array2);
        $collection1->merge($collection2);

        $this->assertCount(5, $collection1->get());
    }

    public function testCanAddToExistingCollection()
    {
        $array1 = ['one', 'two'];
        $array2 = ['three', 'four', 'five'];
        $collection = new \App\Support\Collection($array1);
        $collection->add($array2);

        $this->assertEquals(5, $collection->count());
    }

    public function testReturnsJsonEncodedItems()
    {
        $array = [
            ['username' => 'Pinco'],
            ['username' => 'Pallino'],
        ];
        $collection = new \App\Support\Collection($array);

        $this->assertInternalType('string', $collection->toJson());
        $this->assertEquals(
            '[{"username":"Pinco"},{"username":"Pallino"}]',
            $collection->toJson()
        );
    }

    public function testJsonEncodingACollectionObjectReturnsJson()
    {
        $array = [
            ['username' => 'Pinco'],
            ['username' => 'Pallino'],
        ];
        $collection = new \App\Support\Collection($array);
        $encoded = json_encode($collection);
        
        $this->assertInternalType('string', $encoded);
        $this->assertEquals($encoded, $collection->toJson());
    }
}
