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

    /**
     * The constructor that takes no parameters.
     * @return void
     */
    public function __construct()
    {
        $this->queue = [];
        $this->currentInQueue = 0;
    }

    /**
     * Method to initialize the $deck property with an instance of a DeckOfCards.
     */
    public function addCardDeck(DeckOfCards $deck): void
    {
        $this->deck = $deck;
    }

    /**
     * Method to add an instance of a Player to the $queue property.
     */
    public function addPlayer(Player $player): void
    {
        array_push($this->queue, $player);
    }

    /**
     * Method that return the current Player in the $queue.
     * @return Player
     */
    public function getCurrentPlayerInQueue()
    {
        return  $this->queue[$this->currentInQueue];
    }

    /**
     * Method to assign the next Player in $queue to $currentInQueue and return it.
     * @return Player
     */
    public function getNextPlayerInQueue()
    {
        if ($this->currentInQueue < count($this->queue)) {
            $this->currentInQueue += 1;
        }

        if ($this->currentInQueue >= count($this->queue)) {
            $this->currentInQueue = 0;
        }

        return $this->getCurrentPlayerInQueue();
    }

    /**
     * Method that returns an array with the string, color and value of all Cards in the currentInQueue's hand.
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
     * Method to remove a random Card from the $deck and add it to the $currentInQueue's hand. Returns $currentInQueue's hand.
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
     * Method that computes the total of the $currentInQueue's hand and returns the sum totals, for when ace has worth 1 and for ace has worth 14.
     * @return array<string, int>
     */
    protected function computeHandTotal(Player $player)
    {
        $handValues = $player->getHandValues();

        $sumTotals = ["ace is 1" => 0, "ace is 14" => 0];

        foreach ($handValues as $cardValues) {
            switch ($cardValues[1]) {
                case "ace":
                    $sumTotals["ace is 1"] += 1;
                    $sumTotals["ace is 14"] += 14;
                    break;
                case "king":
                    $sumTotals["ace is 1"] += 13;
                    $sumTotals["ace is 14"] += 13;
                    break;
                case "queen":
                    $sumTotals["ace is 1"] += 12;
                    $sumTotals["ace is 14"] += 12;
                    break;
                case "jack":
                    $sumTotals["ace is 1"] += 11;
                    $sumTotals["ace is 14"] += 11;
                    break;
                default:
                    $sumTotals["ace is 1"] += intval($cardValues[1]);
                    $sumTotals["ace is 14"] += intval($cardValues[1]);
            }
        }

        return $sumTotals;
    }

    /**
     * Method that checks which sum total from the method computeHantTotal() is more favorable for $currentInQueue's game.
     * @return int
     */
    public function getHandTotal(Player $player)
    {
        $sumTotals = $this->computeHandTotal($player);
        $result = $sumTotals["ace is 1"];

        if ($sumTotals["ace is 1"] < 21 && $sumTotals["ace is 14"] < 21) {
            $one = 21 - $sumTotals["ace is 1"];
            $fourteen = 21 - $sumTotals["ace is 14"];
            $result = $sumTotals["ace is 1"];

            if ($one > $fourteen) {
                $result = $sumTotals["ace is 14"];
            }
        }

        return $result;
    }

    /**
     * This method checks the win status of the game.
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

                if ($report[$player->name] <= 21) {
                    $winners[] = $player->name;
                }

                if($report[$player->name] > 21) {
                    $losers[] = $player->name;
                }

            }
        }

        if (count($winners) > 1) {
            $result = $this->returnWinnerAndloser($report);
            $winners = [$result["winner"]];
            $losers = [$result["loser"]];
        }

        if (empty($winners)) {
            $winners = [""];
            if (!empty($losers)) {
                $winners = ["bank"];
            }
        }

        if (empty($losers)) {
            $losers = [""];
        }

        return ["winner" => $winners[0], "loser" => $losers[0]];
    }

    /**
     * This method returns the winner and loser if all players scored under 21.
     * @param array<string, int> $report
     * @return array<string, string>
     */
    private function returnWinnerAndloser($report)
    {
        $diff = [];
        foreach ($report as $key => $value) {
            $diff[$key] = 21 - $value;
        }

        asort($diff);
        $ranked = array_keys($diff);
        $newWinner = $ranked[0];
        $newLoser = $ranked[1];

        if (count($diff) != count(array_unique($diff))) {
            $newWinner = "bank";
            unset($diff["bank"]);
            $rankedLosers = array_keys($diff);
            $newLoser = $rankedLosers[0];
        }

        return ["winner" => $newWinner, "loser" => $newLoser];
    }
}
