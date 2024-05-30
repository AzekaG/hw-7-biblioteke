<?php

class Book
{
    use Timestampable;

    private $title;
    private $author;
    private $year;
    private $isbn;

    public function __construct(string $title_, string $author_, int $year_, int $isbn_)
    {

        $this->title = $title_;
        $this->author = $author_;
        $this->year = $year_;
        $this->isbn = $isbn_;
        $this->setCreatedAt(time());
    }


    public function getTitle()
    {
        return $this->title;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getYear()
    {
        return $this->year;
    }

    public function getIsbn()
    {
        return $this->isbn;
    }


    public function setTitle(string $title_)
    {
        $this->title = $title_;
        $this->setUpdatedAt(time());
    }

    public function setAuthor(string $author_)
    {
        $this->author = $author_;
        $this->setUpdatedAt(time());
    }

    public function setYear(int $year_)
    {
        $this->year = $year_;
        $this->setUpdatedAt(time());
    }

    public function setIsbn(int $isbn_)
    {
        $this->isbn = $isbn_;
        $this->setUpdatedAt(time());
    }
}
