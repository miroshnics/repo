<? require 'login.php'; ?>

<html>
<head><title>Онлайн-Диспетчер автопарка: Создание БД</title></head>
<body>
<h2 align="center">Онлайн-Диспетчер автопарка: Создание БД</h2>

<?
$status=0;

 /* Соединяемся с сервером СУБД */
$link = mysql_connect($dblocation, $dbuser, $dbpasswd)
	or die("Невозможно подключиться к серверу СУБД: " . mysql_error());
	
/* Настройка подключения к базе данных */
$datass = mysql_set_charset('cp1251', $link);
//mysql_query('SET names "cp1251"');
$datass .= mysql_query ("SET character_set_client='cp1251'");  
$datass .= mysql_query ("SET character_set_results='cp1251'");  
$datass .= mysql_query ("SET collation_connection='cp1251_general_ci'");
echo $datass;
	
/* Создаем базу данных db_Dispetcher */
if (!mysql_query('CREATE DATABASE ' . $dbname . ';', $link))
	die('Ошибка при создании базы данных ' . $dbname . ': ' . mysql_error() . "<br />");

/* Подключаемся к созданной БД */
if (!mysql_select_db($dbname, $link)) {
    die('Не удалось выбрать базу ' . $dbname . ': ' . mysql_error() . "<br />");
}

/* Создаем таблицы tbl_Fuels */
if (!mysql_query('CREATE TABLE tbl_Fuels (
					id INT AUTO_INCREMENT NOT NULL,
					type_name CHAR(30) NOT NULL,
					cost DECIMAL(9,2) NOT NULL,
					PRIMARY KEY(id));', $link))
	echo 'Ошибка при создании таблицы tbl_Fuels: ' . mysql_error() . "<br />";
	else $status += 1*1;
	
/* Создаем таблицы tbl_Depts */
if (!mysql_query('CREATE TABLE tbl_Depts (
					id INT AUTO_INCREMENT NOT NULL,
					name CHAR(30) NOT NULL,
					color CHAR(6) NOT NULL,' . // HEX digit
					'PRIMARY KEY(id));', $link))
	echo 'Ошибка при создании таблицы tbl_Depts: ' . mysql_error() . "<br />";
	else $status += 1*10;

/* Создаем таблицы tbl_Drivers */
if (!mysql_query('CREATE TABLE tbl_Drivers (
					id INT AUTO_INCREMENT NOT NULL,
					name CHAR(30) NOT NULL,
					sec_name VARCHAR(30) NOT NULL,
					last_name VARCHAR(30) NOT NULL,
					car VARCHAR(30) NOT NULL,
					fuel_id INT NOT NULL,
					PRIMARY KEY(id),
					FOREIGN KEY (fuel_id) REFERENCES tbl_Fuels(id));', $link))
	echo 'Ошибка при создании таблицы tbl_Drivers: ' . mysql_error() . "<br />";
	else $status += 100;

/* Создаем таблицы tbl_Trips */
if (!mysql_query('CREATE TABLE tbl_Trips (
					id INT AUTO_INCREMENT NOT NULL,
					start_point CHAR(30),
					end_point CHAR(30) NOT NULL,
					time_start DATETIME NOT NULL,
					time_end DATETIME,
					dlina DECIMAL(9,3),
					Driver_id INT NOT NULL,
					client_dept_id INT NOT NULL,
					client CHAR(50) NOT NULL,
					PRIMARY KEY(id),
					FOREIGN KEY (Driver_id) REFERENCES tbl_Drivers(id),
					FOREIGN KEY (client_dept_id) REFERENCES tbl_Depts(id));', $link))
	echo 'Ошибка при создании таблицы tbl_Trips: ' . mysql_error() . "<br />";
	else $status += 1*1000;
	
/* Проверка успешности создания БД */
if ($status == 1111) echo 'База данных успешно создана.<br />';
else echo 'Создание БД завершено с ошибками. Код ошибки: ' . $status . '<br />';
?>
<a href="index.php"><input type="button" value="На главную" /></a>
</body>
</html>