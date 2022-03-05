<?php 

if (@$myrow3['login'] == @$login) {
//проверяем, не извлечены ли данные пользователя из базы. Если нет, то он не вошел, либо пароль в сессии неверный. Выводим окно для входа. Но мы не будем его выводить для вошедших, им оно уже не нужно.

exit("Вход на эту страницу разрешен только зарегистрированным пользователям!");
}

else
{

$album_id = @$_GET ['aid'];
$owner_id = @$_GET ['uid'];
$json = file_get_contents('https://api.vk.com/method/photos.get?v=5.62&owner_id='.$owner_id.'&album_id='.$album_id.'&access_token='. $token .'' );
$photos_arr = json_decode($json);

$photos = $photos_arr->{'response'};
$count = $photos->{'count'};
$photo = $photos->{'items'};


for ($i = 0; $i < $count; $i++){
 	foreach ($photo[$i] as $key=>$value) {
			$param[$i][$key] = $value;		
	}
}


	
for ($a = 0; $a < $count; $a++){ 
	$curr = $a + 1; 
	echo "		
	
				<div class='photo_row' background='".@$param[$a][photo_130]."'>
					<a data-fancybox='group' href='".@$param[$a][photo_604]."' title='Избражение ".$curr." из ".$count."'>
						<img  src='".@$param[$a][photo_130]."'  class='photo_thumb' />
					</a>
				</div>";	
	
} 
	
	





//************************************************************************************
//при удачном входе пользователю выдается все, что расположено ВЫШЕ между звездочками.
}
	
?>
		
