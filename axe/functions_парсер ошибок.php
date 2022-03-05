<?php

function AlbumsGet($user_id, $token, $iferr){
	
	@$captcha = '&captcha_sid='.$_GET ['captcha_sid'].'&captcha_key='.$_GET ['captcha_key'];
	// echo $captcha;
	
	
	global $param;
	global $albums_count;
	global $group_title;

	

    
	$json = file_get_contents('https://api.vk.com/method/photos.getAlbums?need_system=1&need_covers=1&access_token='.$token.''.$captcha );
	$photos_arr = json_decode($json);
	

	@$error = $photos_arr->{'error'};

if(isset($error)) {
	$err = $error->{'error_code'};
	if ($err == 14){
		echo "
			Ошибка: [".$error->{'error_code'}."] <b>".$error->{'error_msg'}."</b> <br><br>
			<img src=".$error->{'captcha_img'}.">
			<form action='page.php?id=albums'>
			<p>
			<input type='text' hidden name='id' value='albums'><Br>
			<input type='text' hidden name='captcha_sid' value=".$error->{'captcha_sid'}."><Br>
			<input type='text' name='captcha_key' value=''><Br>
			</p>
			<p><input type='submit'></p>
			</form>";

	}
	
	if ($err == 3){
		
		$req_params = $error->{'request_params'};
		echo $error->{'error_msg'}." <br><pre>";
		print_r ($req_params);
		echo "</pre>";
	}
	
	if ($err == 5){
		
		$req_params = $error->{'request_params'};
		echo $error->{'error_msg'}." [";
		echo $error->{'error_code'}."] <br><pre>======= ";
		echo $token." =======<br>";
		print_r ($req_params);
		echo "</pre>";
	}	
	if ($err == 4){
		
		$req_params = $error->{'request_params'};
		echo $error->{'error_msg'}." <br><pre>";
		print_r ($error);
		echo "</pre>";
	}
	
		if ($err == 17){
		
		$redirect_uri = $error->{'redirect_uri'};
		echo "		
		<form action=\"page.php?id=albums\" method=\"post\">
		<button type=\"submit\" name=\"redirect_uri\" value=\".$redirect_uri.\" >Go</button>
		</form>";
		echo $redirect_uri;
	}
	
} else {
	
	$response = $photos_arr->{'response'};
	$albums_count = count($response);
	for ($i = 0; $i < $albums_count; $i++) {

		foreach ($response[$i] as $key=>$value) {
			$param[$i][$key] = $value;
			// $group_title[$param[$i]['id']] = $param[$i]['title'];
			
		}	
	}
	
}
			echo '<div style="position:absolute; right:10px; top:10px; "><details style="background-color: REBECCAPURPLE;"><pre>';
			print_r ($photos_arr);
			echo '</pre></details></div>';		
}


function PhotosGet($user_id, $token, $iferr){
}

?>