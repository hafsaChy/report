<?php

namespace App\Card;

class CardGraphic extends Card
{
    /**
     * @var array<string, string> $representation
     */
    private $representation = [
        "clubs ace" => '127185;',
        "clubs 2" => '127186;',
        "clubs 3" => '127187;',
        "clubs 4" => '127188;',
        "clubs 5" => '127189;',
        "clubs 6" => '127190;',
        "clubs 7" => '127191;',
        "clubs 8" => '127192;',
        "clubs 9" => '127193;',
        "clubs 10" => '127194;',
        "clubs jack" => '127195;',
        "clubs queen" => '127197;',
        "clubs king" => '127198;',
        "diamonds ace" => '127169;',
        "diamonds 2" => '127170;',
        "diamonds 3" => '127171;',
        "diamonds 4" => '127172;',
        "diamonds 5" => '127173;',
        "diamonds 6" => '127174;',
        "diamonds 7" => '127175;',
        "diamonds 8" => '127176;',
        "diamonds 9" => '127177;',
        "diamonds 10" => '127178;',
        "diamonds jack" => '127179;',
        "diamonds queen" => '127181;',
        "diamonds king" => '127182;',
        "hearts ace" => '127153;',
        "hearts 2" => '127154;',
        "hearts 3" => '127155;',
        "hearts 4" => '127156;',
        "hearts 5" => '127157;',
        "hearts 6" => '127158;',
        "hearts 7" => '127159;',
        "hearts 8" => '127160;',
        "hearts 9" => '127161;',
        "hearts 10" => '127162;',
        "hearts jack" => '127163;',
        "hearts queen" => '127165;',
        "hearts king" => '127166;',
        "spades ace" => '127137;',
        "spades 2" => '127138;',
        "spades 3" => '127139;',
        "spades 4" => '127140;',
        "spades 5" => '127141;',
        "spades 6" => '127142;',
        "spades 7" => '127143;',
        "spades 8" => '127144;',
        "spades 9" => '127145;',
        "spades 10" => '127146;',
        "spades jack" => '127147;',
        "spades queen" => '127149;',
        "spades king" => '127150;'
    ];

    public function __construct(
        string $suite = null,
        int $number = null
    ) {
        parent::__construct($suite, $number);
    }

    /**
     * @return string
     */
    public function getAsString()
    {
        return $this->representation[join(" ", $this->value)];
    }
}
