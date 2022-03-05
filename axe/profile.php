<?php
$id =  @$myrow['id'];
if (@$myrow3['login'] == @$login) {
   //Если не действительны (может мы удалили этого пользователя из базы за плохое поведение)
    exit("Вход на эту страницу разрешен только зарегистрированным пользователям!");
}

else {

include 'script/config.php';
$result2 = mysql_query("SELECT * FROM users WHERE id='$id'",$db); 
$myrow2 = mysql_fetch_array($result2);//Извлекаем все данные пользователя с данным id

echo "<h2>".$myrow2['last_name']."  ".$myrow2['first_name']."</h2>";
//<a href="https://oauth.vk.com/authorize?client_id=5907647&scope=photos,audio,wall,friends,email,offline&redirect_uri=http://my-op.ru/vk_add.php&response_type=code&v=5.62">



//https://oauth.vk.com/authorize?client_id=5920240&scope=friends,photos,audio,video,status,wall,offline,docs,groups,email&response_type=token&display=popup&redirect_uri=http://oauth.vk.com/blank.html
print <<<HERE
<br><br><br>
<a target=_blank href="https://oauth.vk.com/authorize?client_id=$client_id&scope=friends,photos,audio,video,status,wall,offline,docs,groups,email&response_type=code&redirect_uri=http://my-op.ru/vk_add.php">Войти вконтакте</a><br><br>
<a target=_blank href="https://oauth.vk.com/authorize?client_id=$client_id&scope=friends,photos,audio,video,status,wall,offline,docs,groups,email&response_type=token&display=page&redirect_uri=http://oauth.vk.com/blank.html">Войти вконтакте</a><br><br>
https://oauth.vk.com/authorize?client_id=5920240&scope=friends,photos,audio,video,status,wall,offline,docs,groups,email&response_type=token&display=popup&redirect_uri=http://oauth.vk.com/blank.html

<form action='http://my-op.ru/add_token.php' method='post'>
Введите токен:<br>
<input name='access_token' type='text'>
<input type='submit' name='submit' value='изменить'>
</form>
<br><br><br>


<form action='update_user.php' method='post'>
Ваш логин <strong>$myrow2[login]</strong>. Изменить логин:<br>
<input name='login' type='text'>
<input type='submit' name='submit' value='изменить'>
</form>
<br>

<form action='update_user.php' method='post'>
Изменить пароль:<br>
<input name='password' type='password'>
<input type='submit' name='submit' value='изменить'>
</form>
<br>

<form action='update_user.php' method='post' enctype='multipart/form-data'>
Ваш аватар:<br>
<img alt='аватар' src='$myrow[avatar]'><br>
Изображение должно быть формата jpg, gif или png. Изменить аватар:<br>
<input type="FILE" name="fupload">
<input type='submit' name='submit' value='изменить'>
</form>
<br>


HERE;
					

print "<br><b>".$token."</b>";
}
?>