<?

// $owner_id_url= $userRow['owner_id'];

// $owner_id = $_GET['uid'];
// $owner_id_url = $_GET['owner_id'];
$owner_id = $userRow['owner_id'];
$owner_id = $_GET['owner_id'];
// $owner_id = trim($owner_id_url,"-");
// echo $owner_id;
	// AlbumsGet($userRow['userId'], $userRow['token'], $iferr);
	AlbumsGet($owner_id, $userRow['token'], @$iferr);





		echo @$userRow['token']. $owner_id.$_SESSION['owner_id'];
	if (($owner_id{0})<>"-") echo "
	
	   	<div class=\"page-header\">
    	<h3>".$userRow['FirstName']." ".$userRow['LastName']." ->  Альбомы <b style=\"color:#9B9B8C;\">[" .$albums_count."]</b></h3>
    </div>
	
	<br><br>
		
	";
	else
	echo "
	
	   	<div class=\"page-header\">
    	<h3>Альбомы сообщества<b style=\"color:#9B9B8C;\">[" .$albums_count."]</b></h3>
    </div>
	
	<br><br>
		
	";

	for ($i = 0; $i < $albums_count; $i++) {

	echo '


				
				<a href="?id=album&aid='. @$param[$i]['aid'] .'&owner_id='. @$owner_id.'">
			<div class="thumbnail" style="height: 200px; width: 250px; float: left; background: url('.@$param[$i]['thumb_src'].'); background-size: cover;" >
			
				<!-- <img  src="'.@$param[$i]['thumb_src'].'" /> -->
				
				<div class="caption" style="background: rgba(6, 6, 6, 0.32); margin-top: 140px;     border-radius: 4px;">
				<p style="color: white;     text-shadow: 2px 2px 3px black;">'. @$param[$i]['title'].' ['.@$param[$i]['size'].']</p>
				</div>
				
			</div>
				</a>
			<div style="height: 200px; width: 10px; float: left;">
			</div>

	';
	}
	// echo "	</div>";
	?>