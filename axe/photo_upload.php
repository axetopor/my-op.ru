<?php
@$album_id = $_GET['album_id'];
include 'script/config.php';
$resp = file_get_contents('https://api.vk.com/method/photos.getWallUploadServer?album_id='.$album_id.'&access_token='.$token.'');
$obj = json_decode($resp);


// print_r($obj);

$arrpar = $obj->{'response'};
echo "<br/> response  ==== <font color='red'> " .var_dump($arrpar)."</font>";

$url = $arrpar->{'upload_url'};
$par2 = $arrpar->{'aid'};
$par3 = $arrpar->{'mid'};





echo "<br/> upload_url  ====  " .$url;
echo "<br/> aid  ====  " .$par2;
echo "<br/> mid  ====  " .$par3;
echo "<br/> ========================= <br/><br/>";






$postdata = array(
	'photo' => 'https://pp.vk.me/c836432/v836432893/1f2d2/0v5cq8f0Sr8.jpg' //наш файл
);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
// установка метода передачи параметров
curl_setopt($ch, CURLOPT_POST, 1);

// параметры метода POST
curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
curl_exec($ch);

var_dump($ch);

// отображение информации об ошибках работы cURL
echo "\n\ncURL error number:" . curl_errno($ch) . " <br>";
echo "\n\ncURL error:" . curl_error($ch) . " <br>";
 
// завершение сеанса и освобождение ресурсов
curl_close($ch);
 
echo $ch;



?>