<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class SessionController extends AbstractController
{
    #[Route("/session", name: "session_show")]
    public function show(SessionInterface $session): Response
    {
        // Retrieve session data
        $sessionData = $session->all();

        return $this->render('session/show.html.twig', [
            'sessionData' => $sessionData,
        ]);
    }

    #[Route("/session/delete", name: "session_delete")]
    public function delete(SessionInterface $session): Response
    {
        $session->clear();

        // Add flash notification
        $this->addFlash('success', 'Session data has been deleted.');

        return $this->redirectToRoute('session_show');
    }
}
