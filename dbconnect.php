<?php

	// обход mysql_connect() deprecation error.
	// error_reporting( ~E_DEPRECATED & ~E_NOTЫICE );
	// но лучше через PDO or MySQLi.
	
	define('DBHOST', 'localhost');
	define('DBUSER', 'axe_root');
	define('DBPASS', 'nuttertools');
	// define('DBNAME', 'myop_new');
	define('DBNAME', 'myop');
	
	$conn = mysql_connect(DBHOST,DBUSER,DBPASS);
	$dbcon = mysql_select_db(DBNAME);
	
	if ( !$conn ) {
		die("Соединение не удалось : " . mysql_error());
	}
	
	if ( !$dbcon ) {
		die("Не удалось подключиться к базе данных : " . mysql_error());
	}
	?>