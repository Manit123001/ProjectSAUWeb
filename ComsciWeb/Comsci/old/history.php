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
	<title>Course</title>

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
            <h1 class="page-title">แนะนำสาขา</h1>

            <ol class="breadcrumb pull-right">
                <li><a href="#">แนะนำสาขา</a></li>
                <li class="active">ประวัติความเป็นมา</li>
            </ol>
        </div>
    </header>

    <div class="container margin-bottom" >
        <div class="row">
            <div class=" col-md-9  " >
                <?php
                $res = Select("tbhistory", "where id = '1' " );
                while ($row = mysql_fetch_array($res))
                {
                    $id = $row['id'];
                    $history_title = $row['history_title'];
                    $history_text = $row['history_text'];
                    ?>

                    <div class="panel panel-default panel-body-style">
                        <div class="panel-body ">
                            <h2><?php echo $history_title;?> </h2>
														<hr class="style-two">
                            <p>
                             <?php
                             echo $history_text;
                             ?>
                             </p>
                        </div>
                    </div>
                    <?php
                }
                ?>

            </div><!--end text col-md-9 -->


            <!-- right Menu -->
            <?php
            include ('rightmenu.php');
            ?>

        </div><!--END ROW-->
    </div><!---END CONTAINER -->

    <?php
      //footer
    include ('footer.php');
    ?>


		<script src="js/DropdownHover.js"></script>
		<script src="js/app.js"></script>

		</body>
</body>

</html>
