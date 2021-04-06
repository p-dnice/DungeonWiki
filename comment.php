<?php
	
	$text = trim($_POST["comment_text"]);

	//Проверка на пустоту комментария
	if(strlen($text) == 0){
		echo "Комментарий не введен!<br>";
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

	//Запись комментария в БД
	$sql = "insert into comment (User_ID, Post_ID, Comment_text)
			values ('1', '1', '".$_POST["comment_text"]."')";

	if (mysqli_query($conn, $sql)) {
		echo "Комментарий успешно добавлен!</br>";
		echo "<a href='index.html'>На главную</a>";
	} else {
	 echo "Ошибка добавления комментария: " . $sql . "<br>" .mysqli_error($conn);
	}

	mysqli_close($conn);
?>