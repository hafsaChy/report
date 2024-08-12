<?php

namespace App\Controller;

use App\AdventureGame\Availables;
use App\AdventureGame\Game;
use App\Entity\Room;
use App\Entity\Item;
use App\Repository\ItemRepository;
use App\Repository\RoomRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class AdventureGameApiController extends AdventureGameController
{
    #[Route('/proj/api', name: 'proj_api')]
    public function projectApi(): Response
    {
        return $this->render('adventure/api.html.twig');
    }

    #[Route('/proj/api/room-item', name: 'proj_room_item')]
    public function projectApiRoomWithItem(SessionInterface $session): JsonResponse
    {
        $data = [
            "currentRoom" => "",
            "ItemsInRoom" => []
        ];

        $game = $session->get("adventure");
        if (!$game) {
            return new JsonResponse(['message' => 'Game session not found.'], Response::HTTP_NOT_FOUND);
        }

        assert($game instanceof Game);
        $currentRoom = $game->currentRoomName();
        assert($currentRoom instanceof Room);
        $data["currentRoom"] = $currentRoom->getName();
        $data["ItemsInRoom"] = $game->currentRoomItems();


        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route('/proj/api/directions', name: 'proj_directions')]
    public function projectApiDirections(
        SessionInterface $session
    ): JsonResponse {
        $data = [
            "currentRoom" => "",
            "directions" => ""
        ];

        /** @var Game|null $game */
        $game = $session->get("adventure");

        if (!$game) {
            return new JsonResponse(['message' => 'Game session not found.'], Response::HTTP_NOT_FOUND);
        }

        $currentRoom = $game->currentRoomName();
        $data["currentRoom"] = $currentRoom->getName();
        $data["directions"] = $game->getDirectionsDescription();

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route('/proj/api/actions', name: 'proj_actions', methods: ['GET'])]
    public function projApiAvailableActions(SessionInterface $session): JsonResponse
    {
        if (!$session->get("adventure")) {
            return new JsonResponse(['message' => 'Game session not found.'], Response::HTTP_NOT_FOUND);
        }

        $avl = new Availables();
        $actions = $avl->availableActions();
        return new JsonResponse(['actions' => $actions]);
    }

    #[Route('/proj/api/inspect', name: 'proj_inspect', methods: ['POST'])]
    public function projectApiInspect(
        SessionInterface $session,
        RoomRepository $roomRepository,
        ItemRepository $itemsRepository,
        Request $request
    ): Response {
        $data = [
            "object" => "",
            "description" => ""
        ];

        $game = $session->get("adventure");
        assert($game instanceof Game);

        $input = (string) $request->request->get('input');
        $cleanedInput = strtolower(trim($input));

        if (empty($cleanedInput)) {
            $cleanedInput = "none";
        }

        $data["object"] = $cleanedInput;

        $room = $roomRepository->findOneBy(['name' => $cleanedInput]);
        $item = $itemsRepository->findOneBy(['name' => $cleanedInput]);

        if ($room) {
            assert($room instanceof Room);
            $data["description"] = $room->getInspect();
            error_log("Room found: " . $room->getName());
        }

        if ($item) {
            assert($item instanceof Item);
            $data["description"] = $item->getDescription();
            error_log("Item found: " . $item->getName());
        }

        if (!$room && !$item) {
            $data["description"] = "Object not found.";
            error_log("Object not found for input: " . $cleanedInput);
        }

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route('/proj/api/basket', name: 'proj_basket', methods: ['GET'])]
    public function projectApiBasket(SessionInterface $session): JsonResponse
    {
        $data = [
            "basket" => []
        ];

        $game = $session->get("adventure");
        if(!$game) {
            return new JsonResponse(['message' => 'Game session not found.'], Response::HTTP_NOT_FOUND);
        }

        assert($game instanceof Game);
        $basket = $game->basketItem();

        foreach ($basket as $item) {
            assert($item instanceof Item);
            array_push($data["basket"], $item->getName());
        }

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route('/proj/api/visited', name: 'proj_visited')]
    public function projectApiVisited(
        SessionInterface $session
    ): JsonResponse {
        $data = [
            "roomsVisited" => []
        ];

        if ($session->get("adventure")) {
            $game = $session->get("adventure");
            assert($game instanceof Game);
            $data["roomsVisited"] = $game->visitedRooms();
        }

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }
}
