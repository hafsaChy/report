<?php

namespace App\AdventureGame;

class Availables
{
    /**
     * This method returns a list of all allowed actions.
     * @return array<int, string>
     */
    public function availableActions()
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
    public function availableOptions()
    {
        $options = [
            "kitchen", "pantry", "garden", "farm", "south", "north",
            "east", "west","pizza", "chicken pizza", "flour",
            "pizza sauce","yeast", "salt", "ketchup", "pizza sauce",
            "chicken", "cheese", "eggs",
            "warm water", "cold water", "shrimp", "sugar", "curry",
            "jam", "vanilla", "cookies", "tomato", "capsicum", "coriander"
        ];

        return $options;
    }
}
