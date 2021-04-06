<?php
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

	$sql = "select User_login, User_password from user where User_login = '".$_POST["login"]."'";

	$res = mysqli_query($conn, $sql);

	if (!$res) {
		echo "Ошибка чтения: " . $sql . "<br>" .mysqli_error($conn);
		die("<a href='index.html'>На главную</a>");
	}

	$row = mysqli_fetch_assoc($res);

	if(is_null($row)){
		echo "Введен неправильный логин<br>";
		echo "<a href='index.html'>На главную</a>";
	}else{
		if($row["User_password"] == $_POST["password"]){
			echo "Вход выполнен под именем ".$row["User_login"]."<br>";
			echo "<a href='index.html'>На главную</a>";
		}else{
			echo "Введен неверный пароль <br>";
			echo "<a href='index.html'>На главную</a>";
		}
	}

	



	mysqli_close($conn);
?>