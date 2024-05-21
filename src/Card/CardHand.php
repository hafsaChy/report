<?php

namespace App\Card;

use App\Card\Card;

class CardHand
{
    /**
     * @var array<Card> $cards
     */
    protected $cards;

    public function __construct()
    {
        $this->cards = [];
    }

    public function add(Card $card): void
    {
        array_push($this->cards, $card);
    }

    public function remove(Card $card): void
    {
        $index = array_search($card, $this->cards);
        if ($index !== false) {
            unset($this->cards[$index]);
        }
    }


    // public function remove(Card $card): void
    // {
    //     $index = array_search($card, $this->cards);
    //     if ($index) {
    //         unset($this->cards[$index]);
    //     }
    // }

    public function shuffle(): void
    {
        // Shuffle the cards array
        shuffle($this->cards);
    }

    /**
     * @return int
     */
    public function getCount()
    {
        return count($this->cards);
    }

    /**
     * @var array<int, array<string>> $variable
     */
    public function getValues(): array
    {
        $values = [];
        foreach ($this->cards as $card) {
            $values[] = $card->getValue();
        }
        return $values;
    }

    /**
     * @return array<string>
     */
    public function getStrings(): array
    {
        $values = [];
        foreach ($this->cards as $card) {
            $values[] = $card->getAsString();
        }
        return $values;
    }

    /**
     * @return array<string>
     */
    public function getColors(): array
    {
        $values = [];
        foreach ($this->cards as $card) {
            $values[] = $card->getColor();
        }
        return $values;
    }

    /**
     * @return array<Card>
     */
    public function draw(int $number = 1): array
    {
        $randCards = [];
        $randIndexes = array_rand($this->cards, $number);

        if (is_array($randIndexes)) {
            foreach ($randIndexes as $idx) {
                array_push($randCards, $this->cards[$idx]);
                unset($this->cards[$idx]);
            }
        }

        if (is_int($randIndexes)) {
            array_push($randCards, $this->cards[$randIndexes]);
            unset($this->cards[$randIndexes]);
        }


        return $randCards;
    }
}
