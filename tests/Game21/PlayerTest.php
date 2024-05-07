<?php

namespace App\Game21;

use PHPUnit\Framework\TestCase;
use App\Card\Card;

/**
 * Test cases for class Player.
 */
class PlayerTest extends TestCase
{
    /**
     * @var Player $player
     */
    private $player;

    /**
     * @var string $suite
     */
    private $suite;

    /**
    * @var int $number
    */
    private $number;

    /**
     * Set ut for tests.
     */
    protected function setUp(): void
    {
        $this->player = new Player("player");
        $suites = ["diamonds", "clubs", "hearts", "spades"];
        $this->suite = $suites[array_rand($suites, 1)];
        $this->number = random_int(2, 10);
    }

    /**
     * Construct object and verify the default values are set correctly.
     */
    public function testCreateObject(): void
    {
        $this->assertInstanceOf("\App\Game21\Player", $this->player);
        $this->assertNotInstanceOf("\App\Game21\Bank", $this->player);
        $this->assertIsString($this->player->name);
    }

    /**
     * Test getHandCount() method and verify the output is an integer.
     */
    public function testGetHandCount(): void
    {
        $this->assertIsInt($this->player->getHandCount());
        $this->assertEquals(0, $this->player->getHandCount());
    }

    /**
     * Test addCard() method and verify the Card is added.
     */
    public function testAddCard(): void
    {
        $randInt = random_int(1, 52);

        for ($i = 0; $i < $randInt; $i++) {
            $card = new Card();
            $this->player->addCard($card);
        }

        $this->assertEquals($randInt, $this->player->getHandCount());
    }

    /**
     * Test getHandAsString() method and verify the output is an array of string.
     */
    public function testGetHandAsString(): void
    {
        $card = new Card($this->suite, $this->number);
        $this->player->addCard($card);

        $output = $this->player->getHandAsString();
        $this->assertIsArray($output);
        $this->assertContainsOnly('string', $output);
        $this->assertStringContainsString($this->suite, $output[0]);
        $this->assertStringContainsString(strval($this->number), $output[0]);
    }

    /**
     * Test getHandValues() method and verify the output is an array of an array of strings.
     */
    public function testGetHandValues(): void
    {
        $card = new Card($this->suite, $this->number);
        $this->player->addCard($card);

        $output = $this->player->getHandValues();
        $this->assertIsArray($output);
        $this->assertIsArray($output[0]);
        $this->assertContainsOnly('string', $output[0]);
        $this->assertContains($this->suite, $output[0]);
        $this->assertContains(strval($this->number), $output[0]);
    }

    /**
     * Test getHandColors() method and verify the output is an array of string.
     */
    public function testGetHandColors(): void
    {
        $color = "red";
        $card = new Card($this->suite, $this->number);
        $this->player->addCard($card);

        $output = $this->player->getHandColors();
        $this->assertIsArray($output);
        $this->assertContainsOnly('string', $output);

        if ($this->suite === "clubs" || $this->suite === "spades") {
            $color = "black";
        }

        $this->assertEquals($color, $output[0]);
    }
}
