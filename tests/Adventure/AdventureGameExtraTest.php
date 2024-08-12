<?php

namespace App\AdventureGame;

use App\Entity\Room;
use App\Entity\Item;
use PHPUnit\Framework\TestCase;

/**
 * Extra more Test cases for Game class
 */
class AdventureGameExtraTest extends TestCase
{
    /**
     * @var Game $game
     */
    protected $game;

    /**
     * @var Availables $avl
     */
    protected $avl;

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
        $this->avl = new Availables();
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
        $this->game->pickUpItem($flour);
        $this->assertFalse($this->game->checkIngredients());

        foreach ($ingredients as $ingredient) {
            $item = (new Item())->setName($ingredient);
            $this->game->pickUpItem($item);
        }
        $this->assertTrue($this->game->checkIngredients());
    }

    /**
     * Test method availableActions().
     */
    public function testAvailableActions(): void
    {
        $actions = $this->avl->availableActions();

        $this->assertNotEmpty($actions);
        $this->assertContains("bake", $actions);
        $this->assertContains("pick up", $actions);
        $this->assertContains("put back", $actions);
        $this->assertContains("inspect", $actions);
        $this->assertContains("go", $actions);
    }

    /**
     * Test method availableOptions().
     */
    public function testAvailableOptions(): void
    {
        $options = $this->avl->availableOptions();
        $this->assertContains('kitchen', $options);
        $this->assertContains('capsicum', $options);
    }
}
