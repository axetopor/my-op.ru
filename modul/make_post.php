<?php

//http://my-op.ru/axe/_post_add.php&uid=-138197060&attachment=photo105253591_456239323


$owner_id = $_GET ['owner_id']; // Куда постим
$gid = '142287772'; // Куда постим
$token = $userRow['token']; 
// $token = 'c2786e0d144ffbfb8c74e098356b0083d61fc5fd6d0a31435b7454a46d15f5faf12af1ea8cd072d1464e7'; 
$attachment = $_GET ['attachment']; // Куда постим

//  ****************  Данные поста  ****************
$text = '';








$from_group = '1'; // 1 — запись будет опубликована от имени группы, 0 — запись будет опубликована от имени пользователя (по умолчанию)
$signed = '0';  // 1 — будет добавлена подпись (имя пользователя, разместившего запись), 0 — подписи добавлено не будет (по умолчанию)
//$post_id = '' //идентификатор записи, которую необходимо опубликовать. Данный параметр используется для публикации отложенных записей и предложенных новостей.
//$publish_date = time() + 3600 + 3600; //unixtime


// 214 Публикация запрещена. Превышен лимит на число публикаций в сутки, либо на указанное время уже запланирована другая запись, либо для текущего пользователя недоступно размещение записи на этой стене. 
// 219 Рекламный пост уже недавно публиковался. 
// 220 Слишком много получателей. 
// 222 Запрещено размещать ссылки. 

//	{
//		"response": {
//			"post_id": 399
//		}
//	}

//  ****************  ************  ****************

// строка запроса к серверу Вконтакте


$link = "https://api.vk.com/method/wall.post?owner_id=$owner_id&message=$text&attachment=$attachment&from_group=$from_group&publish_date=$publish_date&signed=$signed&access_token=$token";
$oResponce = file_get_contents($link);


$ojson = json_decode($oResponce);
@$error = $ojson->{'error'};
@$error_code = $error->{'error_code'};
@$error_msg = $error->{'error_msg'};
@$request_params = $error->{'request_params'};

// print $link;
@print $error_code."<br>";
@print $error_msg."<br><hr>";
// @print var_dump($request_params)."<br>";
@print time()." - done<br>";

$URL="https://vk.com/public".$gid;
header ("Location: $URL");

?>