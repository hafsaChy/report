<?php

namespace App\AdventureGame;

use App\Entity\Room;
use App\Entity\Item;
use PHPUnit\Framework\TestCase;

/**
 * Test cases for Game class
 */
class AdventureGameTest extends TestCase
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
     * Test method for pickUpItem().
     */
    public function testPickUpOne(): void
    {
        $output = $this->game->pickUpItem($this->item);

        $this->assertIsString($output);
        $this->assertStringContainsString("white board", $output);
    }

    /**
     * Test method for pickUpItem().
     */
    public function testPickUpMany(): void
    {
        for ($i = 1; $i <= 9; $i++) {
            $item = (new Item())
                ->setName(strval($i))
            ;
            $this->game->pickUpItem($item);
        }

        $output = $this->game->pickUpItem($this->item);
        $this->assertIsString($output);
        $this->assertStringContainsString("full", $output);
    }

    /**
     * Test method for putBack().
     */
    public function testPutBackEmpty(): void
    {
        $output = $this->game->putBack($this->item);

        $this->assertIsString($output);
        $this->assertStringContainsString("empty", $output);
    }

    /**
     * Test method for putBack().
     */
    public function testPutBackNotExist(): void
    {
        $noItem = (new Item())->setName("nothing");
        $this->game->pickUpItem($noItem);
        $output = $this->game->putBack($this->item);

        $this->assertIsString($output);
        $this->assertStringContainsString("not available in the basket", $output);
    }

    /**
     * Test method for putBack().
     */
    public function testPutBackExist(): void
    {
        $someItem = (new Item())->setName("something");
        $this->game->pickUpItem($someItem);
        $output = $this->game->putBack($someItem);

        $this->assertIsString($output);
        $this->assertStringContainsString("something", $output);
    }

    /**
     * Test method for checkItemInBasket().
     */
    public function testCheckItemInBasket(): void
    {
        $this->assertFalse($this->game->checkItemInBasket("white board"));

        $output = $this->game->pickUpItem($this->item);
        $itemName = $this->item->getName();
        if ($itemName) {
            $this->assertStringContainsString($itemName, $output);
            $this->assertTrue($this->game->checkItemInBasket($itemName));
        }
    }

    /**
     * Test method for inspectRoomOrItem().
     */
    public function testInspectRoomOrItemRoom(): void
    {
        $output = $this->game->inspectRoomOrItem("school");

        $this->assertNotEmpty($output);
        $this->assertIsString($output);
        $this->assertStringContainsString("school", $output);
    }

    /**
     * Test method for inspectRoomOrItem().
     */
    public function testInspectRoomOrItemItem(): void
    {
        $output = $this->game->inspectRoomOrItem("white board");

        $this->assertNotEmpty($output);
        $this->assertIsString($output);
        $this->assertStringContainsString("white board", $output);
    }

    /**
     * Test method for inspectRoomOrItem().
     */
    public function testInspectRoomOrItemBasketItem(): void
    {
        $newItem = (new Item())->setName("something")->setDescription("something in the school");
        $this->game->pickUpItem($newItem);
        $output = $this->game->inspectRoomOrItem("something");

        $this->assertNotEmpty($output);
        $this->assertIsString($output);
        $this->assertStringContainsString("something", $output);
    }

    /**
     * Test method for inspectRoomOrItem().
     */
    public function testInspectRoomOrItemEmptyInput(): void
    {
        $output = $this->game->inspectRoomOrItem("");

        $this->assertNotEmpty($output);
        $this->assertIsString($output);
        $this->assertStringContainsString("inspect", $output);
    }
}
