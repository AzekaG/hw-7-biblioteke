<?php
require_once "../traits/Timestampable.php";
require_once "../connect.php";
require_once "../classes/Book.php";
require_once "../classes/Library.php";
require_once "../classes/Member.php";
session_start();
$library = Library::getInstance();

$library->books = $_SESSION['libraryState']['books'];
$library->members = $_SESSION['libraryState']['members'];

?>
<table class='table'>
    <tbody>
        <?php foreach ($library->members as $members) : ?>
            <tr>
                <td><?= $members->getName() ?></td>
                <td><?= $members->getMemberShipId() ?></td>
                <?php foreach ($members->getBookBorrowed() as $book)

                    echo "<td>" . $book->getTitle() . "</td>";

                ?>
                <td>
                    <a href="./user.php?id=<?= $members->getMemberShipId() ?>">Войти</a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>