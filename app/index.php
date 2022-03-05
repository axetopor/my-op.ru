<?php

$api_url	=	@$_GET['api_url'];
$api_id			=	@$_GET['api_id'];
$api_settings	=	@$_GET['api_settings'];
$viewer_id		=	@$_GET['viewer_id'];
$viewer_type	=	@$_GET['viewer_type'];
$sid			=	@$_GET['sid'];
$secret			=	@$_GET['secret'];
$access_token	=	@$_GET['access_token'];
$user_id		=	@$_GET['user_id'];
$group_id		=	@$_GET['group_id'];
$is_app_user	=	@$_GET['is_app_user'];
$auth_key		=	@$_GET['auth_key'];
$language		=	@$_GET['language'];
$parent_lang	=	@$_GET['parent_language'];
$is_secure		=	@$_GET['is_secure'];
$ads_app_id		=	@$_GET['ads_app_id'];
$referrer		=	@$_GET['referrer'];
$lc_name		=	@$_GET['lc_name'];
$hash			=	@$_GET['hash'];


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<title>Создание и продвижение сайтов в сети интернет | Топорков Дмитрий</title>
	<link rel="stylesheet" href="style.css" type="text/css" media="all" />
	<!--[if lte IE 6]><link rel="stylesheet" href="css/ie6.css" type="text/css" media="all" /><![endif]-->
	<script src="js/jquery-1.4.1.min.js" type="text/javascript"></script>
	<script src="js/jquery.jcarousel.pack.js" type="text/javascript"></script>
	<script src="js/jquery-func.js" type="text/javascript"></script>


	<script src="https://vk.com/js/api/xd_connection.js?2"  type="text/javascript"></script>
	<script type="text/javascript"> 
	VK.init(function() { 
		// API initialization succeeded 
		// Your code here 
		VK.callMethod("showSettingsBox", 8214);
	}, function() { 
		// API initialization failed 
		// Can reload page here 
	}, '5.68'); 
</script>
</head>

<body>

<?php 



echo "<b>api_url :</b>".$api_url."<br>";
echo "<b>api_id :</b>".$api_id."<br>";
echo "<b>api_settings :</b>".$api_settings."<br>";
echo "<b>viewer_id :</b>".$viewer_id."<br>";
echo "<b>sid :</b>".$sid."<br>";
echo "<b>secret :</b>".$secret."<br>";
echo "<b>access_token :</b>".$access_token."<br>";
echo "<b>is_app_user :</b>".$is_app_user."<br>";
echo "<b>auth_key :</b>".$auth_key."<br>";
?>
<a href="VK.callMethod("showSettingsBox", 8214);">ссылка</a>
</body>
</html>
<!--
?api_url=https://api.vk.com/api.php
api_id=6229459
api_settings=136195263
viewer_id=105253591
viewer_type=0
sid=b63601dc2ac288d6e4529bc2b13dd09df85314d20154c16b1f2d73c8cbf8b96d402d74e10f27c7666a508
secret=9de23148c1
access_token=5ed909f702ca6f9cf478823a384629924b479e82ead45e6d302747572591b82e432186cc4fbdcd74526bc
user_id=0
group_id=0
is_app_user=1
auth_key=e0b2a01d7b13fc558479b8f2fd0f67b6
language=0
parent_language=0
is_secure=1
ads_app_id=6229459_d0aebf0e7254166642
referrer=unknown
lc_name=daa2800e
hash=
--!>