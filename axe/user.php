<?php 

if (@$myrow3['login'] == @$login) {
//проверяем, не извлечены ли данные пользователя из базы. Если нет, то он не вошел, либо пароль в сессии неверный. Выводим окно для входа. Но мы не будем его выводить для вошедших, им оно уже не нужно.

exit("Вход на эту страницу разрешен только зарегистрированным пользователям!");
}

else
{
//************************************************************************************

$user_id = '&user_id='.@$_GET ['uid'];
@$uid = '&uid='.@$_GET ['uid'];
if (empty($_GET ['uid'])) { $user_id = ''; }

$fields = "photo_id,verified,sex,bdate,city,country,home_town,has_photo,photo_50,photo_100,photo_200_orig,photo_200,photo_400_orig,photo_max,photo_max_orig,online,lists,domain,has_mobile,contacts,site,education,universities,schools,status,last_seen,followers_count,common_count,occupation,nickname,relatives,relation,personal,connections,exports,wall_comments,activities,interests,music,movies,tv,books,games,about,quotes,can_post,can_see_all_posts,can_see_audio,can_write_private_message,can_send_friend_request,is_favorite,is_hidden_from_feed,timezone,screen_name,maiden_name,crop_photo,is_friend,friend_status,career,military,blacklisted,blacklisted_by_me";

$json = file_get_contents('https://api.vk.com/method/users.get?v=5.62'.$user_id.'&order=hints&fields='.$fields.'&access_token='. $token .'' );
$photos_arr = json_decode($json);

$response = $photos_arr->{'response'};

 foreach ($response[0] as $key=>$value) {
		$param[0][$key] = $value;		
}

print "<h1>Информация о пользователе</h1>";

echo "
<table border='1' align='center' width='100%'>
    <tr>
        <td rowspan='7' width='100px' align='center'><a target='_blank' href='".@$param[0][photo_max_orig]."'><img src='".@$param[0][photo_100]."'/></a><br></td>
        <td>".@$param[0][first_name]."   ".@$param[0][last_name]."</td>
    </tr>
    <tr>
        <td>Пол: ".@$param[0][sex]."</td>
    </tr>
    <tr>
        <td>Дата рождения :".@$param[0][bdate]."</td>
    </tr>
    <tr>
        <td>Город :".@$param[0]['city->title']."</td>
    </tr>
    <tr>
        <td>Страна :".@$param[0]['country->title']."</td>
    </tr>
    <tr>
        <td>";
		if ($param[0]['online'] = "0") { echo "<font color='green'>онлайн</font>"; } else { echo "<font color='red'>офлайн</font>"; };
		echo "</td>
    </tr>
    <tr>
        <td>
		<a href='index.php?id=albums".$uid."'>фотоальбомы</a><br>
		<a href='?id=groups".$uid."'>Группы</a></td>
    </tr>
</table>

";


//************************************************************************************
//при удачном входе пользователю выдается все, что расположено ВЫШЕ между звездочками.
}
	
?>
		
