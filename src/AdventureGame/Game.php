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
     * The visited rooms.
     * @var string[]
     */
    protected $visitedRoom;

    /**
     * The items in the basket.
     * @var Item[]
     */
    protected $basket;

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
            $this->visitedRoom = [$startLocation->getName()];
        }
    }

    /**
     * This method retrieves the current room as an object.
     * @return Room
     */
    public function currentRoomName(): Room
    {
        return $this->currentRoom;
    }

    /**
     * This method retrieves all items in the room and returns them as an array of strings.
     * @return string[]|null[]
     */
    public function currentRoomItems(): array
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
     * @param Room $newRoom
     * @param array<int,Item> $items
     * @return void
     */
    public function setCurrentRoom($newRoom, $items)
    {
        $newRoomName = $newRoom->getName();

        $this->currentRoom = $newRoom;
        $this->currentItems = $items;

        if (!in_array($newRoomName, $this->visitedRoom)) {
            array_push($this->visitedRoom, $newRoomName);
        }
    }

    /**
     * This method provides an array of all visited rooms.
     * @return string[]
     */
    public function visitedRooms(): array
    {
        return $this->visitedRoom;
    }


    /**
     * This method generates a string listing all the possible directions from the current location.
     * @return string
     */
    public function getDirectionsDescription(): string
    {
        $message = "From here you can go ";
        $directions = $this->getAvailableDirections();

        if (count($directions) === 0) {
            return $message . "nowhere.";
        }

        $strings = [];

        foreach ($directions as $direction) {
            $locationName = $this->roomAccordingToDirection($direction);
            $strings[] = "{$direction} to the {$locationName}";
        }

        if (count($strings) === 1) {
            $message .= " " . $strings[0] . ".";
        }

        if (count($strings) > 1) {
            $lastDirection = array_pop($strings);
            $message .= implode(", ", $strings);
            $message .= ", or {$lastDirection}.";
        }

        return $message;
    }


    /**
     * This method returns an array of the possible directions.
     * @return string[]
     */
    private function getAvailableDirections(): array
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
     * This method returns the name of the place/room in the given direction.
     * @param string $input
     * @return string|null
     */
    public function roomAccordingToDirection(string $input)
    {
        $directions = $this->getAvailableDirections();

        if (!(in_array($input, $directions))) {
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
    public function inspectRoomOrItem(string $object)
    {
        $result = "Inspection of '".$object."' is not possible. Try something else.";

        if (empty($object)) {
            $result = "Please specify what you want to inspect. ";
            $result .= "For example, 'inspect ".$this->currentRoom->getName()."'";
        } elseif ($object == $this->currentRoom->getName()) {
            $result = "You scan the area... ";
            $result .= $this->currentRoom->getInspect();
        } elseif (in_array($object, $this->currentRoomItems())) {
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
    public function pickUpItem(Item $item)
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
    public function putBack(Item $item)
    {
        $message = "The basket is empty.";

        if (count($this->basket) > 0) {
            $itemName = $item->getName();
            $message = "The ".$itemName." is not available in the basket.";

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
    public function basketItem()
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
