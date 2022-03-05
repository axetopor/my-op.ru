<script language="JavaScript" type="text/javascript" src="http://code.jquery.com/jquery-1.2.6.js"></script>
<?php
	if (isset($_GET['q'])) {
		$id =$_GET['q']; //получаем текст запроса странички
		} else {
		exit ("<center><font color=red size=20>Ошибка, пустой запрос</font></center>"); //если не указали "q=", то выдаем ошибку
	}

//if (!preg_match("|^[\d]+$|", $id)) {
//exit("<p>Неверный формат запроса! Проверьте URL</p>");//если q не число, то выдаем ошибку
//}


$info = new SplFileInfo($id);
$filename = $info->getFilename();
		//print $filename;
$extension = $info->getExtension();
		//print $extension;

	if ($extension == "jpg") {
		echo "<img src='$id' width='400px' title='$filename' id='jstest'/>";
		} else {
		echo "<b>".$id."</b><br>";
	}
?>