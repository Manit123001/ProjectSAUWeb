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
	<title>Album </title>

	<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
    <script type="text/javascript" src="./js/jquery.js"></script>
    <script type="text/javascript" src="./js/bootstrap.min.js"></script>


			<!-- Add fancyBox -->
			<script type="text/javascript" src="fancybox/lib/jquery-1.10.1.min.js"></script>
			<script type="text/javascript" src="fancybox/source/jquery.fancybox.js?v=2.1.5"></script>
			<link rel="stylesheet" type="text/css" href="fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />

			<!-- Add Thumbnail helper (this is optional) -->
			<link rel="stylesheet" type="text/css" href="fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
			<script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>


    <!-- custom -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/vendors.css">

    <link rel="stylesheet" href="fonts/font-awesome/font-awesome-4.6.2/css/font-awesome.min.css">

		<script type="text/javascript">
			$(document).ready(function() {
				/*
				 *  Simple image ga. Uses default settings
				 */

				$('.fancybox').fancybox();

				// Remove padding, set opening and closing animations, close if clicked and disable overlay
				$(".fancybox-effects-d").fancybox({
					padding: 0,

					openEffect : 'elastic',
					openSpeed  : 150,

					closeEffect : 'elastic',
					closeSpeed  : 150,

					closeClick : true,

					helpers : {
						// overlay : null
					}
				});


			$('.fancybox-thumbs').fancybox({
				padding: 8,

				prevEffect : 'none',
				nextEffect : 'none',
				openEffect : 'elastic',
				openSpeed  : 150,
				closeEffect : 'elastic',
				closeSpeed  : 150,

				// closeBtn  : false,
				// arrows    : false,
				nextClick : true,

				helpers : {
					thumbs : {
						width  : 50,
						height : 50
					}
				}
			});



			});
		</script>


</head>
<body >
    <?php
      //header nav
        include ('header.php');
    ?>

    <header class="main-header">
        <div class="container">
            <h1 class="page-title">Album</h1>

            <ol class="breadcrumb pull-right">
                <li><a href="gallery-cs.php">ประมวลภาพ</a></li>
                <li class="active">น้องน้อง </li>
            </ol>
        </div>
    </header>



    <div class="container margin-bottom">



      <?php

      $albumType = $_GET['album'];
      $group = $_GET['group'];

      $res = Select("tbdetailimg", "where detail_group = '".$group."'" );
      while ($row = mysql_fetch_array($res))
      {
        $id = $row['id'];
        $detail_title = $row['detail_title'];
        $detail_text = $row['detail_text'];
        $detail_group = $row['detail_group'];

        ?>
        <h3 class="page-title"><?php  echo $detail_title;?></h3>
  			<p>
  				<?php  echo $detail_text;?>
  			</p>

        <?php
      }
      ?>
			<hr class="style-two">


    	<div class="row masonry-container" style="position: relative; height: 1835px;">
    		<!-- headder -->
    		<div class="row">

          <?php

          $albumType = $_GET['album'];
          $group = $_GET['group'];

          $res = Select("tbgalleryalbum", "where ga_group = '".$group."'" );
          while ($row = mysql_fetch_array($res))
          {
            $id = $row['id'];
            $ga_img = $row['ga_img'];
            $ga_title = $row['ga_title'];
            $ga_text = $row['ga_text'];
            $ga_group = $row['ga_group'];
            $ga_type = $row['ga_type'];
            ?>
            <div class="col-md-3 col-sm-6 col-sm-6 team-grid masonry-item blog-item" data-bound="">
      				<div class="">
      					<a class="fancybox-thumbs" data-fancybox-group="<?php echo $group; ?>" href="images/gallery/<?php echo $group.'/'.$ga_img; ?>" title="<?php echo $ga_title; ?>">
      						<img class="img-responsive img-thumbnail" src="images/gallery/<?php echo $group.'/'.$ga_img; ?>" alt="" />
      					</a>
      				</div>
      			</div>

            <?php
          }
          ?>



    		</div><!-- /row -->

    	</div>
    </div><!-- /container -->

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
