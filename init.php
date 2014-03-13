
<? require 'login.php';
      /* Соединяемся, выбираем базу данных */
    $link = mysql_connect($dblocation, $dbuser, $dbpasswd)
        or die("Невозможно подключиться к базе данных: " . mysql_error());

  ?>