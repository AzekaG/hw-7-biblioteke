 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

     <title>Свитки</title>
 </head>

 <body>
     <?php


        require_once "./traits/Timestampable.php";
        require_once "connect.php";
        require_once "./classes/Book.php";
        require_once "./classes/Library.php";
        require_once "./classes/Member.php";

        session_start();
        $library = Library::getInstance();

        if (!isset($_SESSION['libraryState'])) {

            $book1 = new Book("Das Erste Booh", "Das Erste Author", 2000, 123456789);
            $book2 = new Book("Das zweite Booh", "Das zweite Author", 2000, 23456789);
            $book3 = new Book("Das dreite Booh", "Das dreite Author", 2000, 3456789);
            $book4 = new Book("Das vierte Booh", "Das vierte Author", 2000, 456789);
            $book5 = new Book("Das funfzich Booh", "Das funfzich Author", 2000, 56789);
            $bookArr = array($book3, $book4, $book5);

            $bookMember = array($book1, $book2);
            $bookMember2 = array();

            $member1 = new Member("Olaf", 999999, $bookMember);
            $member2 = new Member("Alex", 888888, $bookMember2);
            $memberArr = array($member1, $member2);

            $_SESSION['libraryState'] = [
                'books' => $bookArr,
                'members' => $memberArr
            ];
        }


        $library->books = $_SESSION['libraryState']['books'];
        $library->members = $_SESSION['libraryState']['members'];


        ?>
     <h1>Свитки в наличии : </h1>
     <table class='table'>
         <tbody>
             <tr>
                 <td>Название</td>
                 <td>Автор</td>
                 <td>Год</td>
                 <td>isbn</td>
             </tr>
             <?php foreach ($library->books as $book) : ?>
                 <tr>
                     <td><?= $book->getTitle() ?></td>
                     <td><?= $book->getAuthor() ?></td>
                     <td><?= $book->getYear() ?></td>
                     <td><?= $book->getIsbn() ?></td>
                     <td>
                         <a href="./operationsCrud/user.php">Изменить данные</a>
                         <form action="./index.php" method="POST">
                             <input type="hidden" name="id" value="<?= $book->getIsbn() ?>">
                             <button name="delete">Сжечь</button>
                         </form>

                     </td>
                 </tr>
             <?php endforeach ?>
         </tbody>
     </table>

     <a href="/operationsCrud/create.php">Добавить новый свиток </a>
     <a href="/operationsCrud/usersoperation.php">Перейти во вкладку работы с пользователями</a>
     <?php
        if (isset($_POST['delete'])) {
            $id = $_POST['id'];
            $library->removeBook($id);
            $_SESSION['libraryState']['books'] = $library->books;
            $_SESSION['libraryState']['members'] = $library->members;
            redirect('index.php');
        }




        function redirect($page)
        {
            header("Location:/$page");
            exit;
        }
        ?>

     <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
 </body>

 </html>