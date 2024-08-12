<?php

namespace App\Entity;

// use App\Entity\Item;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class ItemTest extends TestCase
{
    /**
     * Test setting and getting the name
     */
    public function testSetGetName(): void
    {
        $item = new Item();
        $name = 'Rice';

        $item->setName($name);

        $this->assertEquals($name, $item->getName());
    }

    /**
     * Test setting and getting the description
     */
    public function testSetGetDescription(): void
    {
        $item = new Item();
        $description = 'A packet of 5 kilograms rice';

        $item->setDescription($description);

        $this->assertEquals($description, $item->getDescription());
    }

    /**
     * Test setting and getting the image
     */
    public function testSetGetImage(): void
    {
        $item = new Item();
        $image = 'rice.jpeg';

        $item->setImage($image);

        $this->assertEquals($image, $item->getImage());
    }

    /**
     * Test setting and getting the room
     */
    public function testSetGetRoom(): void
    {
        $item = new Item();
        $room = 'Store room';

        $item->setRoom($room);

        $this->assertEquals($room, $item->getRoom());
    }

    /**
     * Test setting and getting the id
     */
    public function testSetGetId(): void
    {
        $item = new Item();

        $reflection = new ReflectionClass($item);
        $property = $reflection->getProperty('id');
        $property->setAccessible(true);
        $property->setValue($item, 1);

        $this->assertEquals(1, $item->getId());
    }
}
