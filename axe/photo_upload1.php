<?php

$group_id = "408502893";
$access_token = "ad67eedd0d4c2a7a46a1d5d8a6513cce823052052dc072a3bab69852a140c465570b0edb6f5f20dca3acb";

$resp = file_get_contents('https://api.vk.com/method/photos.getWallUploadServer?group_id=138132830&access_token=ad67eedd0d4c2a7a46a1d5d8a6513cce823052052dc072a3bab69852a140c465570b0edb6f5f20dca3acb');
$obj = json_decode($resp);

$arrpar = $obj->{'response'};
echo "<br/> response  ==== <font color='red'> " .var_dump($arrpar)."</font>";

$url = $arrpar->{'upload_url'};
$par2 = $arrpar->{'aid'};
$par3 = $arrpar->{'mid'};





echo "<br/> upload_url  ====  " .$url;
echo "<br/> aid  ====  " .$par2;
echo "<br/> mid  ====  " .$par3;
echo "<br/> ========================= <br/><br/>";



echo "
<form enctype=\"multipart/form-data\" action=\"$url\" method=\"POST\">
<input name=\"photo\" type=\"file\" />
<input type=\"submit\" value=\"Send File\" />
</form>
";


// $postdata = array(
	// 'photo' => 'https://pp.vk.me/c836432/v836432893/1f2d2/0v5cq8f0Sr8.jpg' //наш файл
// );

// $ch = curl_init();
// curl_setopt($ch, CURLOPT_URL, $url);
// // установка метода передачи параметров
// curl_setopt($ch, CURLOPT_POST, 1);
// // установка браузера
// curl_setopt($ch, CURLOPT_USERAGENT, "User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; ru; rv:1.9.2.13) Gecko/20101203 Firefox/3.6.13");
// $headers = array(
    // 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
    // 'Accept-Language: ru-ru,ru;q=0.8,en-us;q=0.5,en;q=0.3',
    // 'Accept-Encoding: deflate',
    // 'Accept-Charset: windows-1251,utf-8;q=0.7,*;q=0.7'
// );
// curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
// // параметры метода POST
// curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
// $out = curl_exec($ch);

// // отображение информации об ошибках работы cURL
// echo "\n\ncURL error number:" . curl_errno($ch) . " <br>";
// echo "\n\ncURL error:" . curl_error($ch) . " <br>";
 
// // завершение сеанса и освобождение ресурсов
// curl_close($ch);
 
// echo $out;



?>