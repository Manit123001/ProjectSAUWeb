<?php 
	include_once 'module/ConClass.php';
	$db = new db();
	$rs = $db->findAll('tbcourse')->execute();

	while($r = mysql_fetch_array($rs)){
		echo $id_update = $r['id'];

	}
 ?>