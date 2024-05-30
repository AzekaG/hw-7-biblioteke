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
    
    session_start();


    $library = $_SESSION['libraryState'];
    $books = $_SESSION['libraryState']['books'];


    $title = $_POST['title'];
    $author = $_POST['author'];
    $year = $_POST['year'];
    $isbn = $_POST['isbn'];

    $newbook = new Book($title, $author, $year, $isbn);
    $_SESSION['libraryState']['books'][] = $newbook;

   redirect('index.php');
}
function redirect($page)
{
    header("Location:/$page");
    exit;
}
?>


<body>
    <h1>Добавить свиток</h1>
    <form action="create.php" method="post">
        <div>
            <label for="">Название: </label>
            <input type="text" name='title' placeholder="Введите имя" require>
        </div>
        <div>
            <label for="">Автор: </label>
            <input type="text" name='author' placeholder="Введите автор" require>
        </div>
        <div>
            <label for="">Год: </label>
            <input type="number" name='year' placeholder="Введите год" require>
        </div>
        <div>
            <label for="">Isbn: </label>
            <input type="number" name='isbn' placeholder="Введите ISBN" require>
        </div>

        <button>Сберечь</button>
    </form>



</body>

</html>