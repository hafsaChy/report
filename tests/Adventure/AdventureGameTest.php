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
     * Test method pickUp().
     */
    public function testPickUpOne(): void
    {
        $output = $this->game->pickUp($this->item);

        $this->assertIsString($output);
        $this->assertStringContainsString("white board", $output);
    }

    /**
     * Test method pickUp().
     */
    public function testPickUpMany(): void
    {
        for ($i = 1; $i <= 9; $i++) {
            $item = (new Item())
                ->setName(strval($i))
            ;
            $this->game->pickUp($item);
        }

        $output = $this->game->pickUp($this->item);
        $this->assertIsString($output);
        $this->assertStringContainsString("full", $output);
    }

    /**
     * Test method putDown().
     */
    public function testPutDownEmpty(): void
    {
        $output = $this->game->putDown($this->item);

        $this->assertIsString($output);
        $this->assertStringContainsString("empty", $output);
    }

    /**
     * Test method putDown().
     */
    public function testPutDownNotExist(): void
    {
        $noItem = (new Item())->setName("nothing");
        $this->game->pickUp($noItem);
        $output = $this->game->putDown($this->item);

        $this->assertIsString($output);
        $this->assertStringContainsString("not in the basket", $output);
    }

    /**
     * Test method putDown().
     */
    public function testPutDownExist(): void
    {
        $someItem = (new Item())->setName("something");
        $this->game->pickUp($someItem);
        $output = $this->game->putDown($someItem);

        $this->assertIsString($output);
        $this->assertStringContainsString("something", $output);
    }

    /**
     * Test method checkItemInBasket().
     */
    public function testCheckItemInBasket(): void
    {
        $this->assertFalse($this->game->checkItemInBasket("white board"));

        $output = $this->game->pickUp($this->item);
        $itemName = $this->item->getName();
        if ($itemName) {
            $this->assertStringContainsString($itemName, $output);
            $this->assertTrue($this->game->checkItemInBasket($itemName));
        }
    }

    /**
     * Test method inspect().
     */
    public function testInspectRoom(): void
    {
        $output = $this->game->inspect("school");

        $this->assertNotEmpty($output);
        $this->assertIsString($output);
        $this->assertStringContainsString("school", $output);
    }

    /**
     * Test method inspect().
     */
    public function testInspectItem(): void
    {
        $output = $this->game->inspect("white board");

        $this->assertNotEmpty($output);
        $this->assertIsString($output);
        $this->assertStringContainsString("white board", $output);
    }

    /**
     * Test method inspect().
     */
    public function testInspectBasketItem(): void
    {
        $newItem = (new Item())->setName("something")->setDescription("something in the school");
        $this->game->pickUp($newItem);
        $output = $this->game->inspect("something");

        $this->assertNotEmpty($output);
        $this->assertIsString($output);
        $this->assertStringContainsString("something", $output);
    }

    /**
     * Test method inspect().
     */
    public function testInspectEmptyInput(): void
    {
        $output = $this->game->inspect("");

        $this->assertNotEmpty($output);
        $this->assertIsString($output);
        $this->assertStringContainsString("inspect", $output);
    }
}
