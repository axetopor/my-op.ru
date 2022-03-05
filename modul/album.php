<?
$album_id = @$_GET ['aid'];
$owner_id = @$_GET ['owner_id'];
$token = 'c2786e0d144ffbfb8c74e098356b0083d61fc5fd6d0a31435b7454a46d15f5faf12af1ea8cd072d1464e7'; 
	if ($owner_id <> ''){
		
			$id = 'owner_id='.$owner_id.'';
			
			// print $owner_id.'_'.$album_id;
	};


$json2 = file_get_contents('https://api.vk.com/method/photos.getAlbums?'.$id.'&need_covers=1&access_token='.$userRow['token'].'' );
$albums_title = json_decode($json2);

$titles1 = $albums_title->{'response'};
$count = count($titles1);
@$titles = $titles1->{'items'};
// var_dump($titles1[0]);

// echo $titles1[0]->{'aid'};

// echo $titles1[0]->{'aid'};
// print $titles1;
for ($tt = 0; $tt < $count; $tt++){
 	foreach ($titles1[$tt] as $key1=>$value1) {
			
			$param[$tt][$key1] = $value1;
			
	}
			// echo $titles1[$tt]->{'aid'};			
			// print $param[$tt]['aid'];				
			// print $param[$tt]['id'];				
			//$group_title[$param[$tt]['aid']] = $param[$tt]['title'];

			
			$title[$param[$tt]['aid']] = $param[$tt]['title'];
			

}


$json = file_get_contents('https://api.vk.com/method/photos.get?'.$id.'&album_id='.$album_id.'&access_token='.$userRow['token'].'' );
// var_dump ($json);

$photos_arr = json_decode($json);

$photos = $photos_arr->{'response'};
// var_dump ($photos);
// print_r ($photos[0]);

$count = count ($photos);
// $PhotoID = $photos[];

$iferr = NULL;

	AlbumsGet($owner_id, $userRow['token'], $iferr);
	

echo "

<div class=\"page-header\">
<h3>";

	

echo "<a href=http://my-op.ru/page.php?id=albums&aid=".$album_id.">";
	// $tr_guid = trim($owner_id,'-');
	// echo groups_getById($tr_guid);
	echo "</a> ".@$param['aid']['owner_id'];
	echo "  [".$count."]";
	echo "</h3></div><div class=\"row\">";

	
for ($i = 0; $i < $count; $i++){
	
	
	// ["src_small"]=> string(63) "https://pp.userapi.com/c626520/v626520893/5a7f3/mxVN80FZtD0.jpg" 75x63
	// ["src"]=> string(63) "https://pp.userapi.com/c626520/v626520893/5a7f4/rZK-yg6gxD4.jpg" 130x109
	// ["src_big"]=> string(63) "https://pp.userapi.com/c626520/v626520893/5a7f5/_jL7aVlwkuQ.jpg" 604x505
	// ["src_xbig"]=> string(63) "https://pp.userapi.com/c626520/v626520893/5a7f6/JoS2Q0C4vNU.jpg" 807x675
	// ["src_xxbig"]=> string(63) "https://pp.userapi.com/c626520/v626520893/5a7f7/To9hU45Iimw.jpg" 1280x1070
	// ["src_xxxbig"]=> string(63) "https://pp.userapi.com/c626520/v626520893/5a7f8/Klf8kicF0sI.jpg" 1600x1377
	

		$photo_id = $photos[$i]->{'pid'};
		
		@$photo_src_xxxbig = $photos[$i]->{'src_xxxbig'};
		@$photo_src_xxbig = $photos[$i]->{'src_xxbig'};
		@$photo_src_xbig = $photos[$i]->{'src_xbig'};
		@$photo_src_big = $photos[$i]->{'src_big'};
		@$photo_src = $photos[$i]->{'src'};
		@$photo_src_small = $photos[$i]->{'src_small'};
		
		$photo_src = array(
			$photo_src_xxxbig,
			$photo_src_xxbig,
			$photo_src_xbig,
			$photo_src_big,
		);
		
		
		
		if ($photo_src[0] != ""){
			echo "<a href='".$photo_src[0]."' data-fancybox='images'>";
		} ELSE { 
				if ($photo_src[1] != ""){ 
					echo "<a href='".$photo_src[1]."' data-fancybox='images'>";
			} ELSE { 
				if ($photo_src[2] != ""){ 
					echo "<a href='".$photo_src[2]."' data-fancybox='images'>";
				} ELSE { 
					if ($photo_src[3] != ""){ 
						echo "<a href='".$photo_src[3]."' data-fancybox='images'>";
					};		
				};
			};
		};
		
		
	echo "
		<div style=\"overflow: hidden; float: left; width: 200px; height: 150px; background: url(".$photos[$i]->{'src_big'}."); background-size: cover;     background-position: center;\" class=\"thumbnail\" \>

		</div>
		</a>
					<div style='width: 14px; height: 14px; float: left; '>
						<a href=?id=post&attachment=photo";
							echo $owner_id."_".$photo_id."&owner_id=-142287772&access_token=".$userRow['token'];
							echo $photos[$i]->{'pid'};
						echo " target=_blank>
							<img src='http://my-op.ru/images/steam.png' style='position: relative; left: -18px;'>
						</a>
					</div>
		";
		echo "



		<div style=\"height: 10px; width: 10px; float: left;\"></div>";

}
echo "</div>";

?>