<html>
<head><title>������-��������� ���������</title></head>
<body><? require 'init.php'; ?>

  <br />
<? 

    /*print "Connected successfully" . "</br>";
    mysql_select_db("my_database") or die("� ���������, �� �������� ���� ������.</br>");
*/
    $ver = mysql_query("SELECT VERSION()"); 
  if(!$ver) 
  { 
    echo "<p>������ � �������</p>"; 
    exit(); 
  } 
  echo "MySQL version is " . mysql_result($ver, 0);

  $data = mysql_query("SELECT CURRENT_DATE;"); 
  echo mysql_result($data, 0); 
?>

<?

    /* ��������� SQL-������ */
    $query = "SELECT * FROM my_table";
    $result = mysql_query($query) or die("�������� ������: " . mysql_error() . "</br>");

    /* ������� ���������� � html */
    print "<table>\n";
    while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
        print "\t<tr>\n";
        foreach ($line as $col_value) {
            print "\t\t<td>$col_value</td>\n";
        }
        print "\t</tr>\n";
    }
    print "</table>\n";
?>

<? require ('uninit.php'); ?></body>
</html>