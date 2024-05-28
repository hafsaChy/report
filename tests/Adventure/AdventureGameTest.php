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
     * Test to verify the default values are set correctly
     */
    public function testCreateObject(): void
    {
        $this->assertInstanceOf("\App\AdventureGame\Game", $this->game);
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
     * Test method checkIngredients().
     */
    public function testCheckIngredients(): void
    {
        $ingredients = [
            "salt",
            "flour",
            "yeast",
            "pizza sauce",
            "capsicum",
            "tomato",
            "chicken",
            "cheese",
            "warm water"
        ];

        // basket is empty
        $this->assertFalse($this->game->checkIngredients());

        // basket contains some ingredients
        $flour = (new Item())->setName($ingredients[1]);
        $this->game->pickUp($flour);
        $this->assertFalse($this->game->checkIngredients());

        foreach ($ingredients as $ingredient) {
            $item = (new Item())->setName($ingredient);
            $this->game->pickUp($item);
        }
        $this->assertTrue($this->game->checkIngredients());
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

    /**
     * Test method getActions().
     */
    public function testGetActions(): void
    {
        $actions = $this->game->getActions();

        $this->assertNotEmpty($actions);
        $this->assertContains("bake", $actions);
        $this->assertContains("pick up", $actions);
        $this->assertContains("put back", $actions);
        $this->assertContains("inspect", $actions);
        $this->assertContains("go", $actions);
    }

    /**
     * Test method getOptions().
     */
    public function testGetOptions(): void
    {
        $options = $this->game->getOptions();
        $this->assertContains('kitchen', $options);
        $this->assertContains('capsicum', $options);
    }
}
