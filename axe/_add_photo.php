<?php

include 'config.php';
include 'functions.php';
@$album_id = $_GET['aid'];




	$json = file_get_contents('https://api.vk.com/method/photos.getUploadServer?album_id='.$album_id.'&access_token='.$token1.'' );
	$json_arr = json_decode($json);

	print_r($json_arr);



//Всплывающие окна
echo '<div ><details style="background-color: REBECCAPURPLE; overflow: auto;"><pre>';
print_r ($json_arr);
echo '</pre></details></div>';

?>