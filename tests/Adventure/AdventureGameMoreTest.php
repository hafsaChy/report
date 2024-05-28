<?php

namespace App\AdventureGame;

use App\Entity\Room;
use App\Entity\Item;
use PHPUnit\Framework\TestCase;

/**
 * Test cases for Game class
 */
class AdventureGameMoreTest extends TestCase
{
    /**
     * @var Game $game
     */
    protected $game;

    /**
     * @var Room $room
     */
    protected $room;

    /**
     * @var Item $item
     */
    protected $item;

    /**
     * Set up for tests
     */
    public function setUp(): void
    {
        $this->room = (new Room())
            ->setName("school")
            ->setDescription("a primary school")
            ->setImage("school.jpg")
            ->setNorth("park")
            ->setEast("null")
            ->setSouth("shopping mall")
            ->setWest("clinic")
            ->setInspect("The school has many teaching materials")
        ;

        $this->item = (new Item())
            ->setName("white board")
            ->setDescription("white boards in the classrooms of the school")
            ->setImage("board.jpeg")
            ->setRoom("school")
        ;

        $this->game = new Game($this->room, [$this->item]);
    }

    /**
     * Test method getCurrentRoom().
     */
    public function testGetCurrentRoom(): void
    {
        $room = $this->game->getCurrentRoom();

        $this->assertInstanceOf("App\Entity\Room", $room);
        $this->assertEquals($this->game->getCurrentRoom(), $this->room);
    }

    /**
     * Test method getCurrentRoomItems().
     */
    public function testGetCurrentRoomItems(): void
    {
        $item = $this->game->getCurrentRoomItems();

        $this->assertNotInstanceOf("App\Entity\Item", $item);
        $this->assertIsArray($item);
        $this->assertContainsOnly("string", $item);
    }

    /**
     * Test method setRoomTo().
     */
    public function testSetRoomTo(): void
    {
        $newRoom = new Room();
        $newItem = new Item();

        $this->game->setRoomTo($newRoom, [$newItem]);

        $this->assertNotEquals($this->game->getCurrentRoom(), $this->room);
    }

    /**
     * Test method getVisitedRooms().
     */
    public function testGetVisitedRooms(): void
    {
        $this->assertIsArray($this->game->getVisitedRooms());
        $this->assertNotEmpty($this->game->getVisitedRooms());
        $this->assertContains($this->room->getName(), $this->game->getVisitedRooms());
        $this->assertCount(1, $this->game->getVisitedRooms());


        $newRoom = new Room();
        $newItem = new Item();

        $this->game->setRoomTo($newRoom, [$newItem]);

        $this->assertIsArray($this->game->getVisitedRooms());
        $this->assertNotEmpty($this->game->getVisitedRooms());
        $this->assertCount(2, $this->game->getVisitedRooms());
    }

    /**
     * Test method getDirections().
     */
    public function testGetDirections(): void
    {
        $directions = $this->game->getDirections();

        $this->assertIsArray($directions);
        $this->assertCount(3, $directions);
        $this->assertNotContains("east", $directions);
        $this->assertContains("north", $directions);

        $newRoom = (new Room())
            ->setName("school")
            ->setDescription("a primary school")
            ->setImage("school.jpg")
            ->setNorth("park")
            ->setEast("houses")
            ->setSouth("shopping mall")
            ->setWest("clinic")
            ->setInspect("The school has many teaching materials")
        ;
        $this->game->setRoomTo($newRoom, [$this->item]);
        $this->assertContains("east", $this->game->getDirections());
    }

    /**
     * Test method checkValidDirection().
     */
    public function testCheckValidDirection(): void
    {
        $this->assertTrue($this->game->checkValidDirection("south"));
        $this->assertFalse($this->game->checkValidDirection("east"));

        $newRoom = (new Room())
            ->setName("school")
            ->setDescription("a primary school")
            ->setImage("school.jpg")
            ->setNorth("park")
            ->setEast("houses")
            ->setSouth("shopping mall")
            ->setWest("clinic")
            ->setInspect("The school has many teaching materials")
        ;
        $this->game->setRoomTo($newRoom, [$this->item]);
        $this->assertTrue($this->game->checkValidDirection("east"));
    }

    /**
     * Test method getDirectionsAsString().
     */
    public function testGetDirectionsAsString(): void
    {
        $directionAsString = $this->game->getDirectionsAsString();

        $this->assertStringContainsString("north", $directionAsString);
        $this->assertStringContainsString("south", $directionAsString);
        $this->assertStringContainsString("west", $directionAsString);
        $this->assertStringNotContainsString("east", $directionAsString);
    }

    /**
     * Test method getLocationOfDirection().
     */
    public function testGetLocationOfDirection(): void
    {
        $this->assertEquals($this->room->getNorth(), $this->game->getLocationOfDirection("north"));
        $this->assertEquals($this->room->getSouth(), $this->game->getLocationOfDirection("south"));
        $this->assertEquals($this->room->getWest(), $this->game->getLocationOfDirection("west"));
        $this->assertEmpty($this->game->getLocationOfDirection("east"));
    }

    /**
     * Test method getBasket() when basket is empty.
     */
    public function testGetBasketEmpty(): void
    {
        $this->assertEmpty($this->game->getBasket());
    }
}
