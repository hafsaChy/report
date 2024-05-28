<?php

namespace App\AdventureGame;

use App\Entity\Item;
use App\Entity\Room;

class Game
{
    /**
     * The current room.
     * @var Room
     */
    protected $currentRoom;

    /**
     * The items currently in the room.
     * @var Item[]
     */
    protected $currentItems;

    /**
     * The items in the basket.
     * @var Item[]
     */
    protected $basket;

    /**
     * The visited locations.
     * @var string[]
     */
    protected $visited;

    /**
     * Constructs a new instance with a starting location and items.
     * @param Room $startLocation The starting location.
     * @param Item[] $items An array of items.
     * @return void
     */
    public function __construct(Room $startLocation, array $items)
    {
        $this->currentRoom = $startLocation;
        $this->currentItems = $items;
        $this->basket = [];
        if ($startLocation->getName()) {
            $this->visited = [$startLocation->getName()];
        }
    }

    /**
     * This method retrieves the current location as an object.
     * @return Room
     */
    public function getCurrentRoom(): Room
    {
        return $this->currentRoom;
    }


    /**
     * This method retrieves all items in the room and returns them as an array of strings.
     * @return string[]|null[]
     */
    public function getCurrentRoomItems(): array
    {
        $items = [];

        if (!empty($this->currentItems)) {
            foreach ($this->currentItems as $item) {
                $items[] = $item->getName();
            }
        }

        return $items;
    }


    /**
     * This method updates class properties with given arguments.
     * @param Room $newLocation
     * @param array<int,Item> $items
     * @return void
     */
    public function setRoomTo($newLocation, $items)
    {
        $newLocationName = $newLocation->getName();

        $this->currentRoom = $newLocation;
        $this->currentItems = $items;

        if (!in_array($newLocationName, $this->visited)) {
            array_push($this->visited, $newLocationName);
        }
    }

    /**
     * This method provides an array of all visited locations.
     * @return string[]
     */
    public function getVisitedRooms(): array
    {
        return $this->visited;
    }


    /**
     * This method generates a string listing all the possible directions from the current location.
     * @return string
     */
    public function getDirectionsAsString(): string
    {
        $message = "From here you can go ";
        $directions = $this->getDirections();

        if (count($directions) === 0) {
            return $message . "nowhere.";
        }

        $strings = [];

        foreach ($directions as $direction) {
            $locationName = $this->getLocationOfDirection($direction);
            $strings[] = "{$direction} to the {$locationName}";
        }

        if (count($strings) > 1) {
            $lastDirection = array_pop($strings);
            $message .= implode(", ", $strings);
            $message .= ", or {$lastDirection}.";
        } else {
            $message .= $strings[0] . ".";
        }

        return $message;
    }


    /**
     * This method returns an array of the possible directions.
     * @return string[]
     */
    public function getDirections(): array
    {
        $directions = [];

        if ($this->currentRoom->getNorth() != "null") {
            $directions[] = "north";
        }

        if ($this->currentRoom->getEast() != "null") {
            $directions[] = "east";
        }

        if ($this->currentRoom->getSouth() != "null") {
            $directions[] = "south";
        }

        if ($this->currentRoom->getWest() != "null") {
            $directions[] = "west";
        }

        return $directions;
    }


    /**
     * This method checks if the input is a valid direction.
     * @param string $input
     * @return bool
     */
    public function checkValidDirection(string $input): bool
    {
        $directions = $this->getDirections();
        return in_array($input, $directions);
    }

    /**
     * This method returns the name of the place/room in the given direction.
     * @param string $input
     * @return string|null
     */
    public function getLocationOfDirection(string $input)
    {
        if (!$this->checkValidDirection($input)) {
            return null;
        }

        switch ($input) {
            case 'north':
                return $this->currentRoom->getNorth();
            case 'east':
                return $this->currentRoom->getEast();
            case 'south':
                return $this->currentRoom->getSouth();
            case 'west':
                return $this->currentRoom->getWest();
            default:
                return null;
        }
    }


    /**
     * This method returns a list of all allowed actions.
     * @return array<int, string>
     */
    public function getActions()
    {
        $actions = [
            "inspect",
            "pick up",
            "put back",
            "go",
            "bake"
        ];

        return $actions;
    }

    /**
     * This method returns a list of all allowed options.
     * @return array<int, string>
     */
    public function getOptions()
    {
        $options = [
            "kitchen", "pantry", "garden", "farm", "flour",
            "pizza sauce","yeast", "salt", "south", "north",
            "east", "west","pizza", "chicken pizza", "tomato",
            "ketchup", "pizza sauce", "chicken", "cheese", "eggs",
            "warm water", "cold water", "shrimp", "sugar", "curry",
            "jam", "vanilla", "cookies", "capsicum", "coriander"
        ];

        return $options;
    }

    /**
     * This method checks if the basket contains all the ingredients required for the pizza.
     * @return boolean
     */
    public function checkIngredients()
    {
        $requiredIngredients = [
            "salt",
            "yeast",
            "warm water",
            "chicken",
            "pizza sauce",
            "cheese",
            "tomato",
            "capsicum",
            "flour"
        ];

        $ingredientsInBasket = array_map(function ($item) {
            return $item->getName();
        }, $this->basket);

        foreach ($requiredIngredients as $ingredient) {
            if (!in_array($ingredient, $ingredientsInBasket)) {
                return false;
            }
        }

        return true;
    }


    /**
     * This method generates descriptive text when a player inspects a room or an object
     * @return string
     */
    public function inspect(string $object)
    {
        $result = "You cannot inspect '".$object."'. Try something else.";

        if (empty($object)) {
            $result = "You need to specify what you want to inspect. ";
            $result .= "For example, 'inspect ".$this->currentRoom->getName()."'";
        } elseif ($object == $this->currentRoom->getName()) {
            $result = "You look around... ";
            $result .= $this->currentRoom->getInspect();
        } elseif (in_array($object, $this->getCurrentRoomItems())) {
            foreach ($this->currentItems as $item) {
                if ($item->getName() == $object) {
                    $result = "You see ";
                    $result .= $item->getDescription().".";
                }
            }
        } elseif ($this->checkItemInBasket($object)) {
            foreach ($this->basket as $item) {
                if ($item->getName() == $object) {
                    $result = "In your basket, you have ";
                    $result .= $item->getDescription().".";
                }
            }
        }

        return $result;
    }

    /**
     * This method adds the given item to the basket.
     * @return string
     */
    public function pickUp(Item $item)
    {
        $message = "The basket is full.";

        if (count($this->basket) < 9) {
            $itemName = $item->getName();
            $message = "You already have picked up ".$itemName.".";

            if (!in_array($item, $this->basket)) {
                array_push($this->basket, $item);
                $message = "You have picked up the ".$itemName.".";
            }
        }

        return $message;
    }

    /**
     * This method removes the given item from the basket.
     * @return string
     */
    public function putDown(Item $item)
    {
        $message = "The basket is empty.";

        if (count($this->basket) > 0) {
            $itemName = $item->getName();
            $message = "The ".$itemName." are not in the basket.";

            if (in_array($item, $this->basket)) {
                $key = array_search($item, $this->basket);
                unset($this->basket[$key]);
                $message = "You put back the ".$itemName.".";
            }
        }

        return $message;
    }

    /**
     * This method returns the content of the basket as an array.
     * @return array<int, object>
     */
    public function getBasket()
    {
        return $this->basket;
    }

    /**
     * This method returns True if the given item is in the basket.
     * @return boolean
     */
    public function checkItemInBasket(string $input)
    {
        $valid = false;

        if (count($this->basket) > 0) {
            foreach ($this->basket as $item) {
                $itemName = $item->getName();
                if ($itemName == $input) {
                    $valid = true;
                }
            }
        }

        return $valid;
    }
}
