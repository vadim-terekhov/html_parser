<?php
// Каталог, в который мы будем принимать файл:
$uploaddir = './upload/';
$uploadfile = $uploaddir.($_FILES['file']['name']);
$type = $_FILES['file']['type'];

require_once (__DIR__."/header.php");
if ($type == 'text/html'){
	// Копируем файл из каталога для временного хранения файлов:
	if (copy($_FILES['file']['tmp_name'], $uploadfile))
	{		
		echo "<div class=\"container d-flex flex-column h-100\">";
		echo "<div class=\"row h-100 justify-content-center align-items-center\">";
		echo "<div class=\"jumbotron text-center m-0 border\">";
		echo "<h3>Файл успешно загружен на сервер</h3>";

	}
	else { 
		echo "<div class=\"container d-flex flex-column h-100\">";
		echo "<div class=\"row h-100 justify-content-center align-items-center\">";
		echo "<div class=\"jumbotron text-center m-0 border\">";
		echo "<h3>Ошибка! Не удалось загрузить файл на сервер!</h3>";
	}
}
else {
	echo "<div class=\"container d-flex flex-column h-100\">";
	echo "<div class=\"row h-100 justify-content-center align-items-center\">";
	echo "<div class=\"jumbotron text-center m-0 border\">";
	echo "<h3>Добавлять можно только файлы с расширением (.html).</h3>";
}

echo '<a href="/" class="btn btn-success mt-4">Перейти на главную</a>';
echo "</div>";
echo "</div>";
echo "</div>";
echo "</div>";
//header('Location: ./index.php');
require_once (__DIR__."/footer.php");
?>