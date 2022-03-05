<?php
session_start();
include ("bd.php");// файл bd.php должен быть в той же папке, что и все остальные, если это не так, то просто измените путь 
include 'script/config.php';
if (!empty($_SESSION['login']) and !empty($_SESSION['password']))
{
//если существует логин и пароль в сессиях, то проверяем, действительны ли они
$login = $_SESSION['login'];
$password = $_SESSION['password'];
$result2 = mysql_query("SELECT id FROM users WHERE login='$login' AND password='$password'",$db); 
$myrow2 = mysql_fetch_array($result2); 
if (empty($myrow2['id']))
   {
   //Если не действительны, то закрываем доступ
    exit("Вход на эту страницу разрешен только зарегистрированным пользователям!");
   }
}
else {
//Проверяем, зарегистрирован ли вошедший
exit("Вход на эту страницу разрешен только зарегистрированным пользователям!"); }


$code = @$_GET ['code'];

@$resp = file_get_contents('https://oauth.vk.com/access_token?client_id='.$client_id.'&client_secret='.$client_secret.'&code='.$code.'&redirect_uri=http://my-op.ru/vk_add.php');
$obj = json_decode($resp);

$token = $obj->{'access_token'};
$user_id = $obj->{'user_id'};
@$email = $obj->{'email'};

$json_info = file_get_contents('https://api.vk.com/method/users.get?fields=photo_50,photo_max&access_token='. $token .'' );
	$acc_info_arr = json_decode($json_info);
	
	
	$first_name = $acc_info_arr -> response[0] -> first_name;
	$last_name = ($acc_info_arr -> response[0] -> last_name);
	$photo_50 = ($acc_info_arr -> response[0] -> photo_50);
	$photo_max = ($acc_info_arr -> response[0] -> photo_max);


// подключаемся к базе
include ("bd.php");// файл bd.php должен быть в той же папке, что и все остальные, если это не так, то просто измените путь 

//$result2 = mysql_query ("UPDATE users WHERE login = '$login' SET (user_id,access_token,email,first_name,last_name,photo_50,photo_max) VALUES('$user_id','$token','$email','$first_name','$last_name','$photo_50','$photo_max')");
$result2 = mysql_query ("UPDATE `users` SET `user_id`='$user_id',`access_token`='$token',`email`='$email',`first_name`='$first_name',`last_name`='$last_name',`photo_50`='$photo_50',`photo_max`='$photo_max',`avatar`='$photo_50' WHERE `login`= '$login'");
echo "<html><head><meta http-equiv='Refresh' content='1; URL=index.php?id=profile'></head><body>Данные профиля успешно добавлены! Вы будете перемещены через 2 сек. Если не хотите ждать, то <a href='page.php?id=".$_SESSION['id']."'>нажмите сюда.</a></body></html>";
// echo "".$user_id."".$_SESSION['id']."Данные профиля успешно добавлены!<br>";
// echo "".$token."<br>";
// echo "".$first_name."<br>";
// echo "".$last_name."<br>";
// echo "".$photo_50."<br>";
// echo "".$photo_max."<br>";
// echo "".$email."<br>";

?>
</body>
</html>