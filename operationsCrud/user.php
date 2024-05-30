 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

     <title>Document</title>
 </head>

 <body>


     <?php
        require_once "../traits/Timestampable.php";
        require_once "../connect.php";
        require_once "../classes/Book.php";
        require_once "../classes/Library.php";
        require_once "../classes/Member.php";
        session_start();
        $library = Library::getInstance();
        //достаем коллекции книг и пользователей
        $library->books = $_SESSION['libraryState']['books'];
        $library->members = $_SESSION['libraryState']['members'];

        //айди пользователя, которого коллеции рассматриваем
        if (isset($_GET['id'])) {
            $_SESSION['usID'] = $_GET['id'];
        }
        $member;
        //вычисляем нужного пользователя по айди
        foreach ($library->members as $memb) {
            if ((int)$memb->getMemberShipId() === (int)$_SESSION['usID']) {
                $member = $memb;
            }
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['take'])) {
                $bookId =  $_POST['idbook'];
                $book;

                foreach ($library->books as $boo) {
                    if ((int)$boo->getIsbn() === (int)$bookId) {
                        $book = $boo;
                        $library->lendBook($member, $book);

                        $_SESSION['libraryState']['books'] = $library->books;
                        $_SESSION['libraryState']['members'] = $library->members;
                        unset($_POST['take']);
                    }
                }
            }

            if (isset($_POST['return'])) {
                $bookId =  $_POST['idbook'];
                $book;

                foreach ($member->getBookBorrowed() as $boo) {
                    if ((int)$boo->getIsbn() === (int)$bookId) {
                        $book = $boo;

                        $library->recieveBook($book, $member);

                        $_SESSION['libraryState']['books'] = $library->books;
                        $_SESSION['libraryState']['members'] = $library->members;
                        unset($_POST['return']);
                    }
                }
            }
        }



        function redirect($page)
        {
            header("Location:/$page");
            exit;
        } ?>






     <h1>Книги в библиотеке :</h1>
     <table class='table-responsive'>
         <tbody>
             <tr>
                 <td>Title</td>
                 <td>author</td>
                 <td>year</td>
                 <td>isbn</td>
             </tr>
             <?php foreach ($library->books as $book) : ?>
                 <tr>
                     <td><?= $book->getTitle() ?></td>
                     <td><?= $book->getAuthor() ?></td>
                     <td><?= $book->getYear() ?></td>
                     <td><?= $book->getIsbn() ?></td>
                     <td>
                         <form action="user.php" method="post">
                             <input type="hidden" name="idbook" value="<?= $book->getIsbn() ?>">
                             <button name='take'>Взять</button>
                         </form>
                     </td>
                 </tr>
             <?php endforeach ?>
         </tbody>
     </table>


     <h3>Name : <?= $member->getName() ?></h3>
     <h3>Id : <?= $member->getMemberShipId() ?></h3>
     <h4>Книги у пользователя :</h4>
     <ul>
         <?php
            foreach ($member->getbookBorrowed() as $book) {
                echo "<li>" . $book->getTitle();
                echo  "<form action='user.php' method='post'>
                             <input type='hidden' name='idbook' value={$book->getIsbn()}>
                             <button name='return'>Вернуть</button>
                         </form>'";
                echo '</li>';
            }
            ?>
     </ul>

     <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
 </body>

 </html>