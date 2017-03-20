<?php
try {
	$db = new PDO('mysql:host=localhost; dbname=db_comsci; charset=utf8','root','');
	echo "hello";
} catch (Exception $e) {
	echo "Can't connect";
}
 ?>

 