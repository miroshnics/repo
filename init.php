
<?
  $dblocation = "localhost"; 
  $dbname = "test"; 
  $dbuser = "root"; 
  $dbpasswd = "12345"; 

      /* �����������, �������� ���� ������ */
    $link = mysql_connect($dblocation, $dbuser, $dbpasswd)
        or die("���������� ������������ � ���� ������: " . mysql_error());

  ?>