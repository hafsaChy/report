<?php

namespace App\Controller;

use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class JsonBookApiController extends AbstractController
{
    #[Route("/api/library/books", name: "api_library")]
    public function apiLibrary(
        BookRepository $bookRepository
    ): Response {
        $books = $bookRepository->findAll();

        $response = $this->json($books);
        $response->setEncodingOptions(
            $response->getEncodingOptions() | JSON_PRETTY_PRINT
        );
        return $response;
    }

    #[Route("/api/library/book", name: "api_book_post_isbn", methods: "POST")]
    public function apiBook(
        Request $request,
        BookRepository $bookRepository
    ): Response {
        $isbn = $request->request->get("isbn");

        if (!$isbn) {
            $books = $bookRepository->findAll();
            $isbn = $books[0]->getIsbn();
        }

        // return new Response($isbn);
        return $this->redirectToRoute('api_book_isbn', ["isbn" => $isbn]);
    }


    #[Route("/api/library/book/{isbn}", name: "api_book_isbn")]
    public function apiBookByISBN(BookRepository $bookRepository, string $isbn): Response
    {
        $book = $bookRepository->findOneBy(['isbn' => $isbn]);

        if (!$book) {
            return $this->json(['error' => 'Book not found for ISBN '.$isbn], Response::HTTP_NOT_FOUND);
        }

        $response = $this->json($book);
        $response->setEncodingOptions($response->getEncodingOptions() | JSON_PRETTY_PRINT);

        return $response;
    }
}
