<? require 'login.php'; ?>

<html>
<head><title>Онлайн-Диспетчер автопарка: Инициализация</title></head>
<body>
<h2 align="center">Онлайн-Диспетчер автопарка: Инициализация</h2>

<?
$status=0;

 /* Соединяемся с сервером СУБД */
$link = mysql_connect($dblocation, $dbuser, $dbpasswd)
	or die("Невозможно подключиться к серверу СУБД: " . mysql_error());
	
/* Создаем базу данных db_Dispetcher */
if (!mysql_query('CREATE DATABASE ' . $dbname . ';', $link))
	die('Ошибка при создании базы данных ' . $dbname . ': ' . mysql_error() . "<br />");

/* Подключаемся к созданной БД */
if (!mysql_select_db($dbname, $link)) {
    die('Не удалось выбрать базу ' . $dbname . ': ' . mysql_error() . "<br />");
}

/* Создаем таблицы tbl_Drivers */
if (!mysql_query('CREATE TABLE tbl_Drivers (
						id INT AUTO_INCREMENT NOT NULL,
						name CHAR(30) NOT NULL,
						sec_name VARCHAR(30) NOT NULL,
						last_name VARCHAR(30) NOT NULL,
						car VARCHAR(30) NOT NULL,
						fuel VARCHAR (10),
						PRIMARY KEY(id));', $link))
	echo 'Ошибка при создании таблицы tbl_Drivers: ' . mysql_error() . "<br />";
	else $status+=1;

/* Создаем таблицы tbl_Trips */
if (!mysql_query('CREATE TABLE tbl_Trips (
						id INT AUTO_INCREMENT NOT NULL,
						start_point CHAR(30) NOT NULL,
						end_point CHAR(30) NOT NULL,
						time_start DATETIME NOT NULL,
						time_end DATETIME,
						dlina DECIMAL(9,3),
						Driver_id INT NOT NULL,
						client_id INT NOT NULL,
						PRIMARY KEY(id),
						FOREIGN KEY (Driver_id) REFERENCES tbl_Drivers(id),
						FOREIGN KEY (client_id) REFERENCES tbl_Clients(id));', $link))
	echo 'Ошибка при создании таблицы tbl_Trips: ' . mysql_error() . "<br />";
	else $status+=1*10;

/* Создаем таблицы tbl_Clients */
if (!mysql_query('CREATE TABLE tbl_Clients (
						id INT AUTO_INCREMENT NOT NULL,
						name CHAR(30) NOT NULL,
						dept CHAR(30) NOT NULL,
						PRIMARY KEY(id));', $link))
	echo 'Ошибка при создании таблицы tbl_Clients: ' . mysql_error() . "<br />";
	else $status+=1*100;
	
/* Создаем таблицы tbl_DayHours */
if (!mysql_query('CREATE TABLE tbl_DayHours (
						id INT AUTO_INCREMENT NOT NULL,
						Time_begin TIME NOT NULL,
						Time_end TIME,
						PRIMARY KEY(id));', $link))
	echo 'Ошибка при создании таблицы tbl_DayHours: ' . mysql_error() . "<br />";
	else $status+=1*1000;
	
/* Проверка успешности создания БД */
if ($status==1111) echo 'База данных успешно создана.<br />';
else echo 'Завершено с ошибками. код ошибки: ' . $status . '<br />';
?>
<a href="index.php"><input type="button" value="На главную" /></a>
</body>
</html>