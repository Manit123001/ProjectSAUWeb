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
	<title>Gallery CS</title>

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
            <h1 class="page-title">ภาพกิจกรรม</h1>

            <ol class="breadcrumb pull-right">
                <li><a href="#">ประมวลภาพ</a></li>
                <li class="active"></li>
            </ol>
        </div>
    </header>

    <div class="container " style="margin-top: 20px;">

			<div class="page-wrapper">
						 <div class="page-content">
							 		<!-- <div class="page-row">
											 <p>Lorem iNulla iaculis, nisl eget venenatis ultricies, eros augue semper turpis, vitae euismod leo urna vitae nulla. Mauris sem urna, aliquet quis sodales et, convallis vel ante. Sed convallis id sem sed feugiat. Aenean eget tempus tortor.</p>

								  </div> -->

                  <div class="row page-row">

                   <div class="row masonry-container" style="position: relative; height: 1835px;">
                 		<!-- headder -->

                      <?php
                      $res = Select("tbgallery", "order by id desc" );
                      while ($row = mysql_fetch_array($res))
                      {
                        $id = $row['id'];
                        $gallery_img = $row['gallery_img'];
                        $gallery_title = $row['gallery_title'];
                        $gallery_text = $row['gallery_text'];
                        $gallery_group = $row['gallery_group'];
                        ?>
                         <div class="col-md-4 col-sm-6 col-sm-6 team-grid masonry-item blog-item" data-bound="">
                   				<div class="text-center">

                            <div class="thumbnail album-cover " style="padding:0px;">
                              <a href="gallery-cs-album.php?group=<?=$gallery_group;?>">
                                <img alt="" src="images/gallery/<?php echo $gallery_img; ?>" class="img-responsive">
                              </a>
                              <div class="desc">
                                <h4><a href="gallery-cs-album.php?album=<?=$gallery_type;?>&group=<?=$gallery_group;?>"><?php echo $gallery_title; ?></a></h4>
                                <p><?php echo $gallery_text ?></p>
                              </div>
                            </div>

                   				</div>
                   			</div>

                         <?php
                       }
                       ?>


                 	</div>


								 </div><!--//page-row-->

						 </div><!--//page-content-->
				 </div><!--//page-->
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
