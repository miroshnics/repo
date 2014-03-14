<?
    /* Освобождаем память от результата */
    //mysql_free_result($result);
	
/* Удаляем базу данных db_Dispetcher */
if (!mysql_query($sql, 'DROP DATABASE db_Dispetcher')) {
	echo 'Ошибка при удалении базы данных db_Dispetcher: ' . mysql_error() . "<br />";
}
    /* Закрываем соединение */
    mysql_close($link);
?>