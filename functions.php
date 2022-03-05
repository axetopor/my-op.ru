<?php

function AlbumsGet($owner_id, $token, $iferr){
	
	@$captcha = '&captcha_sid='.$_GET ['captcha_sid'].'&captcha_key='.$_GET ['captcha_key'];
	// echo $captcha;
	
	global $param;
	global $albums_count;
	global $album_title;
	global $group_title;
	global $error;

	
	// if $user_id = 
	$id = 'owner_id='.$owner_id.'&';

			 
				// if (($owner_id{0})<>"-"){
					// $id = 'owner_id=-'.$owner_id.'';
				// } else {
					// $id = 'owner_id='.$owner_id.'';
				// };

	
	
	
    
	// $json = file_get_contents('https://api.vk.com/method/photos.getAlbums?uid=-87562343&need_system=1&need_covers=1&access_token='.$token.''.$captcha );
	$json = file_get_contents('https://api.vk.com/method/photos.getAlbums?'.$id.'&need_covers=1&need_system=1&access_token='.$token.''.$captcha );
	$photos_arr = json_decode($json);
	

	@$error = $photos_arr->{'error'};
	
	
	
if(isset($error)) {
	$err = $error->{'error_code'};
	if ($err == 5){
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
		// echo $redirect_uri;
	}
	
} else {
	// $param[]['title'] = NULL;
	$response = $photos_arr->{'response'};
	$albums_count = count($response);
	for ($i = 0; $i < $albums_count; $i++) {

		foreach ($response[$i] as $key=>$value) {
			$param[$i][$key] = $value;
			// echo $key.": ".$value."<br>";
			
			
			// echo $param[$i]['id'];
			// echo "<br>";
			// echo $param[$i]['title'];
			// echo "<br>";
		}
		$album_title[$param[$i]['aid']] = $param[$i]['title'];		
		// echo "<hr>";
	}

}
		
}


	
	
	#########################################################################################
	##	{																					#
	##		"response": [{                              ---- $group_info->{'response'};		#
	##			"gid": 00000000,															#
	##			"name": "Имя заветной группы",
	##			"screen_name": "SHORT_NAME",
	##			"is_closed": 0,
	##			"type": "group",
	##			"is_admin": 0,
	##			"is_member": 0,
	##			"description": "Описание группы!",
	##			"photo": "https://pp.userap...ad7/u3apuk3nKek.jpg",
	##			"photo_medium": "https://pp.userap...ad6/jIsScXTOT5g.jpg",
	##			"photo_big": "https://pp.userap...ad5/7E-LEsUfG4k.jpg"
	##		}]
	##	}																					#	
	#########################################################################################
	
	
function groups_getById($group_ids){

	
	$GIfields = "city, country, place, description, wiki_page, members_count, counters, start_date, finish_date, can_post, can_see_all_posts, activity, status, contacts, links, fixed_post, verified, site, ban_info, cover";
	$Gid = $group_ids;
	
	// $group_json = file_get_contents('https://api.vk.com/method/groups.getById?group_ids='.$Gid.'fields='.$GIfields.'&access_token='.$userRow['token'].'' );
	$group_json = file_get_contents('https://api.vk.com/method/groups.getById?group_ids='.$Gid.'' );
	$group_arr = json_decode($group_json);
		//var_dump($group_arr);
	$group_info = $group_arr->{'response'};
		// var_dump($group_info);
	
	$gname = $group_info[0]->{'name'};
	$gid = $group_info[0]->{'gid'};
	
	
	
	print $gname;


}

?>