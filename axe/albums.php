<?php

include 'config.php';
include 'functions.php';





AlbumsGet($user_id, $token, $iferr);





	echo "Всего альбомов: [" .$albums_count."] <br>";

	for ($i = 0; $i < $albums_count; $i++) {

	echo '
	<a href="?aid='. @$param[$i]['aid'] .'&uid='. @$param[$i]['owner_id'] .'">
    <img src="'.@$param[$i]['thumb_src'].'" />
	'. @$param[$i]['title'].' ['.@$param[$i]['size'].']
	</a></br>';		
		
	}


?>