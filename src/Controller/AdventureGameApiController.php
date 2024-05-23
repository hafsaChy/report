<?php

namespace App\Controller;

// use App\AdventureGame\Game;
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
}