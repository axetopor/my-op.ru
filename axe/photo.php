<?php 

if (@$myrow3['login'] == @$login) {
//проверяем, не извлечены ли данные пользователя из базы. Если нет, то он не вошел, либо пароль в сессии неверный. Выводим окно для входа. Но мы не будем его выводить для вошедших, им оно уже не нужно.

exit("Вход на эту страницу разрешен только зарегистрированным пользователям!");
}

else
{
//************************************************************************************
$photo = @$_GET ['photo'];

if($photo == NULL)
    {
        header("Location: ?id=photo&photo=408502893_456240147"); exit();
}

$json = file_get_contents('https://api.vk.com/method/photos.getById?v=5.62&extended=1&photos='.$photo.'&access_token='. $token .'');
$photo_arr = json_decode($json, true);

//***************************** Пример JSON ответа ***********************************
// {"response":[{
	// "id":456240147,
	// "album_id":-6,
	// "owner_id":408502893,
	// "photo_75":"https:\/\/pp.userapi.com\/c633631\/v633631036\/3b99a\/pd6hx9PtY6w.jpg",
	// "photo_130":"https:\/\/pp.userapi.com\/c633631\/v633631036\/3b99b\/IgpqS-BB02A.jpg",
	// "photo_604":"https:\/\/pp.userapi.com\/c633631\/v633631036\/3b99c\/lbNsZDQC8Ho.jpg",
	// "photo_807":"https:\/\/pp.userapi.com\/c633631\/v633631036\/3b99d\/fKnrptaBFAI.jpg",
	// "photo_1280":"https:\/\/pp.userapi.com\/c633631\/v633631036\/3b99e\/9Q1cWNl_gGA.jpg",
	// "photo_2560":"https:\/\/pp.userapi.com\/c633631\/v633631036\/3b99f\/S6yUig10FuY.jpg",
	// "width":2560,
	// "height":1440,
	// "text":"",
	// "date":1488384933,
	// "post_id":37,
	// "likes":{"user_likes":0,"count":4},
	// "reposts":{"count":0},
	// "comments":{"count":0},
	// "can_comment":1,
	// "can_repost":1,
	// "tags":{"count":0}
	// }
// ]}
//*************************************************************************************

//$photo_130 = $photo_arr["response"][0]["photo_130"]; //** Рабочий пример **

foreach ($photo_arr["response"][0] as $name => $value) {
    if (!strncmp($name, "JSON_ERROR_", 11)) {
        $json_errors[$value] = $name;
    }
	
	$param[$name] = $value;
	// print $name .": ".$param[$name];
	// print "</br>";
}


print "

<div style='height: 500px;width: 100%;
no-repeat;
center;
top;
background: url($param[photo_130]);
background: url($param[photo_604]);
background: url($param[photo_807]);
background: url($param[photo_1280]);
background: url($param[photo_2560]);
background-size: contain;
background-repeat: no-repeat;
'>
</div>
";


foreach ($param as $name1 => $value1) {

	$param1[$name1] = $value1;
	@print "<b style='text-align: right;'>".$name1." :        </b><h style='text-decoration: none;'>".$param1[$name1]."</h></br>";
}

//************************************************************************************
//при удачном входе пользователю выдается все, что расположено ВЫШЕ между звездочками.
}
?>