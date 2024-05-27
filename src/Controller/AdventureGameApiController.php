<?php

namespace App\Controller;

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

    #[Route('/proj/api/room', name: 'proj_api_room')]
    public function projectApiCurrentRoom(
        SessionInterface $session
    ): Response {
        $data = [
            "currentRoom" => "",
            "ItemsInRoom" => []
        ];

        if ($session->get("adventure")) {
            $game = $session->get("adventure");
            assert($game instanceof Game);
            $currentRoom = $game->getCurrentRoom();
            assert($currentRoom instanceof Room);
            $data["currentRoom"] = $currentRoom->getName();
            $data["ItemsInRoom"] = $game->getCurrentRoomItems();
        }

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route('/proj/api/directions', name: 'proj_api_directions')]
    public function projectApiDirections(
        SessionInterface $session
    ): Response {
        $data = [
            "currentRoom" => "",
            "directions" => ""
        ];

        if ($session->get("adventure")) {
            $game = $session->get("adventure");
            assert($game instanceof Game);
            $currentRoom = $game->getCurrentRoom();
            assert($currentRoom instanceof Room);
            $data["currentRoom"] = $currentRoom->getName();
            $data["directions"] = $game->getDirectionsAsString();
        }

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route('/proj/api/basket', name: 'proj_api_basket')]
    public function projectApiBasket(
        SessionInterface $session
    ): Response {
        $data = [
            "basket" => []
        ];

        if ($session->get("adventure")) {
            $game = $session->get("adventure");
            assert($game instanceof Game);
            $basket = $game->getBasket();

            foreach ($basket as $item) {
                assert($item instanceof AdventureItems);
                array_push($data["basket"], $item->getName());
            }
        }

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route('/proj/api/visited', name: 'proj_api_visited')]
    public function projectApiVisited(
        SessionInterface $session
    ): Response {
        $data = [
            "visitedRooms" => []
        ];

        if ($session->get("adventure")) {
            $game = $session->get("adventure");
            assert($game instanceof Game);
            $data["visitedRooms"] = $game->getVisitedRooms();
        }

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route('/proj/api/inspect', name: 'proj_api_inspect')]
    public function projectApiInspect(
        RoomRepository $roomRepository,
        ItemRepository $itemRepository,
        Request $request
    ): Response {
        $data = [
            "inspectedObject" => "",
            "description" => ""
        ];

        $input = (string) $request->request->get('object');
        $cleanedInput = strtolower(trim($input));

        if (empty($cleanedInput)) {
            $cleanedInput = "kitchen";
        }

        $data["inspectedObject"] = $cleanedInput;

        $object = $roomRepository->findOneBy(['name' => $cleanedInput]);

        if ($object) {
            assert($object instanceof Room);
            $data["description"] = $object->getInspect();
        }

        $object = $itemRepository->findOneBy(['name' => $cleanedInput]);

        if ($object) {
            assert($object instanceof AdventureItems);
            $data["description"] = $object->getDescription();
        }

        $response = new JsonResponse($data);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }
}
