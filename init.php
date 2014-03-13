
<?
  $dblocation = "localhost"; 
  $dbname = "test"; 
  $dbuser = "root"; 
  $dbpasswd = "12345"; 

      /* Соединяемся, выбираем базу данных */
    $link = mysql_connect($dblocation, $dbuser, $dbpasswd)
        or die("Невозможно подключиться к базе данных: " . mysql_error());

  ?>