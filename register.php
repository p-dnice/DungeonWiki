<?php
	
	if($_POST["password"] != $_POST["password_repeat"]){
		die("Пароли не совпадают\n<a href='index.html'>На главную</a>");
	}

	$server = "localhost";
	$username = "root";
	$password = "";
	$dbname = "dungeonwiki";

	$conn = mysqli_connect($server, $username, $password, $dbname);
	mysqli_select_db($conn, "dungeonwiki");

	mysqli_query($conn, 'SET NAMES utf8') or die ("не удалось установить кодировку");

	if (!$conn) {
 		die("Подключение не выполнено: " . mysqli_connect_error());
	}
	// Проверка на существование пользователя
	$sql = "select User_login from user where User_login = '".$_POST["login"]."'";

	$res = mysqli_query($conn, $sql);

	if (!$res) {
		echo "Ошибка чтения: " . $sql . "<br>" .mysqli_error($conn);
		die("<a href='index.html'>На главную</a>");
	}

	$row = mysqli_fetch_all($res);

	if($row != NULL){
		if($_POST["login"] == $row[0][0]){
			echo "Такой пользователь уже существует! Придумайте новый логин!<br>";
			die("<a href='index.html'>На главную</a>");
		}
	}


	//Добавление пользователя
	$sql = "insert into user (User_login, User_email, User_password)
			values ('".$_POST["login"]."', '".$_POST["email"]."', '".$_POST["password"]."')";

	if (mysqli_query($conn, $sql)) {
		echo "Пользователь ".$_POST["login"]." успешно зарегистрирован</br>";
		echo "<a href='index.html'>На главную</a>";
	} else {
	 echo "Ошибка добавления пользователя: " . $sql . "<br>" .mysqli_error($conn);
	}

	mysqli_close($conn);
?>