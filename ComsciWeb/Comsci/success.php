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
    <title>Success</title>

    <link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
    <script type="text/javascript" src="./js/jquery.js"></script>
    <script type="text/javascript" src="./js/bootstrap.min.js"></script>

    <!-- custom -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/vendors.css">

    <link rel="stylesheet" href="fonts/font-awesome/font-awesome-4.6.2/css/font-awesome.min.css">



</head>
<body>
    <?php
      //header nav
        include ('header.php');
    ?>
<header class="main-header">
    <div class="container">
        <h1 class="page-title">ความสำเร็จศิษย์เก่า</h1>
    </div>
</header>


<div class="container margin-bottom">
    <div class="row">
        <div class="col-md-9">

            <!-- left -->
            <div class="col-sm-6 timeline-left">
                <?php
                $res = Select("tbsuccess", "where success_side = 'left' order by id asc" );
                while ($row = mysql_fetch_array($res))
                {
                     $id = $row['id'];

                    $success_title = $row['success_title'];
                    $success_text = $row['success_text'];
                    $success_img = $row['success_img'];
                ?>
                    <div class="timeline-event timeline-event-left animated bounceInLeft animation-delay-3">
                        <div class="panel panel-primary">
                            <div class="panel-heading" style ="background-color:#02c66c;"><strong><?php echo $success_title;?></strong> </div>
                            <img alt="Image" class="img-responsive" src="images/success/<?php echo $success_img;?>">
                            <div class="panel-body">
                                <?php echo $success_text;?>
                            </div>
                        </div>
                    </div>

                <?php
                }
                ?>
            </div>

            <!-- right -->
            <div class="col-sm-6 timeline-right">
                <?php
                $res = Select("tbsuccess", "where success_side = 'right' order by id asc" );
                while ($row = mysql_fetch_array($res))
                {
                    $id = $row['id'];

                    $success_title = $row['success_title'];
                    $success_text = $row['success_text'];
                    $success_img = $row['success_img'];
                    ?>
                        <div class="timeline-event timeline-event-right animated bounceInRight animation-delay-4">
                            <div class="panel panel-primary">
                                <div class="panel-heading" style="background-color:#02c66c;"><strong><?php echo $success_title;?></strong></div>
                                <img alt="Image" class="img-responsive" src="images/success/<?php echo $success_img;?>">
                                <div class="panel-body">
                                    <?php echo $success_text;?>

                                </div>
                            </div>
                        </div>

                    <?php
                }
                ?>
            </div>
            <div class="clearfix"></div>
        </div> <!-- col-md-9 -->

        <!-- right Menu -->
        <?php
            include ('rightmenu.php');
        ?>

    </div><!--row-->
</div>

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
