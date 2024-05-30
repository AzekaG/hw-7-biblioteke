<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>



<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once "../traits/Timestampable.php";
    require_once "../connect.php";
    require_once "../classes/Book.php";
    require_once "../classes/Library.php";
    require_once "../classes/Member.php";
    require_once "../helper.php";
    session_start();


    $library = $_SESSION['libraryState'];
    $books = $_SESSION['libraryState']['books'];


    $title = $_POST['title'];
    $author = $_POST['author'];
    $year = $_POST['year'];
    $isbn = $_POST['isbn'];



    foreach ($books as $book) {
        if ((int)$book->getIsbn() === (int)$isbn) {
            $book->setTitle($title);
            $book->setAuthor($author);
            $book->setYear($year);
            $book->setIsbn($isbn);

            $_SESSION['libraryState']['books'] = $books;

            break;
        }
    }
    redirect('index.php');
}

function redirect($page)
{
    header("Location:/$page");
    exit;
}
?>
<?php
require_once "../traits/Timestampable.php";
require_once "../connect.php";
require_once "../classes/Book.php";
require_once "../classes/Library.php";
require_once "../classes/Member.php";
session_start();
$library = $_SESSION['libraryState'];
$books = $_SESSION['libraryState']['books'];



$id = $_GET['isbn'];


$boo;

foreach ($books as $book) {
    if ((int)$book->getIsbn() === (int)$id) {
        $boo = $book;
        break;
    }
}

?>

<body>
    <form action="edit.php" method="post">
        <input type="text" name="title" placeholder="Введите название" value="<?= $boo->getTitle() ?>">
        <input type="number" name="year" placeholder="Введите год" value="<?= $boo->getYear() ?>">
        <input type="text" name="author" placeholder="Введите автора" value="<?= $boo->getAuthor() ?>">
        <input type="hidden" name="isbn" value="<?= $boo->getIsbn() ?>">
        <button>Save</button>
    </form>





</body>

</html>