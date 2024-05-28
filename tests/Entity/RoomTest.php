<?php

namespace App\Tests\Entity;

use App\Entity\Room;
use PHPUnit\Framework\TestCase;

class RoomTest extends TestCase
{
    /**
     * Test setting and getting the name
     */
    public function testSetGetName(): void
    {
        $room = new Room();
        $name = 'Library';

        $room->setName($name);

        $this->assertEquals($name, $room->getName());
    }

    /**
     * Test setting and getting the description
     */
    public function testSetGetDescription(): void
    {
        $room = new Room();
        $description = 'A quiet place with many books.';

        $room->setDescription($description);

        $this->assertEquals($description, $room->getDescription());
    }

    /**
     * Test setting and getting the image
     */
    public function testSetGetImage(): void
    {
        $room = new Room();
        $image = 'library.jpg';

        $room->setImage($image);

        $this->assertEquals($image, $room->getImage());
    }

    /**
     * Test setting and getting the north direction
     */
    public function testSetGetNorth(): void
    {
        $room = new Room();
        $north = 'Garden';

        $room->setNorth($north);

        $this->assertEquals($north, $room->getNorth());
    }

    /**
     * Test setting and getting the south direction
     */
    public function testSetGetSouth(): void
    {
        $room = new Room();
        $south = 'Kitchen';

        $room->setSouth($south);

        $this->assertEquals($south, $room->getSouth());
    }

    /**
     * Test setting and getting the east direction
     */
    public function testSetGetEast(): void
    {
        $room = new Room();
        $east = 'Dining Room';

        $room->setEast($east);

        $this->assertEquals($east, $room->getEast());
    }

    /**
     * Test setting and getting the west direction
     */
    public function testSetGetWest(): void
    {
        $room = new Room();
        $west = 'Living Room';

        $room->setWest($west);

        $this->assertEquals($west, $room->getWest());
    }

    /**
     * Test setting and getting the inspect description
     */
    public function testSetGetInspect(): void
    {
        $room = new Room();
        $inspect = 'The room is filled with ancient artifacts.';

        $room->setInspect($inspect);

        $this->assertEquals($inspect, $room->getInspect());
    }

    /**
     * Test setting and getting the id
     */
    public function testSetGetId(): void
    {
        $room = new Room();

        $reflection = new \ReflectionClass($room);
        $property = $reflection->getProperty('id');
        $property->setAccessible(true);
        $property->setValue($room, 1);

        $this->assertEquals(1, $room->getId());
    }
}
