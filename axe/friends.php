<?php 

if (@$myrow3['login'] == @$login) {
//проверяем, не извлечены ли данные пользователя из базы. Если нет, то он не вошел, либо пароль в сессии неверный. Выводим окно для входа. Но мы не будем его выводить для вошедших, им оно уже не нужно.

exit("Вход на эту страницу разрешен только зарегистрированным пользователям!");
}

else
{
//************************************************************************************

$user_id = @$_GET ['uid'];
$json = file_get_contents('https://api.vk.com/method/friends.get?v=5.62&user_id='.$user_id.'&order=hints&fields=sex,bdate,city,country,photo_100,photo_200_orig,online,online_mobile&access_token='. $token .'' );
$photos_arr = json_decode($json);

print var_dump($photos_arr);

$response = $photos_arr->{'response'};
$count = $response->{'count'};
$friends = $response->{'items'};


for ($i = 0; $i < $count; $i++){
 	foreach ($friends[$i] as $key=>$value) {
			$param[$i][$key] = $value;	
	}
}


print "<h1>Друзья (". $count .")</h1>";

	

for ($a = 0; $a < $count; $a++){ 
	$curr = $a + 1; 

echo "
<table border='0' align='center' width='100%'>
    <tr>
        <td rowspan='7' width='100px' background='#1b1b1b'>
		";
			if ($param[$a]['online'] == "1") {
			if (@$param[$a]['online_mobile'] == "1") { 
				echo "
			<div style='background-color:#d2d2d2; position:absolute; width:15px; height:15px;' >
				<div  style='background-color:#00FF00; width:5px; height:10px;' >
				</div>
			</div>
				"; 
				} else {
			echo "
			<div style='background-color: #d2d2d2; position:absolute; border-radius:50%; width:14px; height:14px;' >
				<div style='background-color: #00FF00; border-radius:50%; width:10px; height:10px; margin:2px;' >
				</div>
			</div>
			"; 
				}
			}
		else {
			echo "
			<div style='background-color:#d2d2d2; position:absolute; border-radius:50%; width:14px; height:14px;' >
				<div style='background-color:#FF0000; border-radius:50%; width:10px; height:10px; margin:2px;' >
				</div>
			</div>
			"; 
		};
		echo "
		
		<a href='?id=user&uid=".@$param[$a][id]."'><img src='".@$param[$a][photo_100]."'/></a>
			
		</td>
        <td>".@$param[$a][first_name]."   ".@$param[$a][last_name];

		echo "</td>
    </tr>
    <tr>
        <td>Пол: 
		";
		if (@$param[$a][sex] == "1") {
			echo "<b>женский</b>";
		} else {
			echo "<b>мужской</b>"; 
		};
		echo "</td>
    </tr>
    <tr>
        <td>Дата рождения:".@$param[$a][bdate]."</td>
    </tr>
    <tr>
        <td>Город:".@$param[$a]['city->title']."</td>
    </tr>
    <tr>
        <td>Страна:".@$param[$a]['country->title']."</td>
    </tr>
    <tr>
        <td>
		<a href='?id=albums&uid=".@$param[$a][id]."'>Фотоальбомы пользователя</a>
		</td>
    </tr>
</table>

";

}




//************************************************************************************
//при удачном входе пользователю выдается все, что расположено ВЫШЕ между звездочками.
}
	
?>
		
