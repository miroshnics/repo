<?
    /* ����������� ������ �� ���������� */
    //mysql_free_result($result);
	
/* ������� ���� ������ db_Dispetcher */
if (!mysql_query($sql, 'DROP DATABASE db_Dispetcher')) {
	echo '������ ��� �������� ���� ������ db_Dispetcher: ' . mysql_error() . "<br />";
}
    /* ��������� ���������� */
    mysql_close($link);
?>