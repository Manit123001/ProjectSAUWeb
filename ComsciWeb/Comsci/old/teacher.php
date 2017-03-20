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
	<title>Teacher</title>

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
            <h1 class="page-title">บุคลากร</h1>

            <ol class="breadcrumb pull-right">
                <li><a href="#">แนะนำสาขา</a></li>
                <li class="active">บุคลากร</li>
            </ol>
        </div>
    </header>

    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="row" style="padding:0 10px;">
                    <?php
                    $res = Select("tbteacher", "limit 1" );
                    while ($row = mysql_fetch_array($res))
                    {
                        $id = $row['id'];

                        $teacher_name = $row['teacher_name'];
                        $teacher_position = $row['teacher_position'];
                        $teacher_text = $row['teacher_text'];
                        $teacher_email = $row['teacher_email'];
                        $teacher_img = $row['teacher_img'];
                        $teacher_facebook = $row['teacher_facebook'];
                        $teacher_google = $row['teacher_google'];
                        $teacher_email = $row['teacher_email'];

                        ?>

                        <div class="col-md-12 well team-grid"  >

                            <div class="col-md-5 team-imghead" style="padding:15px;">
                                <img style="width:100%; max-height:;" src="images/teacher/<?php echo $teacher_img;?>"  class="img-responsive " alt=""/>
                            </div><!-- /col-md-5 -->

                            <div class="col-md-7 teacher-head" >

                                <h3><?php echo $teacher_name;?></h3>
                                <h4><?php echo $teacher_position;?></h4>

                                <?php echo $teacher_text;?>

                                <br>
                                <p><strong>email:</strong> <?php echo $teacher_email;?></p>
                                <br>

                                <div class="social-t" >
                                    <ul class="sicial-teather " >
                                      <?php
                                      if($teacher_facebook != ''){
                                        ?>
                                        <li><a class="facebook" href="<?php echo $teacher_facebook;?>"><i class="fa fa-facebook"></i></a></li>
                                        <?php
                                    }

                                    if($teacher_google != ''){
                                        ?>
                                        <li><a class="google-plus" href="<?php echo $teacher_google;?>"><i class="fa fa-google"></i></a></li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </div><!-- /pull-center -->

                        </div><!-- /col-md-7 -->
                    </div><!-- /col-md-12 -->

                    <?php
                }
                ?>
            </div><!-- /row -->

            <div class="row masonry-container" style="position: relative; height: 1835px;">
                <!-- headder -->

                <?php

                $res = Select("tbteacher", "where id > 1" );
                while ($row = mysql_fetch_array($res))
                {
                    $id = $row['id'];

                    $teacher_name = $row['teacher_name'];
                    $teacher_position = $row['teacher_position'];
                    $teacher_text = $row['teacher_text'];
                    $teacher_email = $row['teacher_email'];
                    $teacher_img = $row['teacher_img'];
                    $teacher_facebook = $row['teacher_facebook'];
                    $teacher_google = $row['teacher_google'];
                    $teacher_email = $row['teacher_email'];

                    ?>

                    <div class="col-md-4 col-sm-6 col-sm-6 team-grid text-center masonry-item blog-item" style="display: inline-block; " data-bound="">
                        <div class="team-img well"  >
                            <div class="col-md-12">
                                <img style="width: 100%; " src="images/teacher/<?php echo $teacher_img;?>"class="img-responsive img-circle" alt=""/>
                            </div><!-- /col-md-12 -->
                            <div class="col-md-12 teacher-text portfolio-item-caption">
                                <!--ชื่อ-->
                                    <h3><?php echo $teacher_name;?><h3>
                                    <!--ตำแหน่ง-->
                                    <h4><?php echo $teacher_position;?></h4>

                                    <!--รยาละเอียด-->
                                    <p><?php echo $teacher_text;?></p>
                                    <p><strong>email:</strong> <?php echo $teacher_email;?></p>

                                    <ul class="sicial-teather ">
                                        <?php
                                        if($teacher_facebook != ''){
                                            ?>
                                            <li><a class="facebook" href="<?php echo $teacher_facebook;?>"><i class="fa fa-facebook"></i></a></li>
                                            <?php
                                        }

                                        if($teacher_google != ''){
                                            ?>
                                            <li><a class="google-plus" href="<?php echo $teacher_google;?>"><i class="fa fa-google"></i></a></li>
                                            <?php
                                        }
                                        ?>



                                    </ul>
                                </div><!-- /col-md-12 -->
                                <div class="clearfix"></div>
                            </div>

                        </div>

                        <?php
                    }
                    ?>
                </div>
            </div> <!-- col-md-9 -->

            <!-- right Menu -->
            <?php
            include ('rightmenu.php');
            ?>

        </div>
    </div>
    <?php
      //header nav
    include ('footer.php');
    ?>

		<script src="js/DropdownHover.js"></script>
		<script src="js/vandors.js"></script>
		<!-- <script src="js/workings.js"></script> -->
		<script src="js/app.js"></script>

</body>
</html>
