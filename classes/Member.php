<?php


class Member
{
  use Timestampable;
  private $name;
  private $memberShipId;
  private $bookBorrowed;


  public function __construct(string $name_, int $memberShipId_, array $bookBorrowed_)
  {
    $this->name = $name_;
    $this->memberShipId = $memberShipId_;
    $this->bookBorrowed = $bookBorrowed_;
    $this->setCreatedAt(time());
  }

  public function setName(string $name_)
  {
    $this->name = $name_;
    $this->setUpdatedAt(time());
  }
  public function setMemberShipId(int $memberShipId_)
  {
    $this->memberShipId = $memberShipId_;
    $this->setUpdatedAt(time());
  }
  public function setBookBorrowed(array $bookBorrowed_)
  {
    $this->bookBorrowed = $bookBorrowed_;
    $this->setUpdatedAt(time());
  }

  public function getName()
  {
    return $this->name;
  }
  public function getMemberShipId()
  {
    return $this->memberShipId;
  }
  public function getBookBorrowed()
  {
    return $this->bookBorrowed;
  }
  public function addBook(Book $book)
  {
    $this->bookBorrowed[] = $book;
    $this->setUpdatedAt(time());
  }

  public function returnBook(Book $book)
  {
    $key = array_search($book, $this->getbookBorrowed());
    if ($key !== false) {
      unset($this->bookBorrowed[$key]);
    }
    $this->setUpdatedAt(time());
  }
}
