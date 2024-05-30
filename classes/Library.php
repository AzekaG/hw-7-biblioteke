<?php


class Library
{

    use Timestampable;

    private static $instance;



    public $books = [];
    public $members = [];

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new Library();
        }
        return self::$instance;
    }
    private function __construct()
    {
    }

    public function addBook(Book $book)
    {

        if (!in_array($book, $this->books)) {
            $this->books[] = $book;
            echo "Книга '{$book->getTitle()}' добавлена в библиотеку";
        } else {
            echo "Книга '{$book->getTitle()}' уже есть в библиотеке";
        }
    }

    public function removeBook(int $isbn)
    {

        foreach ($this->books as $key => $book) {
            if ($book->getIsbn() === $isbn) {
                unset($this->books[$key]);
                echo "Книга удалена";
                return;
            }
        }
        echo "Книга для удаления не найдена";
        return;
    }

    public function registerMember(Member $member)
    {
        $members[] = $member;
    }

    public function lendBook(Member $member, Book $book)
    {
        $key = array_search($book, $this->books);
        $mem = array_search($member, $this->members);

        if ($key !== false && $mem !== false) {

            foreach ($this->members as $mem) {
                if ($mem === $member) {
                    $mem->addBook($book);
                }
            }
            unset($this->books[$key]);
            
        }
    }

    public function recieveBook(Book $book, Member $member)
    {
        $key = array_search($book, $member->getBookBorrowed());
        $mem = array_search($member, $this->members);

        if ($key !== false && $mem !== false) {
            foreach ($this->members as $mem) {
                if ($mem === $member) {
                    $mem->returnBook($book);
                    $this->books[] = $book;
                }
            }
        }
    }
}
