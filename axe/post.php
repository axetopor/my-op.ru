<?php

$uid = @$_GET ['uid']; // ���� ������
$token = @$_GET ['$token']; 
$attachment = @$_GET ['attachment']; // ���� ������

//  ****************  ������ �����  ****************
$text = 'Hello_world';
// $attachment = 'photo105253591_412076943';

?>


<a target=_blank href="https://oauth.vk.com/authorize?client_id=$client_id&scope=friends,photos,audio,video,status,wall,offline,docs,groups,email&response_type=code&redirect_uri=http://my-op.ru/vk_add.php">����� ���������</a><br><br>
<a target=_blank href="https://oauth.vk.com/authorize?client_id=$client_id&scope=friends,photos,audio,video,status,wall,offline,docs,groups,email&response_type=token&display=page&redirect_uri=http://oauth.vk.com/blank.html">����� ���������</a><br><br>



<?

$from_group = '1'; // 1 � ������ ����� ������������ �� ����� ������, 0 � ������ ����� ������������ �� ����� ������������ (�� ���������)
$signed = '1';  // 1 � ����� ��������� ������� (��� ������������, ������������� ������), 0 � ������� ��������� �� ����� (�� ���������)
//$post_id = '' //������������� ������, ������� ���������� ������������. ������ �������� ������������ ��� ���������� ���������� ������� � ������������ ��������.
$publish_date = time() + 3600 + 3600; //unixtime


// 214 ���������� ���������. �������� ����� �� ����� ���������� � �����, ���� �� ��������� ����� ��� ������������� ������ ������, ���� ��� �������� ������������ ���������� ���������� ������ �� ���� �����. 
// 219 ��������� ���� ��� ������� ������������. 
// 220 ������� ����� �����������. 
// 222 ��������� ��������� ������. 

//	{
//		"response": {
//			"post_id": 399
//		}
//	}

//  ****************  ************  ****************

// ������ ������� � ������� ���������


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