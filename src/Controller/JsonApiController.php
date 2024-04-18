<?php

namespace App\Controller;

use App\Card\Card;
use App\Card\CardHand;
use App\Card\DeckOfCards;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class JsonApiController extends AbstractController
{
    #[Route("/api/quote", name:"quote")]
    public function jsonQuote(): Response
    {
        date_default_timezone_set('Europe/Stockholm');
        $quote = ["Whatever you are, be a good one.",
        "Be yourself; everyone else is already taken.",
        "Act as if what you do makes a difference.",
        "The only real mistake is the one from which we learn nothing.",
        "Positive anything is better than negative nothing.",
        "Limit your 'always' and your 'nevers'."];
        $quotetoday = $quote[random_int(0, 5)];

        $data = [

            'Time' => date("Y/m/d H:i:s"),
            'Quote' => $quotetoday
        ];

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route("/api/deck/init", name: "api_deck_init")]
    public function initCallback(
        SessionInterface $session
    ): Response {
        $card = new Card();
        $deck = new DeckOfCards();

        foreach ($card->suites as $suite) {
            for ($i = $card->minValue; $i <= $card->maxValue; $i++) {
                $deck->add(new Card($suite, $i));
            }
        }

        $session->set("deck", $deck);

        return $this->redirectToRoute('api_deck_get');
    }

    #[Route("/api/deck", name: "api_deck_get", methods: ['GET'])]
    public function apiDeckGet(
        SessionInterface $session
    ): Response {
        $deck = $session->get("deck");

        $data = [
            "DeckSize" => 0,
            "CardsInDeck" => [],
            "CardColors" => []
        ];

        if ($deck instanceof DeckOfCards) {
            $data = [
                "DeckSize" => $deck->getCount(),
                "CardsInDeck" => $deck->getStrings(),
                "CardColors" => $deck->getColors()
            ];
        }

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route("/api/deck/shuffle", name: "api_deck_shuffle_post", methods: ['POST'])]
    public function apiDeckShufflePost(
        SessionInterface $session
    ): Response {
        $deck = $session->get("deck");

        if ($deck instanceof DeckOfCards) {
            $deck->shuffle();
        }

        $session->set("deck", $deck);

        return $this->redirectToRoute('api_deck_get');
    }


    #[Route("/api/deck/draw", name: "api_deck_draw_post", methods: ['POST'])]
    public function apiDeckDrawPost(
        SessionInterface $session
    ): Response {
        $deck = $session->get("deck");

        $deckSize = 0;

        if ($deck instanceof DeckOfCards) {
            $deckSize = $deck->getCount();

            if ($deckSize >= 1) {
                $randomCards = new CardHand();
                $randomCard = $deck->draw();
                $randomCards->add($randomCard[0]);

                $session->set("drawn_cards", $randomCards);
                $session->set("deck", $deck);
                return $this->redirectToRoute('api_deck_draw_get');
            }
        }

        return $this->redirectToRoute('api_deck_init');
    }

    #[Route("/api/deck/draw/num", name: "api_deck_draw_num_post", methods: ["POST"])]
    public function apiDeckDrawNumPost(
        Request $request,
        SessionInterface $session
    ): Response {

        $num = (int) $request->request->get('num');

        $deck = $session->get("deck");

        // Draw random cards
        if (!$num) {
            $num = 1; // check this again
        }


        if ($deck instanceof DeckOfCards) {
            $deckSize = $deck->getCount();

            if ($deckSize >= $num) {
                $randomCards = new Cardhand();
                $randomCardsFromDeck = $deck->draw($num);

                foreach ($randomCardsFromDeck as $randCard) {
                    $randomCards->add($randCard);
                }

                $session->set("drawn_cards", $randomCards);
                $session->set("deck", $deck);

                return $this->redirectToRoute('api_deck_draw_get');
            }
        }

        return $this->redirectToRoute('api_deck_init');
    }

    #[Route("/api/deck/draw", name: "api_deck_draw_get", methods: ['GET'])]
    public function apiDeckDrawGet(
        SessionInterface $session
    ): Response {
        $deck = $session->get("deck");
        $drawnCards = $session->get("drawn_cards");

        $data = [
            "DeckSize" => 0,
            "CardsDrawn" => [],
            "CardsColor" => []
        ];

        if ($deck instanceof DeckOfCards) {
            $data = [
                "DeckSize" => $deck->getCount(),
            ];
        }

        if ($drawnCards instanceof CardHand) {
            $data["CardsDrawn"] = $drawnCards->getStrings();
            $data["CardsColor"] = $drawnCards->getColors();
        }

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }
}
