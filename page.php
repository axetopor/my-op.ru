<?php
	ob_start();
	session_start();
	require_once 'dbconnect.php';
	require_once 'config.php';
	require_once 'functions.php';
	
	// if session is not set this will redirect to login page
	if( !isset($_SESSION['owner_id']) ) {
		header("Location: index.php");
		exit;
	}
	
	$id = $_GET['id'];
	$userRow = NULL;
	// select loggedin users detail
	$res=mysql_query("SELECT * FROM users WHERE owner_id=".$_SESSION['owner_id']);
	$userRow=mysql_fetch_array($res);
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<!-- Заголовок страницы -->
	<title>Добро пожаловать - <?php echo $userRow['userEmail']; ?></title>

	<!-- Шрифты -->
	<link href='http://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>

	<!-- style.css jquery.min.js -->
    <script src="assets/jquery-1.11.3-jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
	
	<!-- bootstrap -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css"  />
	<link rel="stylesheet" href="assets/style.css" type="text/css" />
	
	<!-- fancybox -->
	<link rel="stylesheet" href="assets/fancybox/jquery.fancybox.css" type="text/css" media="screen" />
	<script type="text/javascript" src="assets/fancybox/jquery.fancybox.js"></script>

	<script type="text/javascript">
$(document).ready(function() {
$( '[data-fancybox]' ).fancybox({
	image : {
		protect : true
	},
	caption : function( instance, item ) {
    var caption, link;

    if ( item.type === 'image' ) {
      caption = $(this).data('caption');
      link    = '<a href="' + item.src + '">Download image</a><br>';

      return (caption ? caption + '<br />' : '') + link;
    }

	}
	var frameSrc = "https://oauth.vk.com/authorize?client_id=5920240&scope=friends,photos,audio,video,status,wall,offline,docs,groups,email&response_type=token&display=page&redirect_uri=http://oauth.vk.com/blank.html";

		$('#openBtn').click(function(){
			$('#myModal').on('show', function () {

			$('iframe').attr("src",frameSrc);
      
			});
			$('#myModal').modal({show:true})
		});
	
	});
});

	</script>

	<style>
.page {
  padding: 15px 0 0;
}

.bmd-modalButton {
  display: block;
  margin: 15px auto;
  padding: 5px 15px;
}

.close-button {
  overflow: hidden;
}

.bmd-modalContent {
  box-shadow: none;
  background-color: transparent;
  border: 0;
}
  
.bmd-modalContent .close {
  font-size: 30px;
  line-height: 30px;
  padding: 7px 4px 7px 13px;
  text-shadow: none;
  opacity: .7;
  color:#fff;
}

.bmd-modalContent .close span {
  display: block;
}

.bmd-modalContent .close:hover,
.bmd-modalContent .close:focus {
  opacity: 1;
  outline: none;
}

.bmd-modalContent iframe {
  display: block;
  margin: 0 auto;
}
	</style>
</head>

<body>

	<nav class="navbar navbar-default navbar-fixed-top" style="">
      <div class="container">
        <div class="navbar-header" style="">
          
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="/">Главная</a></li>
            <li><a href="?id=albums&owner_id=448394268">Альбомы</a></li>
            <li><a href="?id=friends">Друзья</a></li>
            <li><a href="?id=post">post</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
			  <span class="glyphicon glyphicon-user"></span>&nbsp;Hi' <?php echo $userRow['userEmail']; ?>&nbsp;<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Настройки</a></li>
                <li><a href="?id=admin"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Админ панель</a></li>
                <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Выход</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav> 

	<div id="wrapper">

	<div class="container">
    
        
			<?php
			switch($id) {
			case 'albums': include("modul/albums.php"); break;
			case 'album': include("modul/album.php"); break;
			case 'admin': include("modul/admin.php"); break;
			case 'friends': include('modul/friends.php'); break;
			case 'post': include("modul/make_post.php"); break;
			default: include("modul/home.php");
			
			}
			?>
    
    </div>
    
    </div>
    



<div id="myModal" class="fade" tabindex="-1" role="dialog">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal">×</button>
			<h3>Dialog</h3>
	</div>
	<div class="modal-body">
      <iframe src="" style="zoom:0.60" width="99.6%" height="250" frameborder="0"></iframe>
	</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal">OK</button>
	</div>
</div>
<div class="mf-tile-box mf-mobile">
	<div class="mf-t">
	<img src="/static/media/cube.png" alt="">
	
	<div class="mf-t-link">
	<div class="mf-t-tile" style="position: relative; overflow: hidden; background: #0000ff;">
		<img src="/static/media/cube.png" alt="">
		<div class="mf-f-hover" style="background: url(https://pp.userapi.com/c636821/v636821286/38a72/BlxzpDSlowQ.jpg)"></div>

		<a class="mf-tile" href="http://vk.com/"></a>
		<div class="mf-t-content" >
			<div>
				<div >
					<h4>VK.COM</h4>
				</div>
			</div>
		</div>
	 </div>
	 </div>
	 </div>
</div>







</body>
</html>
<?php ob_end_flush(); ?>