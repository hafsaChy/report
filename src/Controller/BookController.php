<?php

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class BookController extends AbstractController
{
    #[Route('/book', name: 'app_book')]
    public function index(): Response
    {
        return $this->render('book/index.html.twig', [
            'controller_name' => 'BookController',
        ]);
    }

    #[Route('/book/init', name: 'book_init')]
    public function bookInit(
        ManagerRegistry $doctrine,
        BookRepository $bookRepository
    ): Response {
        $predefinedBooks = [
            0 => [
                "isbn" => "978-0-06-238257-3",
                "title" => "Warriors- The Fourth Apprentice",
                "author" => "Erin Hunter",
                "image" => "warriors_fourth_app.jpeg"
            ],
            1 => [
                "isbn" => "978-0-06-238259-7",
                "title" => "Warriors- Fading Echoes",
                "author" => "Erin Hunter",
                "image" => "warriors_fading_echoes.jpeg"
            ],
            2 => [
                "isbn" => "978-0-06-238260-3",
                "title" => "Warriors- Night Whispers",
                "author" => "Erin Hunter",
                "image" => "warriors_night_whis.jpeg"
            ],
            3 => [
                "isbn" => "978-0-06-238261-0",
                "title" => "Warriors- Sign Of The Moon",
                "author" => "Erin Hunter",
                "image" => "warriors_sign_moon.jpeg"
            ],
            4 => [
                "isbn" => "978-0-06-238262-7",
                "title" => "Warriors- The Forgotten Warrior",
                "author" => "Erin Hunter",
                "image" => "warriors_forgot_wa.jpeg"
            ],
            5 => [
                "isbn" => "978-0-06-238263-4",
                "title" => "Warriors- The Last Hope",
                "author" => "Erin Hunter",
                "image" => "warriors_last_hope.jpeg"
            ]
        ];

        $entityManager = $doctrine->getManager();

        foreach ($predefinedBooks as $item) {
            $bookExists = $bookRepository->findOneBy(
                ['isbn' => $item["isbn"]]
            );

            if (!$bookExists) {
                $book = new Book();

                $book->setIsbn($item["isbn"]);
                $book->setTitle($item["title"]);
                $book->setAuthor($item["author"]);
                $book->setImage($item["image"]);
                // save the book
                $entityManager->persist($book);
            }
        }

        // INSERT query
        $entityManager->flush();
        return $this->redirectToRoute('library');
    }

    #[Route('/book/reset', name: 'reset_book')]
    public function bookReset(
        BookRepository $bookRepository,
        EntityManagerInterface $entityManager
    ): Response {
        $allBooks = $bookRepository->findAll();

        foreach ($allBooks as $book) {
            $entityManager->remove($book);
        }

        $entityManager->flush();

        return $this->redirectToRoute('book_init');
    }

    // #[Route('/book/show', name: 'book_show_all')]
    // public function showAllBooks(
    //     BookRepository $bookRepository
    // ): Response {
    //     $books = $bookRepository
    //         ->findAll();

    //     $bookArray = [];

    //     foreach ($books as $book) {
    //         $bookArray[] = [
    //             "id" => $book->getId(),
    //             "isbn" => $book->getIsbn(),
    //             "title" => $book->getTitle(),
    //             "author" => $book->getAuthor(),
    //             "image" => $book->getImage()
    //         ];
    //     }

    //     $data = [];
    //     $data["books"] = $bookArray;

    //     return $this->render('book/read_many.html.twig', $data);
    // }

    // #[Route('/book/show/{idNumber}', name: 'book_by_id')]
    // public function showBookById(
    //     BookRepository $bookRepository,
    //     int $idNumber
    // ): Response {
    //     $data = [
    //         "id" => "",
    //         "isbn" => "",
    //         "title" => "",
    //         "author" => "",
    //         "image" => ""
    //     ];

    //     $book = $bookRepository
    //         ->find($idNumber);

    //     if ($book) {
    //         $data["id"] = $book->getId();
    //         $data["isbn"] = $book->getIsbn();
    //         $data["title"] = $book->getTitle();
    //         $data["author"] = $book->getAuthor();
    //         $data["image"] = $book->getImage();
    //     }

    //     return $this->render('book/read_one.html.twig', $data);
    // }

    // #[Route('/book/search', name: 'book_search', methods: 'get')]
    // public function searchBook(
    //     Request $request,
    //     BookRepository $bookRepository
    // ): Response {

    //     $search = $request->query->get('search');
    //     $success = $bookRepository->findOneBy(
    //         ['id' => intval($search)]
    //     );

    //     if (!$success) {
    //         return $this->redirectToRoute('library');
    //     }

    //     return $this->redirectToRoute('book_by_id', ['idNumber' => $search]);
    // }

    // #[Route('/book/add', name: 'book_add')]
    // public function addNewBook(): Response
    // {
    //     return $this->render('book/add_one.html.twig');
    // }

    // #[Route('/book/create', name: 'book_create', methods: 'POST')]
    // public function createBook(
    //     Request $request,
    //     ManagerRegistry $doctrine,
    //     BookRepository $bookRepository
    // ): Response {
    //     $isbn = strval($request->request->get('isbn'));
    //     $title = strval($request->request->get('title'));
    //     $author = strval($request->request->get('author'));
    //     $image = strval($request->request->get('image'));

    //     $entityManager = $doctrine->getManager();

    //     $book = new Book();

    //     if ($isbn) {
    //         $book->setIsbn($isbn);
    //     }

    //     if ($title) {
    //         $book->setTitle($title);
    //     }

    //     if ($author) {
    //         $book->setAuthor($author);
    //     }

    //     if ($image) {
    //         $book->setImage($image);
    //     }

    //     $entityManager->persist($book);

    //     $entityManager->flush();

    //     $success = $bookRepository->findOneBy(
    //         ['isbn' => $isbn]
    //     );

    //     if (!$success) {
    //         return new Response('Adding book failed.');
    //     }

    //     $isbn = $success->getId();

    //     return $this->redirectToRoute('book_by_id', ['idNumber' => $isbn]);
    // }

    // #[Route('/book/update/{idNumber}', name: 'book_update')]
    // public function updateBook(
    //     BookRepository $bookRepository,
    //     int $idNumber
    // ): Response {
    //     $data = [
    //         "id" => "",
    //         "isbn" => "",
    //         "title" => "",
    //         "author" => "",
    //         "image" => ""
    //     ];

    //     $book = $bookRepository
    //         ->find($idNumber);

    //     if ($book) {
    //         $data["id"] = $book->getId();
    //         $data["isbn"] = $book->getIsbn();
    //         $data["title"] = $book->getTitle();
    //         $data["author"] = $book->getAuthor();
    //         $data["image"] = $book->getImage();
    //     }

    //     return $this->render('book/update.html.twig', $data);
    // }

    // #[Route('/book/alter', name: 'book_alter', methods:['POST'])]
    // public function alterBook(
    //     Request $request,
    //     BookRepository $bookRepository,
    //     EntityManagerInterface $entityManager
    // ): Response {
    //     $idNumber = $request->request->get("bookId");
    //     $isbn = (string) $request->request->get('isbn');
    //     $title = (string) $request->request->get('title');
    //     $author = (string) $request->request->get('author');
    //     $image = (string) $request->request->get('image');

    //     $book = $bookRepository->find($idNumber);

    //     if (!$book) {
    //         throw $this->createNotFoundException(
    //             'No book found for id '.$idNumber
    //         );
    //     }
    //     $book->setIsbn($isbn);
    //     $book->setTitle($title);
    //     $book->setAuthor($author);
    //     $book->setImage($image);

    //     // Persist changes to the database
    //     $entityManager->persist($book);
    //     $entityManager->flush();

    //     return $this->redirectToRoute('book_by_id', ['idNumber' => $idNumber]);
    // }


    // #[Route('/book/delete/{idNumber}', name: 'book_delete', methods: ['get', 'post'])]
    // public function deleteBook(
    //     Request $request,
    //     BookRepository $bookRepository,
    //     EntityManagerInterface $entityManager,
    //     int $idNumber
    // ): Response {
    //     $book = $bookRepository->find($idNumber);

    //     if (!$book) {
    //         throw $this->createNotFoundException('No book found for id '.$idNumber);
    //     }

    //     $data = [
    //         "id" => $book->getId(),
    //         "isbn" => $book->getIsbn(),
    //         "title" => $book->getTitle(),
    //         "author" => $book->getAuthor(),
    //         "image" => $book->getImage()
    //     ];

    //     $bookToDelete = $request->request->get("bookId");

    //     if ($bookToDelete) {
    //         $entityManager->remove($book);
    //         $entityManager->flush(); // Insert the changes to the database
    //         return $this->redirectToRoute('book_show_all');
    //     }

    //     return $this->render('book/delete.html.twig', $data);
    // }
}
