<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class CardGraphic.
 */
class CardGraphicTest extends TestCase
{
    /**
     * Construct object with no arguments to check if the default values are set correctly.
     */
    public function testCreateObjectWithNoArguments(): void
    {
        $card = new CardGraphic();
        $this->assertInstanceOf("\App\Card\CardGraphic", $card);
        $this->assertEquals($card->minValue, 1);
        $this->assertEquals($card->maxValue, 13);
        $this->assertContains("diamonds", $card->suites);
        $this->assertContains("clubs", $card->suites);
        $this->assertContains("hearts", $card->suites);
        $this->assertContains("spades", $card->suites);
    }

    /**
     * Construct object without arguments to check if the output is a string.
     */
    public function testGetAsString(): void
    {
        $randSuite = "diamonds";
        $randNum = 10;
        $card = new CardGraphic($randSuite, $randNum);
        $res = $card->getAsString();
        $this->assertIsString($res);
        $this->assertEquals("127178;", $res);
    }
}
