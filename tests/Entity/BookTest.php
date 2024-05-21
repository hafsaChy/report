<?php

namespace App\Entity;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for Entity class Book
 */
class BookTest extends TestCase
{
    /**
     * @var Book $book
     */
    protected $book;

    /**
     * test's set up
     */
    public function setUp(): void
    {
        $this->book = new Book();
    }

    /**
     * Construct object and verify the type.
     */
    public function testCreateObject(): void
    {
        $this->assertInstanceOf("\App\Entity\Book", $this->book);
        $this->assertNull($this->book->getId());
    }

    /**
     * Setter and getter method for book ISBN.
     */
    public function testSetAndGetIsbn(): void
    {
        $isbn = strval(random_int(0, 9) * 17);

        $this->book->setIsbn($isbn);
        $this->assertEquals($isbn, $this->book->getIsbn());
    }

    /**
     * Setter and getter method for book title.
     */
    public function testSetAndGetTitle(): void
    {
        $title = "Test Title";

        $this->book->setTitle($title);
        $this->assertEquals($title, $this->book->getTitle());
    }

    /**
     * Setter and getter method for book author.
     */
    public function testSetAndGetAuthor(): void
    {
        $auhtor = "Test Testsson";

        $this->book->setAuthor($auhtor);
        $this->assertEquals($auhtor, $this->book->getAuthor());
    }

    /**
     * Setter and getter method for book image.
     */
    public function testSetAndGetImage(): void
    {
        $image = "test.jpeg";

        $this->book->setImage($image);
        $this->assertEquals($image, $this->book->getImage());
    }
}
