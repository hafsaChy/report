<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class CardHand.
 */
class CardHandTest extends TestCase
{
    /**
     * Construct object with no arguments and verify if the default values are set correctly.
     */
    public function testCreateObjectWithNoArguments(): void
    {
        $cards = new CardHand();
        $cardsCount = $cards->getCount();
        $this->assertInstanceOf("\App\Card\CardHand", $cards);
        $this->assertEquals(0, $cardsCount);
    }

    /**
     * Test add() method and verify the added objects are in the $cards array.
     */
    public function testAddCard(): void
    {
        $cards = new CardHand();
        $card = new Card();
        $cards->add($card);
        $cardsCount = $cards->getCount();
        $this->assertEquals(1, $cardsCount);
    }

    /**
     * Test remove() method and verify if the removed objects are no longer in the $cards array.
     */
    public function testRemoveCard(): void
    {
        $cards = new CardHand();
        $card = new Card();
        $cards->add($card);
        $cards->remove($card);
        $cardsCount = $cards->getCount();
        $this->assertEquals(0, $cardsCount);
    }

    /**
     * Test getValues() method and verify if the output is a correct array of an array of strings.
     */
    public function testGetValues(): void
    {
        $cards = new CardHand();
        $randPoint = random_int(1, 52);
        $expOutput = [];

        for ($i = 0; $i < $randPoint; $i++) {
            $card = new Card();
            array_push($expOutput, $card->getValue());
            $cards->add($card);
        }

        $cardsValues = $cards->getValues();
        $this->assertCount($cards->getCount(), $expOutput);
        $this->assertCount($randPoint, $cardsValues);
        $this->assertIsArray($cardsValues);
        $this->assertIsArray($cardsValues[0]);
        $this->assertIsString($cardsValues[0][0]);
        $this->assertSame($expOutput, $cardsValues);
    }

    /**
     * Test getStrings() method and verify if the output is a correct array of strings.
     */
    public function testGetStrings(): void
    {
        $cards = new CardHand();
        $randPoint = random_int(1, 52);
        $expOutput = [];

        for ($i = 0; $i < $randPoint; $i++) {
            $card = new Card();
            array_push($expOutput, $card->getAsString());
            $cards->add($card);
        }

        $cardsAsStrings = $cards->getStrings();
        $this->assertCount($cards->getCount(), $expOutput);
        $this->assertCount($randPoint, $cardsAsStrings);
        $this->assertIsArray($cardsAsStrings);
        $this->assertIsString($cardsAsStrings[0]);
        $this->assertSame($expOutput, $cardsAsStrings);
    }

    /**
     * Test getColors() method and verify if the output is a correct array of strings.
     */
    public function testGetColors(): void
    {
        $cards = new CardHand();
        $randPoint = random_int(1, 52);
        $expOutput = [];

        for ($i = 0; $i < $randPoint; $i++) {
            $card = new Card();
            array_push($expOutput, $card->getColor());
            $cards->add($card);
        }

        $cardsColors = $cards->getColors();
        $this->assertCount($cards->getCount(), $expOutput);
        $this->assertCount($randPoint, $cardsColors);
        $this->assertIsArray($cardsColors);
        $this->assertIsString($cardsColors[0]);
        $this->assertSame($expOutput, $cardsColors);
    }

    /**
     * Test shuffle() method and verify if $cards are shuffled.
     */
    public function testShuffle(): void
    {
        $cards = new CardHand();
        $randPoint = random_int(1, 52);
        $expOutput = [];

        for ($i = 0; $i < $randPoint; $i++) {
            $card = new Card();
            array_push($expOutput, $card->getValue());
            $cards->add($card);
        }

        $this->assertSame($expOutput, $cards->getValues());
        $cards->shuffle();
        $this->assertNotSame($expOutput, $cards->getValues());
        $this->assertSameSize($expOutput, $cards->getValues());
    }

    /**
     * Test draw() method and verify the output is array of Card.
     */
    public function testDraw(): void
    {
        $cards = new CardHand();
        $testCards = [
            "hearts" => 5,
            "clubs" => 10,
            "spades" => 1,
            "diamonds" => 12
        ];

        foreach ($testCards as $key => $value) {
            $card = new Card($key, $value);
            $cards->add($card);
        }

        $drawnCard = $cards->draw();
        $this->assertCount(count($testCards) - 1, $cards->getStrings());
        $this->assertIsArray($drawnCard);
        $this->assertCount(1, $drawnCard);
        $this->assertInstanceOf("\App\Card\Card", $drawnCard[0]);
        $this->assertNotContains($drawnCard[0]->getAsString(), $cards->getStrings());


        $drawnCards = $cards->draw(3);
        $this->assertIsArray($drawnCards);
        $this->assertCount(3, $drawnCards);
        $this->assertContainsOnlyInstancesOf(
            "\App\Card\Card",
            $drawnCards
        );
    }
}
