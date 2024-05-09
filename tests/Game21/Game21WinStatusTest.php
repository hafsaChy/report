<?php

namespace App\Game21;

use PHPUnit\Framework\TestCase;
use App\Card\Card;
use App\Card\DeckOfCards;

/**
 * Test cases for CheckWinStatus method of class Game21.
 */
class Game21WinStatusTest extends TestCase
{
    /**
     * @var Game21 $game
     */
    private $game;

    /**
     * @var DeckOfCards $deck
     */
    private $deck;

    /**
     * Set up for the tests.
     */
    protected function setUp(): void
    {
        $this->game = new Game21();

        $this->deck = new DeckOfCards();
        $card = new Card();

        foreach ($card->suites as $suite) {
            for ($i = $card->minValue; $i <= $card->maxValue; $i++) {
                $this->deck->add(new Card($suite, $i));
            }
        }
    }

    /**
     * Test methods CheckWinStatus().
     * Case: Player's card total < 21 and bank's card total = 0
     */
    public function testNoLoserStatusYet(): void
    {
        $cards = [
            new Card("spades", 1),
            new Card("hearts", 9)
        ];

        $player = new Player("player");
        foreach ($cards as $card) {
            $player->addCard($card);
        }

        $bank = new Player("bank");

        $this->game->addPlayer($player);
        $this->game->addPlayer($bank);

        $output = $this->game->checkWinStatus();
        $this->assertIsArray($output);
        $this->assertContainsOnly('string', $output);
        $this->assertNotEquals("player", $output["loser"]);
        $this->assertNotEquals("bank", $output["loser"]);
    }

    /**
     * Test methods CheckWinStatus().
     * Case: Player's card total > 21 and bank's card total = 0
     */
    public function testPlayersHandTotalGreaterThan21(): void
    {
        $cards = [
            new Card("hearts", 13),
            new Card("clubs", 9)
        ];

        $player = new Player("player");
        foreach ($cards as $card) {
            $player->addCard($card);
        }

        $bank = new Player("bank");

        $this->game->addPlayer($player);
        $this->game->addPlayer($bank);

        $output = $this->game->checkWinStatus();
        $this->assertIsArray($output);
        $this->assertContainsOnly('string', $output);
        $this->assertEquals("player", $output["loser"]);
        $this->assertEquals("bank", $output["winner"]);
    }

    /**
     * Test methods CheckWinStatus().
     * Case: Player's card total < 21 and closer to 21 than bank
     */
    public function testPlayersHandTotalCloserTo21(): void
    {
        $cards = [
            new Card("diamonds", 1),
            new Card("clubs", 2)
        ];

        $player = new Player("player");
        foreach ($cards as $card) {
            $player->addCard($card);
        }

        $cards = [
            new Card("hearts", 6),
            new Card("hearts", 9)
        ];

        $bank = new Player("bank");
        foreach ($cards as $card) {
            $bank->addCard($card);
        }

        $this->game->addPlayer($player);
        $this->game->addPlayer($bank);

        $output = $this->game->checkWinStatus();
        $this->assertIsArray($output);
        $this->assertContainsOnly('string', $output);
        $this->assertEquals("player", $output["winner"]);
        $this->assertEquals("bank", $output["loser"]);
    }

    /**
     * Test methods CheckWinStatus().
     * Case: Player's card total < 21 and farther to 21 than bank
     */
    public function testBanksHandTotalCloserTo21(): void
    {
        $cards = [
            new Card("spades", 2),
            new Card("hearts", 2)
        ];

        $player = new Player("player");
        foreach ($cards as $card) {
            $player->addCard($card);
        }

        $cards = [
            new Card("spades", 1),
            new Card("clubs", 6)
        ];

        $bank = new Player("bank");
        foreach ($cards as $card) {
            $bank->addCard($card);
        }

        $this->game->addPlayer($player);
        $this->game->addPlayer($bank);

        $output = $this->game->checkWinStatus();
        $this->assertIsArray($output);
        $this->assertContainsOnly('string', $output);
        $this->assertEquals("player", $output["loser"]);
        $this->assertEquals("bank", $output["winner"]);
    }

    /**
     * Test methods CheckWinStatus().
     * Case: Player's card total < 21 and bank's card total > 21
     */
    public function testBanksHandTotalGreaterThan21(): void
    {
        $cards = [
            new Card("hearts", 10),
            new Card("clubs", 7)
        ];

        $player = new Player("player");
        foreach ($cards as $card) {
            $player->addCard($card);
        }

        $bank = new Player("bank");

        $cards = [
            new Card("spades", 13),
            new Card("spades", 11)
        ];

        foreach ($cards as $card) {
            $bank->addCard($card);
        }

        $this->game->addPlayer($player);
        $this->game->addPlayer($bank);

        $output = $this->game->checkWinStatus();
        $this->assertIsArray($output);
        $this->assertContainsOnly('string', $output);
        $this->assertEquals("player", $output["winner"]);
        $this->assertEquals("bank", $output["loser"]);
    }

    /**
     * Test methods CheckWinStatus().
     * Case: Player's card total < 21 and equal to bank's card total
     */
    public function testHandTotalEqual(): void
    {
        $cards = [
            new Card("diamonds", 10),
            new Card("spades", 6)
        ];

        $player = new Player("player");
        foreach ($cards as $card) {
            $player->addCard($card);
        }

        $cards = [
            new Card("hearts", 7),
            new Card("clubs", 9)
        ];

        $bank = new Player("bank");
        foreach ($cards as $card) {
            $bank->addCard($card);
        }

        $this->game->addPlayer($player);
        $this->game->addPlayer($bank);

        $output = $this->game->checkWinStatus();
        $this->assertIsArray($output);
        $this->assertContainsOnly('string', $output);
        $this->assertEquals("player", $output["loser"]);
        $this->assertEquals("bank", $output["winner"]);
    }
}
