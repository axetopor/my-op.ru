<?php

$uid = @$_GET ['uid']; //  уда постим
$token = @$_GET ['$token']; 
$attachment = @$_GET ['attachment']; //  уда постим

//  ****************  ƒанные поста  ****************
$text = 'Hello_world';
// $attachment = 'photo105253591_412076943';

?>


<a target=_blank href="https://oauth.vk.com/authorize?client_id=$client_id&scope=friends,photos,audio,video,status,wall,offline,docs,groups,email&response_type=code&redirect_uri=http://my-op.ru/vk_add.php">¬ойти вконтакте</a><br><br>
<a target=_blank href="https://oauth.vk.com/authorize?client_id=$client_id&scope=friends,photos,audio,video,status,wall,offline,docs,groups,email&response_type=token&display=page&redirect_uri=http://oauth.vk.com/blank.html">¬ойти вконтакте</a><br><br>



<?

$from_group = '1'; // 1 Ч запись будет опубликована от имени группы, 0 Ч запись будет опубликована от имени пользовател€ (по умолчанию)
$signed = '1';  // 1 Ч будет добавлена подпись (им€ пользовател€, разместившего запись), 0 Ч подписи добавлено не будет (по умолчанию)
//$post_id = '' //идентификатор записи, которую необходимо опубликовать. ƒанный параметр используетс€ дл€ публикации отложенных записей и предложенных новостей.
$publish_date = time() + 3600 + 3600; //unixtime


// 214 ѕубликаци€ запрещена. ѕревышен лимит на число публикаций в сутки, либо на указанное врем€ уже запланирована друга€ запись, либо дл€ текущего пользовател€ недоступно размещение записи на этой стене. 
// 219 –екламный пост уже недавно публиковалс€. 
// 220 —лишком много получателей. 
// 222 «апрещено размещать ссылки. 

//	{
//		"response": {
//			"post_id": 399
//		}
//	}

//  ****************  ************  ****************

// строка запроса к серверу ¬контакте


$link = "https://api.vk.com/method/wall.post?owner_id=$uid&message=$text&attachment=$attachment&from_group=$from_group&publish_date=$publish_date&signed=$signed&access_token=$token";
$oResponce = file_get_contents($link);


$ojson = json_decode($oResponce);
@$error = $ojson->{'error'};
@$error_code = $error->{'error_code'};
@$error_msg = $error->{'error_msg'};
@$request_params = $error->{'request_params'};

// print $link;
@print $error_code."<br>";
@print $error_msg."<br><hr>";
@print var_dump($request_params)."<br>";

?>