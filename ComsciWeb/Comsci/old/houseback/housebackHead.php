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
    <title>backTeacher</title>

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

    if(document.getElementById('subject_normal').value == ""){
        alert('ป้อนหัวเรื่อง');
        document.getElementById('subject_normal').focus();
        return false;
    }

    if(document.getElementById('project_text').value == ""){
        alert('ป้อนรายละเอียด');
        document.getElementById('project_text').focus();
        return false;
    }


     if(document.getElementById('project_link   ').value == ""){
        alert('ป้อนรายละเอียด');
        document.getElementById('project_link   ').focus();
        return false;
    }

    if(document.getElementById('teacher_img').value == ""){
        alert('เพิ่มรูป');
        document.getElementById('teacher_img').focus();
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

    <!-- News -->
    <?php
    $Act = $_GET['Act'];

    switch($Act){
      // image
      case 'UpdateHead' :

          $id = $_GET['id'];
          $head_img_tmp = $_FILES['header_logo']['tmp_name'];
          $head_img_name = $_FILES['header_logo']['name'];
          $head_img_type = $_FILES['header_logo']['type'];

          if($head_img_name!=''){
              $filePath = "../images/".$head_img_name;

              $res = Select("tbheader", "where id = '1'" );
              while ($row = mysql_fetch_array($res))
              {
                  $header_logo = $row['header_logo'];
                  if($header_logo){
                      unlink("../images/$header_logo");
                  }
              }
              move_uploaded_file($head_img_tmp, $filePath);
              $Update = Update("tbheader", "header_logo='".$head_img_name."' WHERE id = '".$id."'");

              header('Location: housebackHead.php');
              exit;
          }else{
              header('Location: housebackHead.php');
            	exit;
          }
      break;

      case 'UpdateContact':

          if(isset($_POST['sumitUpdateContact'])){
              $id = $_GET['id'];
              $header_icon_1 = $_POST['header_icon_1'];
              $header_tel = $_POST['header_tel'];
              $header_icon_2 = $_POST['header_icon_2'];
              $header_email = $_POST['header_email'];
              $Update = Update("tbheader", "
                  header_icon_1='".$header_icon_1."',
                  header_tel='".$header_tel."',
                  header_icon_2='".$header_icon_2."',
                  header_email='".$header_email."' WHERE id = '".$id."'");

              header('Location: housebackHead.php');
              exit;
          }

      break;

      case 'UpdateHeadSocial':

          if(isset($_POST['sumitUpdateHeadSocial'])){
              $id = $_GET['id'];
              $header_icon_social = $_POST['header_icon_social'];
              $header_social_link = $_POST['header_social_link'];
              $header_icon_social2 = $_POST['header_icon_social2'];
              $header_social_link2 = $_POST['header_social_link2'];
              $header_icon_social3 = $_POST['header_icon_social3'];
              $header_social_link3 = $_POST['header_social_link3'];

              $Update = Update("tbheader", "
                  header_icon_social='".$header_icon_social."',
                  header_social_link='".$header_social_link."',
                  header_icon_social2='".$header_icon_social2."',
                  header_social_link2='".$header_social_link2."',
                  header_icon_social3='".$header_icon_social3."',
                  header_social_link3='".$header_social_link3."' WHERE id = '".$id."'");
              header('Location: housebackHead.php');
              exit;
          }

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
        <h1 align="center">Header</h1>


        <!-- Logo -->
				<div class="row">
	            <div class="panel panel-default">
	                <div class="panel-heading">
	                    Logo
	                </div>

									<div class="panel-body">
											<?php
											$res = Select("tbheader", "where id = 1" );
											while ($row = mysql_fetch_array($res))
												{
													$id = $row['id'];
													$header_logo = $row['header_logo'];


													?>
													<form action="?Act=UpdateHead&id=<?=$id;?>" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
															<div class="col-md-10 ">
																	<div class="form-group">
																			<label class="col-md-2 control-label">ภาพ</label>

																			<div class="col-md-6">
																					<input type="file" name="header_logo" id="header_logo" >
																			</div>
																			<div class="col-md-4">
																					<img src="../images/<?php echo $header_logo;?>" alt="" />
																			</div>

																	</div>

																	<div class="form-group">
																			<label class="col-md-2 control-label"></label>
																			<div class="col-md-10">
																					 <button type="submit" class="btn btn-success" name="sumitCourseUpdateHead"onclick="return CheckValue();">Update_LOGO</button>
																			</div>
															 		</div>
														 </div>

												 </form>
												 <?php
											  }
											  ?>
									</div><!--End panel-body-->
							</div>
	        </div> <!--End row-->

          <!-- Contact -->
					<div class="row">
		            <div class="panel panel-default">
		                <div class="panel-heading">
		                    Logo
		                </div>

										<div class="panel-body">
												<?php
												$res = Select("tbheader", "where id = 1" );
												while ($row = mysql_fetch_array($res))
													{
														$id = $row['id'];
														$header_tel = $row['header_tel'];
														$header_email = $row['header_email'];
														$header_icon_1 = $row['header_icon_1'];
														$header_icon_2 = $row['header_icon_2'];

														?>
														<form action="?Act=UpdateContact&id=<?=$id;?>" method="post" class="form-horizontal"
																	role="form" enctype="multipart/form-data">
																<div class="col-md-10 ">
																		<div class="form-group">
																				<label class="col-md-2 control-label">Tell</label>

																				<div class="col-md-4">
																						<input type="text" name="header_icon_1" id="header_icon_1"
																						value="<?php echo $header_icon_1;?>" placeholder="Icon Tell">
																				</div>

																				<div class="col-md-6">
																					<input type="text" name="header_tel" id="header_tel"
																					value="<?php echo $header_tel;?>" placeholder="Tell">
																				</div>
																		</div>
																		<div class="form-group">
																				<label class="col-md-2 control-label">Email</label>

																				<div class="col-md-4">
																						<input type="text" name="header_icon_2" id="header_icon_2"
																						value="<?php echo $header_icon_2;?>"placeholder="Icon Email">
																				</div>

																				<div class="col-md-6">
																					<input type="text" name="header_email" id="header_email"
																					value="<?php echo $header_email;?>"placeholder="Email">
																				</div>

																		</div>
																		<div class="form-group">
																				<label class="col-md-2 control-label"></label>
																				<div class="col-md-10">
																						 <button type="submit" class="btn btn-success" name="sumitUpdateContact"
                                             onclick="return CheckValue();">Update</button>
																				</div>
																 		</div>
																</div>
													 </form>
													 <?php
												  }
												  ?>
										</div><!--End panel-body-->
								</div>
		        </div> <!--End row-->


					<div class="row">
		            <div class="panel panel-default">
		                <div class="panel-heading">
		                    Logo<?php echo $header_icon_social;?>
		                </div>

										<div class="panel-body">
												<?php
												$res = Select("tbheader", "where id = 1" );
												while ($row = mysql_fetch_array($res))
													{
														$id = $row['id'];
														$header_icon_social = $row['header_icon_social'];
														$header_social_link = $row['header_social_link'];
														$header_icon_social2 = $row['header_icon_social2'];
														$header_social_link2 = $row['header_social_link2'];
														$header_icon_social3 = $row['header_icon_social3'];
														$header_social_link3 = $row['header_social_link3'];

														?>
														<form action="?Act=UpdateHeadSocial&id=<?=$id;?>" method="post" class="form-horizontal"
																	role="form" enctype="multipart/form-data">
																<div class="col-md-10 ">

																		<div class="form-group">
																				<label class="col-md-2 control-label">Google-plus</label>

																				<div class="col-md-4">
																						<input type="text"  name="header_icon_social" id="header_icon_social"
																						value="<?php echo "$header_icon_social";?>" placeholder="Icon Tell">
																				</div>

																				<div class="col-md-6">
																					<input type="text"  name="header_social_link" id="header_social_link"
																					value="<?php echo $header_social_link;?>"placeholder="Tell">
																				</div>

																		</div>

																		<div class="form-group">
																				<label class="col-md-2 control-label">Facebook</label>

																				<div class="col-md-4">
																						<input type="text"  name="header_icon_social2" id="header_icon_social2"
																						value="<?php echo $header_icon_social2;?>"placeholder="Icon Email">
																				</div>

																				<div class="col-md-6">
																					<input type="text"  name="header_social_link2" id="header_social_link2"
																					value="<?php echo $header_social_link2;?>"placeholder="Email">
																				</div>

																		</div>

																		<div class="form-group">
																				<label class="col-md-2 control-label">Register</label>

																				<div class="col-md-4">
																						<input type="text"  name="header_icon_social3" id="header_icon_social3"
																						value="<?php echo $header_icon_social3;?>"placeholder="Icon Email">
																				</div>

																				<div class="col-md-6">
																					<input type="text"  name="header_social_link3" id="header_social_link3"
																					value="<?php echo $header_social_link3;?>"placeholder="Email">
																				</div>

																		</div>
																		<div class="form-group">
																				<label class="col-md-2 control-label"></label>
																				<div class="col-md-10">
																						 <button type="submit" class="btn btn-success" name="sumitUpdateHeadSocial"onclick="return CheckValue();">Update</button>
																				</div>
																 		</div>
																</div>
													 </form>
													 <?php
												  }
												  ?>
										</div><!--End panel-body-->
								</div>
		        </div> <!--End row-->
    </div><!--Col-md-10-->
</div><!--Container-fluid-->






<script src="../js/DropdownHover.js"></script>
<script src="../js/app.js"></script>

</body>
<?php } ?>
</html>
