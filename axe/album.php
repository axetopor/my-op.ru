<?php

include 'config.php';
include 'functions.php';


$album_id = "-7";
@$album_id = $_GET['aid'];


// photos.getAlbums($owner_id, $token, $iferr);

AlbumsGet($user_id, $token, $iferr);







for ($q=1; $q < $albums_count; $q++){ 
	echo "<a href=album.php?aid=".$param[$q]['aid'].">".$param[$q]['aid']." | ".$param[$q]['title']."</a><br>";
}
	




$json = file_get_contents('https://api.vk.com/method/photos.get?v='.$ver.'&owner_id='.$user_id.'&album_id='.$album_id.'&access_token='. $token .'' );
$photos_arr = json_decode($json);

$photos = $photos_arr->{'response'};
// $photo = $photos[1];

// print_r ($photos[0]);
// print_r ($photo->{'width'});
// echo $photos[2]->{'width'};

for ($i = 1; $i < $photos[0]; $i++){
 	
	
	//������� SSL �� ������
		
		// $value = str_replace("https://", "http://", $value);
		
	
	
	
		 // $param[$i][$key] = $value;
		// echo $key ." - ". $param[$i][$key]."<br>";
		// echo $photos[$i][src]; 
		
		
		// echo $key;
		// echo " | ";
		// echo $value;
		// echo " <br> ";

	
	// echo "src_big - ". $param[$i]['src_big']."<br>";
	
}
print "<span style='size:14; '><a href='http://my-op.ru/index.php?id=albums&uid=".$user_id."'>�� ���� ��������</a> &nbsp; >&nbsp;";
print $param[0]['title'];
print "&nbsp;&nbsp;[". $photos[0] ."]</span><br><br><hr>";


	
$img = Array();
$link = array();
for ($a = 1; $a < $photos[0]; $a++){ 
	$curr = $a + 1;

		// if (isset($param1[$a]['photo_75'])){$link = $param1[$a]['photo_75'];}
		// if (isset($param1[$a]['photo_130'])){$link = $param1[$a]['photo_130'];}
		// if (isset($param1[$a]['photo_604'])){$link = $param1[$a]['photo_604'];}
		// if (isset($param1[$a]['photo_807'])){$link = $param1[$a]['photo_807'];}
		// if (isset($param1[$a]['photo_1280'])){$link = $param1[$a]['photo_1280'];}
		// if (isset($param1[$a]['photo_2560'])){$link = $param1[$a]['photo_2560'];}

// echo "
	// <a class='fancybox' rel='group' href='' title='".$photos[$i]->{'owner_id'}."'>
		// <img width='50' src='".@$photos[$a]->{'src_big'}."'/>
	// </a>
// ";



//������ ������ � ������������
		$img[$a] = $photos[$a]->{'src'};
		$param[$a]['width'] = $photos[$a]->{'width'};
		$param[$a]['height'] = $photos[$a]->{'height'};
		$param[$a]['src'] = $photos[$a]->{'src'};
		$param[$a]['text'] = $photos[$a]->{'text'};
		// echo var_dump($param[$a])."<br>";
}
$widthdef=640; //������ ����� �����������
$heightdef=100; //����������� ������ ����� ������
$margin=1; //������� ����� ����������

// echo $img[pid];
// echo var_dump($img);
$imagescount = count($img); //�������������, ���������� ��������
echo '<div style="width: 640px;">'; 

$first=2;

while($first<=$imagescount){
	$images=$first-1;
	$hightes=$heightdef+1;
		while($hightes > $heightdef && $images<$imagescount) {
			$images++;
			$width=$widthdef-($images-$first+1)*($margin*2); //������,� ������ �������
			$w[$images]=$param[$images-1]['width'];
			$h[$images]=$param[$images-1]['height']; //����������� ������ � ������ ���������� �� ���� �������������
			// $sizeq = getimagesize($img[$images]); //����������� ������ � ������ ���������� �� ���� �������������
			// echo var_dump($sizeq);
			$delim=$width*$h[$first];
	
			$delit=$w[$first];
	
			for($j=($first+1);$j<=$images;$j++) {
				@$delit=$delit+$w[$j]*($h[$first]/$h[$j]);
			}
			@$hightes=floor($delim/$delit);//������ ������
			

			if($hightes<=$heightdef) {
				for($i=$first;$i<=$images;$i++) {
					$ht=$hightes.'px';
					echo '
					<a class="fancybox-buttons" rel="fancybox-buttons" href="'.$img[$i].'" title="'.$param[$i-'1']['text'].'">
						<img style="margin:'.$margin.'px;" src="'.$img[$i].'" height="'.$ht.'">
					</a>
					'; //������� ��������
				}
				$first=$images+1;
		
			} else { 

				if($images==$imagescount) {
			 //����� ��������, ���� ���� �� ��������� ��������� �����������
					for($y=$first;$y<=$images;$y++) {
						echo '
						<a class="fancybox-buttons" rel="fancybox-buttons" href="'.$img[$i].'" title="'.$param[$i-'1']['text'].'">
							<img style="margin:'.$margin.'px;" src="'.$img[$y].'" height="'.$heightdef.'px">
						</a>';
					}
					$first=$images+1; //���������, � ����� �������� �������
				}
	
			}

		}
}
echo '<div>';
echo '</div>';
echo '</div>';

			echo '<div style="position:absolute; right:10px; top:10px; "><details style="background-color: REBECCAPURPLE;"><pre>';
			print_r ($photos_arr);
			echo '</pre></details></div>';








?>