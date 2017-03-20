<?php
    error_reporting(0);
    session_start();
    include ('../module/connectDB.php');
    include ('../module/function.php');
    include ('../module/ConClass.php');
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width = device-width, initial-scale=1">
    <title>backContact</title>

    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>

    <!-- custom -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/vendors.css">

    <link rel="stylesheet" href="../fonts/font-awesome/font-awesome-4.6.2/css/font-awesome.min.css">

</head>


<script>
    function CheckValue(){

    if(document.getElementById('history_title').value == ""){
        alert('ป้อนข้อมูล');
        document.getElementById('history_title').focus();
        return false;
    }
    if(document.getElementById('history_text').value == ""){
        alert('ป้อนข้อมูล');
        document.getElementById('history_text').focus();
        return false;
    }

}
</script>


<?php
    if($_SESSION['login_id']==''){
        echo "<script language=\"javascript\">";
        echo "alert('กรุณาล๊อคอินเข้าสู้ระบบ');";
        echo "window.location='../login.php';";
        echo "</script>";
    } else{
?>
<body>

    <!-- History -->
    <?php
    $Act = $_GET['Act'];

    switch($Act){
        case 'UpdateContact':
                    $id = $_GET['id'];
                    $check = 'checked';

                    $Update = Update("tbcontact", "
                        message_read='".$check."' WHERE id = '".$id."'");

                        header('Location: housebackContact.php');
                      	exit;
        break;
    }
?>

<!-- Navbar and Header -->
<?php
    include ('header.php');
?>

<!-- Content -->
<div class="container-fluid" style="margin-top:20px;" >
    <?php
        include ('admin.php');
    ?>
    <div class="col-md-10">
        <h1 align="center">Contact</h1>

	<div class="col-md-12">
	 <div class="">
			 <div class="table-responsive" style="height:900px;">
					 <table class="table table-hover">
							 <thead>
									 <tr>
											 <th>#</th>
											 <th>Name</th>
											 <th>Email</th>
											 <th>Massage</th>
											 <th>date</th>
											 <th>ip</th>
											 <th>Read</th>
											 <th>Check</th>


									 </tr>
							 </thead>

							 <tbody>

									 <?php
									 $res = Select("tbcontact", "order by id desc" );
									 $i = 1;

									 while ($row = mysql_fetch_array($res))
									 {
											 $id = $row['id'];
											 $message_name = $row['message_name'];
											 $message_email = $row['message_email'];
											 $message_text = $row['message_text'];
											 $message_ip = $row['message_ip'];
											 $message_date = $row['message_date'];
											 $message_read = $row['message_read'];
											 ?>
											 <form action="?Act=UpdateContact&id=<?=$id;?>"  method="post" role="form" enctype="multipart/form-data">
													 <tr>
															 <td class="hidden"><?php echo $id; ?></td>
															 <td><?php echo $i; ?></td>
															 <td class="two"><?php echo $message_name; ?></td>
															 <td><?php echo $message_email; ?></td>

															 <td><?php echo $message_text; ?></td>
															 <td><?php echo $message_date; ?></td>
															 <td><?php echo $message_ip; ?></td>

															 <td>
																	<input class="disabled " type="checkbox" id="activateExam" name="activateExam[]" value="1" <?php echo $message_read; ?> >
															 </td>
															 <td>
																 <button type="submit" class="btn btn-primary" name="sumitFacUpdate"onclick="return CheckValue();" >Check</button>
															 </td>
													 </tr>
											 </form>
											 <?php
											 $i++;
									 }
									 ?>

							 </tbody>
					 </table>
			 </div>
	 </div>
	</div>
	<!-- ์ำหหะำก-->


</div>

    </div><!--Col-md-10-->
</div><!--Container-fluid-->

<script src="../js/DropdownHover.js"></script>
<script src="../js/app.js"></script>

</body>
<?php } ?>
</html>
