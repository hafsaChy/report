<?php

namespace App\Game21;

use App\Game21\Player;
use App\Card\DeckOfCards;

use function PHPUnit\Framework\isInstanceOf;

class Game21
{
    /**
     * @var array<Player> $queue
     */
    protected $queue;

    /**
     * @var int $currentInQueue
     */
    protected $currentInQueue;

    /**
     * @var DeckOfCards $deck
     */
    protected $deck;

    public function __construct()
    {
        $this->queue = [];
        $this->currentInQueue = 0;
    }

    public function addCardDeck(DeckOfCards $deck): void
    {
        $this->deck = $deck;
    }

    public function addPlayer(Player $player): void
    {
        array_push($this->queue, $player);
    }

    // public function removePlayer(Player $player): void

    /**
     * @return Player
     */
    public function getCurrentPlayerInQueue()
    {
        return  $this->queue[$this->currentInQueue];
    }

    /**
     * @return Player
     */
    public function getNextPlayerInQueue()
    {
        //
        if ($this->currentInQueue < count($this->queue)) {
            $this->currentInQueue += 1;
        }

        if ($this->currentInQueue >= count($this->queue)) {
            $this->currentInQueue = 0;
        }

        return $this->getCurrentPlayerInQueue();
    }

    /**
     * @return array<string, array<int, string>>
     */
    public function getPlayerHand()
    {
        $currentPlayer = $this->queue[$this->currentInQueue];
        $currentHand = [];

        if ($currentPlayer instanceof Player) {
            $cardStrings = $currentPlayer->getHandAsString();
            $cardColors = $currentPlayer->getHandColors();
            $cardValues = $currentPlayer->getHandValues();
            $cardTotal = $currentPlayer->getHandCount();

            for ($i = 0; $i < $cardTotal; $i++) {
                $currentHand[$cardStrings[$i]] = [$cardColors[$i], implode(" ", $cardValues[$i])];
            }
        }

        return $currentHand;
    }

    /**
     * @return array<string, array<int, string>>
     */
    public function drawNewCard(int $num = 1)
    {
        $currentPlayer = $this->queue[$this->currentInQueue];

        $drawnCards = $this->deck->draw($num);

        $drawnCardsLength = count($drawnCards);

        for ($i = 0; $i < $drawnCardsLength; $i++) {
            $currentPlayer->addCard($drawnCards[$i]);
        }

        return $this->getPlayerHand();
    }

    /**
     * @return array<string, int>
     */
    protected function computeHandTotal(Player $player)
    {
        $handValues = $player->getHandValues();

        $sumTotals = ["ess is 1" => 0, "ess is 14" => 0];

        foreach ($handValues as $cardValues) {
            switch ($cardValues[1]) {
                case "ess":
                    $sumTotals["ess is 1"] += 1;
                    $sumTotals["ess is 14"] += 14;
                    break;
                case "kung":
                    $sumTotals["ess is 1"] += 13;
                    $sumTotals["ess is 14"] += 13;
                    break;
                case "dam":
                    $sumTotals["ess is 1"] += 12;
                    $sumTotals["ess is 14"] += 12;
                    break;
                case "knekt":
                    $sumTotals["ess is 1"] += 11;
                    $sumTotals["ess is 14"] += 11;
                    break;
                default:
                    $sumTotals["ess is 1"] += intval($cardValues[1]);
                    $sumTotals["ess is 14"] += intval($cardValues[1]);
            }
        }

        return $sumTotals;
    }

    /**
     * @return int
     */
    public function getHandTotal(Player $player)
    {
        $sumTotals = $this->computeHandTotal($player);
        $result = $sumTotals["ess is 1"];

        if ($sumTotals["ess is 1"] > 21 && $sumTotals["ess is 14"] < 21) {
            $result = $sumTotals["ess is 14"];
        }

        if ($sumTotals["ess is 1"] < 21 && $sumTotals["ess is 14"] < 21) {
            $one = 21 - $sumTotals["ess is 1"];
            $fourteen = 21 - $sumTotals["ess is 14"];
            $result = $sumTotals["ess is 1"];

            if ($one > $fourteen) {
                $result = $sumTotals["ess is 14"];
            }
        }

        return $result;
    }

        /**
     * @return array<string, string>
     */
    public function checkWinStatus()
    {
        $report = [];
        $winners = [];
        $losers = [];

        foreach ($this->queue as $player) {
            if ($player->getHandCount() > 0) {
                $report[$player->name] = $this->getHandTotal($player);
            }
        }

        foreach ($report as $key=>$value) {
            if ($value <= 21) {
                array_push($winners, $key);
            }

            if ($value > 21) {
                array_push($losers, $key);
            }
        }

        if (count($winners) > 1) {
            $diff = [];
            foreach ($report as $key=>$value) {
                $diff[$key] = 21 - $value;
            }

            asort($diff);
            $ranked = array_keys($diff);
            $winners = [$ranked[0]];
            $losers = [$ranked[1]];

            if (count($diff) != count(array_unique($diff))) {
                $winners = ["bank"];
                unset($diff["bank"]);
                $losers = array_keys($diff);
            }
        }

        if (count($winners) == 0) {
            $winners = [""];
            if (count($losers) > 0) {
                $winners = ["bank"];
            }
        }

        if (count($losers) == 0) {
            $losers = [""];
        }

        return ["winner" => $winners[0], "loser" => $losers[0]];
    }
}
