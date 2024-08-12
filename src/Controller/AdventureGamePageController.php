<?php

namespace App\Controller;

// use App\AdventureGame\Game;
// use App\Entity\Item;
// use App\Entity\Room;
// use App\Repository\ItemRepository;
// use App\Repository\RoomRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdventureGamePageController extends AbstractController
{
    #[Route('/proj', name: 'proj_home')]
    public function projectHome(): Response
    {
        return $this->render('adventure/index.html.twig');
    }

    #[Route('/proj/about', name: 'proj_about')]
    public function projectAbout(): Response
    {
        return $this->render('adventure/about.html.twig');
    }

    #[Route('/proj/about/database', name: 'proj_about_db')]
    public function projectAboutDb(): Response
    {
        return $this->render('adventure/database.html.twig');
    }

    #[Route('/proj/bakepizza', name: 'proj_cheatsheet')]
    public function projectCheat(): Response
    {
        return $this->render('adventure/bake-cheatsheet.html.twig');
    }
}
