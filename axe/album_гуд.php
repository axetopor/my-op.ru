<?php 

if (@$myrow3['login'] = @$login) {
//���������, �� ��������� �� ������ ������������ �� ����. ���� ���, �� �� �� �����, ���� ������ � ������ ��������. ������� ���� ��� �����. �� �� �� ����� ��� �������� ��� ��������, �� ��� ��� �� �����.

exit("���� �� ��� �������� �������� ������ ������������������ �������������!");
}

else
{
//************************************************************************************
$token = "a1da1f50196528d61bb9b91458657771a5d1b81398da638d250ad5fc2125f52aaa5bc7a87414b3164a8e9";
$album_id = "198262884";
// $owner_id = @$_GET ['uid'];
$owner_id = "";
// $json = file_get_contents('https://api.vk.com/method/photos.get?v=5.62&owner_id='.$owner_id.'&album_id='.$album_id.'&access_token='. $token .'' );
$json = file_get_contents('https://api.vk.com/method/photos.get?v=5.62&album_id='.$album_id.'&access_token='. $token .'' );
$photos_arr = json_decode($json);
// print var_dump($photos_arr);

$photos = $photos_arr->{'response'};
$count = $photos->{'count'};
$photo = $photos->{'items'};


for ($i = 0; $i < $count; $i++){
 	foreach ($photo[$i] as $key=>$value) {
			$param[$i][$key] = $value;		
	}
}


print "���������� � �������: ". $count ."<br>";

	

	for ($a = 0; $a < $count; $a++){ 
	$curr = $a + 1; 
	echo "	
	
					<a class=\"fancybox\" rel=\"group\" href='".@$param[$a][photo_604]."' title='���������� ".$curr." �� ".$count."'>
						<img  src='".@$param[$a][photo_130]."'/>
					</a>
	";
   if (($curr % 5) == 0)
   {
     echo "|";
   }
	} 







//************************************************************************************
//��� ������� ����� ������������ �������� ���, ��� ����������� ���� ����� �����������.
}
	
?>
		
