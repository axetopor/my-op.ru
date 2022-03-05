<?php 
	
	if (@$myrow3['login'] == @$login) {
		//проверяем, не извлечены ли данные пользователя из базы. Если нет, то он не вошел, либо пароль в сессии неверный. Выводим окно для входа. Но мы не будем его выводить для вошедших, им оно уже не нужно.
		
		exit("Вход на эту страницу разрешен только зарегистрированным пользователям!");
	}
	
	else
	{
		//************************************************************************************
		
		@$group_id = '&group_id='.$_GET ['gid'];
		@$gid = '&gid='.$_GET ['gid'];
		if (empty($group_id)) { $group_id = '$group_id=1';}
		
		$fields = "city,country,place,description,wiki_page,members_count,counters,start_date,finish_date,can_post,can_see_all_posts,activity,status,contacts,links,fixed_post,verified,site,ban_info,cover";
		$json = file_get_contents('https://api.vk.com/method/groups.getById?v=5.62'.$group_id.'&extended=1&fields='.$fields.'&access_token='.$token.'' );
		
		$groups = json_decode($json);
		$gitem = $groups -> response[0];
		
		foreach ($gitem as $key=>$value) { 
			$values[$key] = $value;	
		};
	print "<h2>".$values['name']."   ( ".$values['members_count']." )</h2>";
		
	print "<b> [ ".$values['description']." ]</b><br>";			

		if ($values['is_member']!=1){
			echo "<a href=\"#\" class=\"btn btn-default\">вступить</a>";
		} else {
			echo "<a href=\"#\" class=\"btn btn-default\">выйти</a><br>";
		};

		
		//print var_dump($values['counters']);
	print "
	<br>
	<br>
	<br>

	<a href=".$values['photo_200']."><img src=".$values['photo_50']."></a>
	
	<ul>
		<li>
			<a href=http://my-op.ru/?id=albums".$gid.">Фотоальxбомы  ".@$values['counters']->albums."</a>
		</li>
		<li>
			<a href=http://my-op.ru/?id=videos".$gid.">Видеозаписи  ".@$values['counters']->videos."</a>
		</li>
		<li>
			<a href=http://my-op.ru/?id=albums".$gid.">Аудиозаписи  ".@$values['counters']->albums."</a>
		</li>
		<li>
			<a href=http://my-op.ru/?id=albums".$gid.">Подписчики  ".@$values['counters']->albums."</a>
		</li>
		<li>
			<a href=http://my-op.ru/?id=albums".$gid.">Настройка  ".@$values['counters']->albums."</a>
		</li>
	</ul>
	
	
	
	";
	
	
		print "<details style=\"background: rgba(100, 100, 100, 0.04);\"><summary style=\"background: rgba(100, 100, 100, 0.04);\">dump</summary>";
		print "id: ".$values['id']."<br>";
		print "name: ".$values['name']."<br>";
		print "screen_name: ".$values['screen_name']."<br>";
		print "is_closed: ".$values['is_closed']."<br>";
		print "type: ".$values['type']."<br>";
		print "is_admin: ".$values['is_admin']."<br>";
		print "admin_level: ".$values['admin_level']."<br>";
		print "is_member: ".$values['is_member']."<br>";
		print "description: ".$values['description']."<br>";
		print "members_count: ".$values['members_count']."<br>";
		print "фотографий: ".$values['counters']->photos."<br>";
		print "альбомов: ".$values['counters']->albums."<br>";
		print "can_post: ".$values['can_post']."<br>";
		print "can_see_all_posts: ".$values['can_see_all_posts']."<br>";
		print "activity: ".$values['activity']."<br>";
		print "status: ".$values['status']."<br>";
		print "verified: ".$values['verified']."<br>";
		print "site: ".$values['site']."<br>";
		//print "cover: ".var_dump($values['cover'])."<br>";
		print "photo_50: ".$values['photo_50']."<br>";
		print "photo_100: ".$values['photo_100']."<br>";
		print "photo_200: ".$values['photo_200']."<br>";
		print "</details>";
		
		//************************************************************************************
		//при удачном входе пользователю выдается все, что расположено ВЫШЕ между звездочками.
	}
	
?>

