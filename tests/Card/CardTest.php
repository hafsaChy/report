<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Card.
 */
class CardTest extends TestCase
{
    /**
     * Construct object with no arguments and verify if the default values are set correctly.
     */
    public function testCreateObjectWithNoArguments(): void
    {
        $card = new Card();
        $this->assertInstanceOf("\App\Card\Card", $card);
        $this->assertEquals($card->minValue, 1);
        $this->assertEquals($card->maxValue, 13);
        $this->assertContains("diamonds", $card->suites);
        $this->assertContains("clubs", $card->suites);
        $this->assertContains("hearts", $card->suites);
        $this->assertContains("spades", $card->suites);
    }

    /**
     * Construct object with arguments and verify if the default values are set correctly.
     */
    public function testCreateObjectWithArguments(): void
    {
        $suites = ["hearts", "spades", "diamonds", "clubs"];
        $randSuite = $suites[array_rand($suites, 1)];
        $randNum = random_int(1, 13);
        $card = new Card($randSuite, $randNum);
        $this->assertIsString($randSuite);
        $this->assertIsInt($randNum);
        $this->assertInstanceOf("\App\Card\Card", $card);
        $this->assertEquals($card->minValue, 1);
        $this->assertEquals($card->maxValue, 13);
        $this->assertContains("clubs", $card->suites);
        $this->assertContains("diamonds", $card->suites);
        $this->assertContains("hearts", $card->suites);
        $this->assertContains("spades", $card->suites);
    }

    /**
     * Test getValue() method and verify if the output is an array of strings.
     */
    public function testMethodReturningCardValue(): void
    {
        $suites = ["hearts", "spadea", "diamonds", "clubs"];
        $randSuite = $suites[array_rand($suites, 1)];
        $randNum = random_int(1, 13);
        $card = new Card($randSuite, $randNum);
        $value = $card->getValue();

        $cardValue = strval($randNum);

        if ($cardValue == "1") {
            $cardValue = "ace";
        }

        if ($cardValue == "11") {
            $cardValue = "jack";
        }

        if ($cardValue == "12") {
            $cardValue = "queen";
        }

        if ($cardValue == "13") {
            $cardValue = "king";
        }

        $this->assertIsArray($value);
        $this->assertCount(2, $value);
        $this->assertContainsOnly('string', $value);
        $this->assertContains($randSuite, $value);
        $this->assertNotContains($randNum, $value);
        $this->assertContains($cardValue, $value);
    }

    /**
     * Test getAsString() method and verify if the output is a string.
     */
    public function testGetAsString(): void
    {
        $suites = ["hearts", "spades", "diamonds", "clubs"];
        $randSuite = $suites[array_rand($suites, 1)];
        $randNum = random_int(1, 13);
        $card = new Card($randSuite, $randNum);
        $res = $card->getAsString();

        $this->assertIsString($res);
        $this->assertStringContainsString($randSuite, $res);
    }

    /**
     * Test getColor() method and verify if the output is a string.
     */
    public function testGetColor(): void
    {
        $suites = ["hearts", "spades", "diamonds", "clubs"];
        $randSuite = $suites[array_rand($suites, 1)];
        $randNum = random_int(1, 13);
        $card = new Card($randSuite, $randNum);
        $res = $card->getColor();

        $expColor = "red";
        if ($randSuite === "spades" || $randSuite === "clubs") {
            $expColor = "black";
        }

        $this->assertIsString($res);
        $this->assertEquals($expColor, $res);
    }

    /**
     * Test draw() method and verify if the output is correct.
     */
    public function testDraw(): void
    {
        $suites = ["hearts", "spades", "diamonds", "clubs"];
        $randSuite = $suites[array_rand($suites, 1)];
        $randNum = random_int(1, 13);
        $card = new Card($randSuite, $randNum);
        $afterDraw = $card->draw();

        $this->assertIsArray($afterDraw);
    }
}
