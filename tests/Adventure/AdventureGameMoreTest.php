<?php

namespace App\AdventureGame;

use App\Entity\Room;
use App\Entity\Item;
use PHPUnit\Framework\TestCase;

/**
 * More test cases for Game class
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
     * Test method currentRoomName().
     */
    public function testCurrentRoomName(): void
    {
        $room = $this->game->currentRoomName();

        $this->assertInstanceOf("App\Entity\Room", $room);
        $this->assertEquals($this->game->currentRoomName(), $this->room);
    }

    /**
     * Test method currentRoomItems().
     */
    public function testCurrentRoomItems(): void
    {
        $item = $this->game->currentRoomItems();

        $this->assertNotInstanceOf("App\Entity\Item", $item);
        $this->assertIsArray($item);
        $this->assertContainsOnly("string", $item);
    }

    /**
     * Test method setCurrentRoom().
     */
    public function testSetCurrentRoom(): void
    {
        $newRoom = new Room();
        $newItem = new Item();

        $this->game->setCurrentRoom($newRoom, [$newItem]);

        $this->assertNotEquals($this->game->currentRoomName(), $this->room);
    }

    /**
     * Test method visitedRooms().
     */
    public function testVisitedRooms(): void
    {
        $this->assertIsArray($this->game->visitedRooms());
        $this->assertNotEmpty($this->game->visitedRooms());
        $this->assertContains($this->room->getName(), $this->game->visitedRooms());
        $this->assertCount(1, $this->game->visitedRooms());


        $newRoom = new Room();
        $newItem = new Item();

        $this->game->setCurrentRoom($newRoom, [$newItem]);

        $this->assertIsArray($this->game->visitedRooms());
        $this->assertNotEmpty($this->game->visitedRooms());
        $this->assertCount(2, $this->game->visitedRooms());
    }

    // /**
    //  * Test method getAvailableDirections().
    //  */
    // public function testGetAvailableDirections(): void
    // {
    //     $directions = $this->game->getAvailableDirections();

    //     $this->assertIsArray($directions);
    //     $this->assertCount(3, $directions);
    //     $this->assertNotContains("east", $directions);
    //     $this->assertContains("north", $directions);

    //     $newRoom = (new Room())
    //         ->setName("school")
    //         ->setDescription("a primary school")
    //         ->setImage("school.jpg")
    //         ->setNorth("park")
    //         ->setEast("houses")
    //         ->setSouth("shopping mall")
    //         ->setWest("clinic")
    //         ->setInspect("The school has many teaching materials")
    //     ;
    //     $this->game->setCurrentRoom($newRoom, [$this->item]);
    //     $this->assertContains("east", $this->game->getAvailableDirections());
    // }

    /**
     * Test method getDirectionsDescription().
     */
    public function testGetDirectionsDescription(): void
    {
        $this->game->setCurrentRoom(
            (new Room())
                ->setName("singleDirectionRoom")
                ->setNorth("anotherRoom")
                ->setEast("null")
                ->setSouth("null")
                ->setWest("null"),
            []
        );

        $this->assertStringContainsString("north to the anotherRoom", $this->game->getDirectionsDescription());

        $this->game->setCurrentRoom(
            (new Room())
                ->setName("noDirectionRoom")
                ->setNorth("null")
                ->setEast("null")
                ->setSouth("null")
                ->setWest("null"),
            []
        );

        $this->assertStringContainsString("From here you can go nowhere.", $this->game->getDirectionsDescription());

        $this->game->setCurrentRoom(
            (new Room())
                ->setName("multiDirectionRoom")
                ->setNorth("park")
                ->setEast("houses")
                ->setSouth("shopping mall")
                ->setWest("clinic"),
            []
        );

        $this->assertStringContainsString("north to the park", $this->game->getDirectionsDescription());
        $this->assertStringContainsString("east to the houses", $this->game->getDirectionsDescription());
        $this->assertStringContainsString("south to the shopping mall", $this->game->getDirectionsDescription());
        $this->assertStringContainsString("west to the clinic", $this->game->getDirectionsDescription());
    }

    /**
     * Test method roomAccordingToDirection().
     */
    public function testRoomAccordingToDirection(): void
    {
        $this->assertEquals($this->room->getNorth(), $this->game->roomAccordingToDirection("north"));
        $this->assertEquals($this->room->getSouth(), $this->game->roomAccordingToDirection("south"));
        $this->assertEquals($this->room->getWest(), $this->game->roomAccordingToDirection("west"));
        $this->assertNull($this->game->roomAccordingToDirection("east"));
    }

    /**
     * Test method roomAccordingToDirection() for invalid direction.
     */
    public function testRoomAccordingToDirectionInvalidDirection(): void
    {
        $invalidDirections = ['up', 'down', 'left', 'right'];

        foreach ($invalidDirections as $direction) {
            $this->assertNull($this->game->roomAccordingToDirection($direction));
        }
    }

    /**
     * Test method basketItem() when basket is empty.
     */
    public function testBasketItemEmpty(): void
    {
        $this->assertEmpty($this->game->basketItem());
    }
}
