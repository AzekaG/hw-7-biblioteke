  <?php

  //структурный подход
    // $s = mysqli_connect('');

    // mysqli_query($s, 'select * from books');


    //ооп подход через обьект mysql  работает с БД только mySQL
  
    //   $s = new mysqli('');
    //   $s->query('asd');


    //номральынй подход через универсальный класс, через который можно работать с разными бд
    // $pso = new PDO('к какой системе БД подклчаемся:host подклчения; имяБД=библиотека' , 'логин','пасс' );
    $pdo = new PDO('mysql:host=localhost;dbname=Biblioteke', 'root' , '');



    ?>


  <?php

    ?>