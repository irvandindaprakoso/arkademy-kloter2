<?php
require "database.php";//database
require "Arkademy-class.php";//all data
	
	$class_arkademy = new Arkademy($pdo);
	$id     	    = $_POST['id'];
	$name           = $_POST['name'];
	$work 	        = $_POST['work'];
    $salary	        = $_POST['salary'];
    
    if (!empty($name)):
        $update = $class_arkademy->update($name, $work, $salary, $id);
        echo "success";
    else:
        echo "error";
    endif;
?>