<?php
    error_reporting(0);
    session_start();
    include ('module/connectDB.php');
    include ('module/function.php');
?>

<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
	<meta name="description" content="สาขาวิทยาการคอมพิวเตอร์ มหาวิทยาลัยเอเชียอาคเนย์ มุ่งเน้นนักศึกษามีคความรุ้คู่คุณธรรมด้านคอมพิวเตอร์และไอที">
	<meta name="keywords" content="วิทยาการคอมพิวเตอร์, สาขาวิทยาการคอมพิวเตอร์, คอมพิวเตอร์, ไอที, มหาวิทยาลัยเอเชียอาคเนย์, computer science	">

	<meta name="viewport" content="width = device-width, initial-scale=1">
	<title>Freshy</title>

	<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
    <script type="text/javascript" src="./js/jquery.js"></script>
    <script type="text/javascript" src="./js/bootstrap.min.js"></script>

    <!-- custom -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/vendors.css">

    <link rel="stylesheet" href="fonts/font-awesome/font-awesome-4.6.2/css/font-awesome.min.css">



</head>
<body >
    <?php
      //header nav
        include ('header.php');
    ?>

    <header class="main-header">
        <div class="container">
            <h1 class="page-title">น้องใหม่ ComSci</h1>

        </div>
    </header>

    <div class="container margin-bottom" style="margin-top: 20px;">
        <div class="row">
            <div class=" col-md-12 " >
              <div class="row">
                <div class="col-md-12">
                    <!-- <h3 class="no-margin-top">น้องใหม่ ComSci</h3> -->
                    <!-- <hr class="style-two"> -->

                    <div class="panel-group" id="myCollapse	">
                       
                           <?php
                           $res = Select("tbfreshy", "" );
                           while ($row = mysql_fetch_array($res))
                           {
                               $id = $row['id'];
                               $freshy_title = $row['freshy_title'];
                               $freshy_text = $row['freshy_text'];
                               ?>
                               <div class="panel panel-info panel-freshy">
                                 <div class="panel-heading panel-heading-link">
                                     <a href="#coll-<?php echo $id; ?>" data-parent="#accordion" data-toggle="collapse">
                                         <i class="fa fa-android" aria-hidden="true"></i><?php echo $freshy_title; ?>
                                     </a>
                                 </div>
                         				<div id="coll-<?php echo $id; ?>" class="panel-collapse collapse fade">
                         					<div class="panel-body">
                         						<p>
                         							  <?php echo $freshy_text; ?>
                                    </p>
                         					</div>
                         				</div>
                         			</div>
                               <?php
                           }
                           ?>

                    		</div>
                   </div>
              </div>
            </div><!--end text col-md-9 -->


            <!-- right Menu -->
            <?php
                // include ('rightmenu.php');
            ?>

        </div><!--END ROW-->
    </div><!---END CONTAINER -->

    <?php
      //footer
        include ('footer.php');
    ?>

    <script src="js/DropdownHover.js"></script>
    <script src="js/vandors.js"></script>
    <!-- <script src="js/workings.js"></script> -->
    <script src="js/app.js"></script>
</body>

</html>
