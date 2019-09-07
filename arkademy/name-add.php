<?php
require "database.php";//database
require "Arkademy-class.php";//all data
	
	$class_arkademy = new Arkademy($pdo);
	$name           = $_POST['name'];
	$work  	        = $_POST['work'];
	$salary         = $_POST['salary'];

    if (!empty($name)):
        $add = $class_arkademy->add($name, $work, $salary);
        echo "success";
    else:
        echo "error";
    endif;
?>