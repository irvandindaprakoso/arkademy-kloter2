<?php
	try {
	  //get database name from file
	$mysql_hostname = "localhost";  //alamat server
	$mysql_user = "root";       	//username untuk koneksi ke database
	$mysql_password = "";   //password koneksi ke database
	$mysql_database = "arkademy_db";   //nama database yang akan diakses	
	  // buat koneksi dengan database
	  $pdo = new PDO("mysql:charset=utf8mb4;host=$mysql_hostname; dbname=$mysql_database", "$mysql_user", "$mysql_password");
	  $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	}
	catch (PDOException $e) {
	  print "Connection problem : " . $e->getMessage() . "<br/>";
	  die();
	}
?>