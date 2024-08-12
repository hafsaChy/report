<?php

namespace App\Controller;

use App\AdventureGame\Availables;
use App\AdventureGame\Game;
use App\Entity\Item;
use App\Entity\Room;
use App\Repository\ItemRepository;
use App\Repository\RoomRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdventureGameController extends AbstractController
{
    #[Route('/proj/init/game', name: 'proj_init_game')]
    public function projectInitGame(
        RoomRepository $roomRepository,
        SessionInterface $session
    ): Response {
        $start = $roomRepository->findOneBy(['name' => 'kitchen']);

        if(!$start) {
            return new Response('Something is wrong in the database.');
        }

        $game = new Game($start, []);
        $session->set("adventure", $game);
        $session->set("action", "");
        $session->set("pizza", "");

        return $this->redirectToRoute('proj_game');
    }

    #[Route('/proj/play', name: 'proj_game')]
    public function projectPlay(
        SessionInterface $session
    ): Response {
        $data = [
            "place" => "",
            "image" => "",
            "description" => "",
            "directions" => "",
            "action" => "",
            "options" => [],
            "selectOptions" => [],
            "basket" => [],
            "gameEnd" => ""
        ];

        if (!$session->get("adventure")) {
            return $this->redirectToRoute('proj_init_game');
        }

        $avl = new Availables();
        $game = $session->get("adventure");
        assert($game instanceof Game);
        $currentRoom = $game->currentRoomName();

        assert($currentRoom instanceof Room);
        $data["place"] = $currentRoom->getName();
        $data["image"] = $currentRoom->getImage();
        $data["description"] = 'You are at '.$currentRoom->getDescription().'.';
        $data['directions'] = $game->getDirectionsDescription();
        $data['options'] = $avl->availableActions();
        $data['selectOptions'] = $avl->availableOptions();


        if ($session->get("action")) {
            $data["action"] = $session->get("action");
        }

        $basket = $game->basketItem();

        if (!empty($basket)) {
            foreach ($basket as $item) {
                assert($item instanceof Item);
                array_push($data["basket"], $item->getImage());
            }
        }

        if ($session->get("pizza")) {
            $data["gameEnd"] = $session->get("pizza");
        }

        return $this->render('adventure/game.html.twig', $data);
    }

    #[Route('/proj/game/input', name: 'proj_game_input', methods: 'POST')]
    public function projectGameInput(
        SessionInterface $session,
        Request $request
    ): Response {
        if (!$session->get("adventure")) {
            return $this->redirectToRoute('proj_init_game');
        }

        $game = $session->get("adventure");
        assert($game instanceof Game);
        $action = (string) $request->request->get('action');
        // $selectOptions = (string) $request->request->get('selectOptions');

        $input = (string) $request->request->get('input');
        $cleanedInput = strtolower(trim($input));
        $result = "";

        if ($action == "inspect") {
            $result = $game->inspectRoomOrItem($cleanedInput);
        }

        if (empty($cleanedInput)) {
            $cleanedInput = "none";
        }

        if ($action == "pick up") {
            return $this->redirectToRoute('proj_game_pickup', ['input' => $cleanedInput]);
        }

        if ($action == "put back") {
            return $this->redirectToRoute('proj_game_putback', ['input' => $cleanedInput]);

        }

        if ($action == "go") {
            return $this->redirectToRoute('proj_game_go', ['input' => $cleanedInput]);
        }

        if ($action == "bake") {
            return $this->redirectToRoute('proj_game_bake', ['input' => $cleanedInput]);

        }

        $session->set("adventure", $game);
        $session->set("action", $result);

        return $this->redirectToRoute('proj_game');
    }

    #[Route('/proj/game/bake/{input}', name: 'proj_game_bake', methods: 'GET')]
    public function projectGameBake(
        SessionInterface $session,
        string $input
    ): Response {
        if (!$session->get("adventure")) {
            return $this->redirectToRoute('proj_init_game');
        }

        $game = $session->get("adventure");
        assert($game instanceof Game);
        $currentRoom = $game->currentRoomName();
        assert($currentRoom instanceof Room);

        $ingredsOtherRooms = $game->checkIngredients();
        $result = "Your basket does not contain enough ingredients to bake anything here.";
        $alternatives = ["pizza", "chicken pizza"];
        if (in_array($input, $alternatives)) {
            $result = "Some ingredients are still missing to bake the ".$input.".";
        }
        if ($ingredsOtherRooms) {
            $result = "You gathered almost all the ingredients to bake the pizza. ";
            $result .= "Go back to the kitchen, pick up warm water from there and start baking.";
            if ($currentRoom->getName() == "kitchen") {
                $result = "Your pizza is done. Great job! Enjoy!";
                $session->set("pizza", "done");
            }
        }
        if ($input == "none") {
            $result = "You need to specify what you want to bake (for example 'pizza').";
        }

        $session->set("adventure", $game);
        $session->set("action", $result);

        return $this->redirectToRoute('proj_game');
    }

    #[Route('/proj/game/go/{input}', name: 'proj_game_go', methods: 'GET')]
    public function projectGameGo(
        RoomRepository $roomRepository,
        ItemRepository $itemRepository,
        SessionInterface $session,
        string $input
    ): Response {
        if (!$session->get("adventure")) {
            return $this->redirectToRoute('proj_init_game');
        }

        $game = $session->get("adventure");
        assert($game instanceof Game);
        $result = "";

        $locationAtDirection = $game->roomAccordingToDirection($input);
        if ($locationAtDirection) {
            $newPlace = $roomRepository->findOneBy(['name' => $locationAtDirection]);
            $items = $itemRepository->findBy(['room' => $locationAtDirection]);
            if ($newPlace and is_array($items)) {
                $game->setCurrentRoom($newPlace, $items);
            }
        }

        $session->set("adventure", $game);
        $session->set("action", $result);

        return $this->redirectToRoute('proj_game');
    }

    #[Route('/proj/game/pickup/{input}', name: 'proj_game_pickup', methods: 'GET')]
    public function projectGamePickup(
        ItemRepository $itemRepository,
        SessionInterface $session,
        string $input
    ): Response {
        if (!$session->get("adventure")) {
            return $this->redirectToRoute('proj_init_game');
        }

        $game = $session->get("adventure");
        assert($game instanceof Game);

        $items = $game->currentRoomItems();
        $result = "You look around, but there is no ".$input." to pick up in this place. ";
        if (in_array($input, $items)) {
            $itemToPickUp = $itemRepository->findOneBy(['name' => $input]);
            if ($itemToPickUp) {
                $result = $game->pickUpItem($itemToPickUp);
            }
        }
        if($input == "none") {
            $result = "You need to specify what you want to pick up.";
            $result .= " If you are not sure what you can pick up here, inspect the room first.";
        }

        $session->set("adventure", $game);
        $session->set("action", $result);

        return $this->redirectToRoute('proj_game');
    }

    #[Route('/proj/game/putback/{input}', name: 'proj_game_putback', methods: 'GET')]
    public function projectGamPutBack(
        ItemRepository $itemRepository,
        SessionInterface $session,
        string $input
    ): Response {
        if (!$session->get("adventure")) {
            return $this->redirectToRoute('proj_init_game');
        }

        $game = $session->get("adventure");
        assert($game instanceof Game);

        $itemIsInBasket = $game->checkItemInBasket($input);
        $result = "You are trying to put back the ".$input." from your basket";
        $result .= ", but there is no ".$input." in the basket.";
        if ($itemIsInBasket) {
            $itemToPutBack = $itemRepository->findOneBy(['name' => $input]);
            if ($itemToPutBack) {
                $result = $game->putBack($itemToPutBack);
            }
        }

        if($input == "none") {
            $result = "You need to specify what you want to put back.";
            $result .= " All items you have picked up are in your basket.";
        }

        $session->set("adventure", $game);
        $session->set("action", $result);

        return $this->redirectToRoute('proj_game');
    }
}
