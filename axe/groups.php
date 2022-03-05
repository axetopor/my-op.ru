<?php 

if (@$myrow3['login'] == @$login) {
//проверяем, не извлечены ли данные пользователя из базы. Если нет, то он не вошел, либо пароль в сессии неверный. Выводим окно для входа. Но мы не будем его выводить для вошедших, им оно уже не нужно.

exit("Вход на эту страницу разрешен только зарегистрированным пользователям!");
}

else
{
//************************************************************************************

@$user_id = '&user_id='.$_GET ['uid'];
@$uid = '&uid='.$_GET ['uid'];
if (empty($_GET ['uid'])) { $uid = ''; }
$json1 = file_get_contents('https://api.vk.com/method/users.get?v=5.62'.$uid.'&order=hints&access_token='. $token .'' );
$photos_arr1 = json_decode($json1);

$response1 = $photos_arr1->{'response'};
//print var_dump($response1[0]);
 foreach ($response1[0] as $key1=>$value1) {
		$param1[0][$key1] = $value1;		
}


$json = file_get_contents('https://api.vk.com/method/groups.get?v=5.62'.$user_id.'&extended=1&fields=members_count&access_token='.$token.'' );

$photos_arr = json_decode($json);
print var_dump($photos_arr);

$response = $photos_arr->{'response'};
$count = $response->{'count'};
$groups = $response->{'items'};


for ($i = 0; $i < $count; $i++){
 	foreach ($groups[$i] as $key=>$value) {
			$param[$i][$key] = $value;
			//print $key .": ". $param[$i][$key];		
	}
}


print "<h3><a href=index.php?id=user".$uid.">".@$param1[0][first_name]."   ".@$param1[0][last_name]."</a> -> Группы [". $count ."]</h3><br>";

	

for ($a = 0; $a < $count; $a++){ 
	$curr = $a + 1; 

echo "
<table border='0' align='center' width='100%'>
    <tr>
        <td rowspan='7' width='100px' align='center'><a href='?id=group&uid=".$user_id."&gid=".@$param[$a][id]."'><img src='".@$param[$a][photo_100]."'/></a><br></td>
        <td><b>".@$param[$a][name]." [".@$param[$a][members_count]."]</b></td>
    </tr>
    <tr>
        <td>Тип: ".@$param[$a][type]."</td>
    </tr>
    <tr>
        <td>Админ? :".@$param[$a][is_admin]."</td>
    </tr>
    <tr>
		<td>";
		if ($param[$a]['is_member']!=1){
			echo "<a href=\"#\" class=\"btn btn-default\">вступить</a>";
		} else {
			echo "<a href=\"#\" class=\"btn btn-default\">выйти</a>";
		};
echo "
		</td>
	</tr>
    <tr>
        <td> :</td>
    </tr>
    <tr>
        <td></td>
    </tr>
    <tr>
        <td></td>
    </tr>
</table>

";

}




//************************************************************************************
//при удачном входе пользователю выдается все, что расположено ВЫШЕ между звездочками.
}
	
?>
		
