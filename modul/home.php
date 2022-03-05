   	<div class="page-header">
    	<h3>Главная страница</h3>
    </div>

	
<details>
<? echo 'ID: '.$userRow['userId']; ?><br>
<? echo 'User ID: '.$userRow['uid']; ?><br>
<? echo 'Имя: '.$userRow['FirstName']; ?><br>
<? echo 'Фамилия: '.$userRow['LastName']; ?><br>
<? echo 'token: '.$userRow['token']; ?><br>
<? echo 'userName: '.$userRow['userName']; ?><br>
<? echo 'userEmail: '.$userRow['userEmail']; ?><br>
<? echo 'userPass: '.$userRow['userPass']; ?><br>
</details>

<details>
<a href ="page.php?id=albums&gid=-87562343">Альбомы группы 87562343</a><br>
<? echo 'userPass: '.$userRow['userPass']; ?><br>
</details>


<a target=_blank href="https://oauth.vk.com/authorize?client_id=<? echo APPID; ?>&scope=friends,photos,audio,video,status,wall,offline,docs,groups,email&response_type=token&display=popup&redirect_uri=http://oauth.vk.com/blank.html">Войти вконтакте</a><br><br>

