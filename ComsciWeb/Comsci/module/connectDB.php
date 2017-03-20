<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="icon" href="images/sciencetabicon.png">

</head>
<body>
	
</body>
</html>

<?php
	// $host = 'mysql.hostinger.in.th';//mysql.hostinger.in.th
	// $user = 'u111028414_cssau';
	// $pwd = '123456';
	// $db = 'u111028414_cssau';

	$host = 'localhost';
	$user = 'root';
	$pwd = '';
	$db = 'db_comsci';

	$conn = mysql_connect($host, $user, $pwd) or die(mysql_errno());

	if($conn){
		$selectDB = mysql_select_db($db);

		if($selectDB){
			// mysql_query("SET NAMES UTF8");
			// echo "Connect Success";

		}else{
			// echo "Can't connect";
		}
	}


?>
<!--<link rel="icon" href="images/sciencetabicon.png">-->
