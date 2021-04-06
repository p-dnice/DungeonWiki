<?php
	//Проверка на пустоту имени
	$text = trim($_POST["contact_name"]);

	if(strlen($text) == 0){
		echo "Имя не введено!<br>";
		die("<a href='index.html'>На главную</a>");
	}

	//Проверка на пустоту email
	$text = trim($_POST["contact_email"]);
	
	if(strlen($text) == 0){
		echo "E-mail не введен!<br>";
		die("<a href='index.html'>На главную</a>");
	}

	//Проверка на пустоту текста обращения
	$text = trim($_POST["contact_text"]);
	
	if(strlen($text) == 0){
		echo "Текст обращения не введен!<br>";
		die("<a href='index.html'>На главную</a>");
	}

	$server = "localhost";
	$username = "root";
	$password = "";
	$dbname = "dungeonwiki";

	//Подключение к БД
	$conn = mysqli_connect($server, $username, $password, $dbname);
	mysqli_select_db($conn, "dungeonwiki");

	mysqli_query($conn, 'SET NAMES utf8') or die ("не удалось установить кодировку");

	if (!$conn) {
 		die("Подключение не выполнено: " . mysqli_connect_error());
	}

	//Запись обращения в БД
	$sql = "insert into callback (Callback_username, Callback_user_email, Callback_theme, Callback_text)
			values ('".$_POST["contact_name"]."', '".$_POST["contact_email"]."', 
			'".$_POST["contact_theme"]."', '".$_POST["contact_text"]."')";

	if (mysqli_query($conn, $sql)) {
		echo "Обращение успешно добавлено!</br>";
		echo "<a href='index.html'>На главную</a>";
	} else {
	 echo "Ошибка добавления обращения: " . $sql . "<br>" .mysqli_error($conn);
	}

	mysqli_close($conn);
?>