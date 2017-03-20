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
	<title>วิทยาการคอมพิวเตอร์ มหาวิทยาลัยเอเชียอาคเนย์</title>

	<!-- Add fancyBox -->
	<script type="text/javascript" src="fancybox/lib/jquery-1.10.1.min.js"></script>
	<script type="text/javascript" src="fancybox/source/jquery.fancybox.js?v=2.1.5"></script>
	<link rel="stylesheet" type="text/css" href="fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />

	<!-- bootstrap -->
	<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">


	<!-- owl -->
	<link rel="stylesheet" type="text/css" href="js\owlcarousel\owl.carousel.css">
	<link rel="stylesheet" type="text/css" href="js\owlcarousel\owl.dots.css">
	<!-- custom -->
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/vendors.css">
	<link rel="stylesheet" href="fonts/font-awesome/font-awesome-4.6.2/css/font-awesome.min.css">

	<script type="text/javascript">
		$(document).ready(function() {
			/*
			 *  Simple image gallery. Uses default settings
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


		});
	</script>
</head>


<body>

	<?php
		include('header.php');
	?>
		<!-- slides carousel -->
		<section class="carousel-section">
			<div data-interval="5000" data-ride="carousel" class="carousel carousel-razon slide" id="carousel-example-generic">

					<!-- dot .  . . -->
					<ol class="carousel-indicators">
						<?php

						$res = Select("tbslideheader", "" );
						$i = 0;
						$active = "active";
						while ($row = mysql_fetch_array($res))
						{
							?>
							<li data-slide-to="<?php  echo $i; ?>" data-target="#carousel-example-generic" class="<?php echo $active?>" ></li>
							<?php
							$i++;
							$active ="";
						}
						?>
					</ol>

					<!-- image -->
					<div class="carousel-inner">
							<?php
							$res = Select("tbslideheader", "" );
							$active = "active";

							while ($row = mysql_fetch_array($res))
							{
								$slideheader_title = $row['slideheader_title'];
								$slideheader_text = $row['slideheader_text'];
								$slideheader_img = $row['slideheader_img'];
								?>
								<div class="item <?php echo $active?>">
									<div class="container-fluid">
										<div class="row">
											<div class="item">
												<img src="images/home/slide/<?php echo $slideheader_img ?>" alt="" style="max-height: 575px; width: 100%">

												<div class="banner_caption">
													<div class="container">
														<div class="row">
															<div class="item">
																<div class="caption_inner animated fadeInUp animation-delay-2">
																	<h1 class="animated fadeInLeft"> <?php echo $slideheader_title; ?> </h1>
																	<p> <?php echo $slideheader_text; ?> </p>
																</div>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								<?php
								$active = "";
							}
							?>
					</div>

					<!-- left right -->
					<a data-slide="prev" href="#carousel-example-generic" class="left carousel-control">
							<span class="glyphicon glyphicon-chevron-left"></span>
					</a>
					<a data-slide="next" href="#carousel-example-generic" class="right carousel-control">
							<span class="glyphicon glyphicon-chevron-right"></span>
					</a>
			</div>
		</section> <!-- carousel -->

		<!-- About -->
		<section class="margin-bottom">
			<div class="container">
				<div class="about_inner clearfix">
					<div class="row">
						<?php
						$res = Select("tbabout", "" );
						while ($row = mysql_fetch_array($res))
						{
							$about_title = $row['about_title'];
							$about_text = $row['about_text'];
							$about_img = $row['about_img'];
							$about_ani = $row['animation'];
							?>
							<div class="col-xs-6 col-sm-6 col-md-3">
								<div class="aboutImage animated fadeInUp <?php echo $about_ani ; ?>">
									<a href="javascript:void(0);">
										<img class="img-responsive " alt="" src="images/home/about/<?php echo $about_img; ?>" >
										<div class="overlay">
											<p><?php echo $about_text;?></p>
										</div>
										<span class="captionLink"><?php echo $about_title; ?></span>
									</a>
								</div><!-- aboutImage -->
							</div>
							<?php
						}
						?>
					</div><!-- row -->
				</div><!-- about_inner -->
			</div><!-- container -->
		</section>

		<!-- Admission-->
		<section class="section-lines">
			<div class="container">
				<div class="row" style="">
					<div class="col-md-5">
						<div class="home-devices">
								<?php
									$res = Select("tbadmission", "where id = 1" );
									while ($row = mysql_fetch_array($res))
									{
											$admis_title = $row['admis_title'];
											$admis_text = $row['admis_text'];
											$admis_webRegis = $row['admis_webRegis'];
									?>
									<h2><i class="fa fa-hand-o-right " aria-hidden="true"></i> <?php echo $admis_title; ?></h2>
									<p><?php echo $admis_text; ?></p>
									<a href="<?php echo $admis_webRegis; ?>" class="btn btn-admis animated fadeInRight animation-delay-10">
          							<i class="fa fa-file-text" aria-hidden="true"></i> &nbsp; สมัครเลยตอนนี้ </a>

									<?php
									}
								?>

								<ul class="icon-devices">
									<li class="active"><a data-toggle="tab" href="#slideAdmis"><i class="fa fa-graduation-cap" aria-hidden="true"></i></a></li>
									<li><a data-toggle="tab" href="#viedo"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
									<!-- <li><a data-toggle="tab" href="#fun"><i class="fa fa-sign-language" aria-hidden="true"></i></a></li> -->
								</ul>

						</div>
					</div>

					<div class="col-md-7">
						<div class="tab-content" style="padding: 3% 0">

							<!-- 1 -->
							<div id="slideAdmis" class="tab-pane active imgtab" >
								<div id="carousel-example-captions" class="carousel carousel-images slide" data-ride="carousel">
									<ol class="carousel-indicators">

											<?php

													$res = Select("tbadmission", "where id >1" );
													$i = 0;
													$active = "active";
													while ($row = mysql_fetch_array($res))
													{
													?>
															<li data-slide-to="<?php  echo $i; ?>" data-target="#carousel-example-captions" class="<?php echo $active?>" ></li>
													<?php
															$i++;
															$active ="";
													}
											?>
									</ol>


									<div class="carousel-inner">
										<?php
										$active ="active";
										$res = Select("tbadmission", "where id >1 ");
										while ($row = mysql_fetch_array($res))
										{
											$admis_title = $row['admis_title'];
											$admis_text = $row['admis_text'];
											$admis_img = $row['admis_img'];
											?>
											<div class="item <?php echo $active;?>">
												<img src="images/home/slide/<?php echo $admis_img;?>" alt="First slide image" />
												<div class="carousel-caption animated fadeInUpBig">
													<h3><?php echo $admis_title; ?></h3>
													<p><?php echo $admis_text; ?></p>
												</div>
											</div>

											<?php
											$active ="";
										}
										?>
									</div>

									<a class="left carousel-control" href="#carousel-example-captions" data-slide="prev">
									<span class="glyphicon glyphicon-chevron-left"></span>
									</a>
									<a class="right carousel-control" href="#carousel-example-captions" data-slide="next">
									<span class="glyphicon glyphicon-chevron-right"></span>
									</a>
								</div><!-- end slide -->
							</div>

							 <!-- 2 -->
							<div id="viedo" class="tab-pane ">
								<div id="carousel-viedo-captions" class="carousel carousel-images slide" data-ride="carousel" data-interval="false">
									<div class="carousel-inner">
										<?php
										$active ="active";
										$res = Select("tbadmission2", "" );
										while ($row = mysql_fetch_array($res))
										{
											$admis_viedo = $row['admis_viedo'];
											?>
											<div class="item <?php echo $active; ?>">
												<div class="embed-responsive embed-responsive-16by9">
													<iframe  src="<?php echo $admis_viedo; ?>" frameborder="0" allowfullscreen></iframe>
												</div>
											</div>

											<?php
											$active ="";
										}
										?>
									</div>

									<a class="left carousel-control" href="#carousel-viedo-captions" data-slide="prev">
									<span class="glyphicon glyphicon-chevron-left"></span>
									</a>
									<a class="right carousel-control" href="#carousel-viedo-captions" data-slide="next">
									<span class="glyphicon glyphicon-chevron-right"></span>
									</a>
								</div><!-- end slide -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- ffancybox  -->
		<section class="margin-bottom">
			<div class="container">
				<hr class="style-two">
				<h3 style="margin-bottom:30px;">Freshy วิทย์คอม 2559</h3>

				<div class="owl-carousel" style="padding:0px;">
          <?php
          $res = Select("tbpromote", "" );
          while ($row = mysql_fetch_array($res))
          {
            $fancy_img = $row['fancy_img'];
            ?>
            <div class="item" >
  						<a class="fancybox-effects-d" rel="group" href="images/home/promote/<?php echo $fancy_img; ?>">
                <img class="img-thumbnail" src="images/home/promote/<?php echo $fancy_img; ?>" alt="" />
              </a>
  					</div>


            <?php
            $active ="";
          }
          ?>
				</div><!-- /row -->
				<div class="owl-dots" style="">
					<div class="owl-dot"><span></span></div>
					<div class="owl-dot"><span></span></div>
					<div class="owl-dot active"><span></span></div>
				</div>
			</div>
		</section>

		<!-- Faculty -->
		<section class="margin-bottom">
			<div class="container">
				<?php
				$res = Select("tbfaculty", "where id = 1 " );
				while ($row = mysql_fetch_array($res))
				{
					$fac_id = $row['id'];
					$fac_headtitle = $row['fac_headtitle'];
					$fac_title = $row['fac_title'];
					$fac_text = $row['fac_text'];
					$fac_title1 = $row['fac_title1'];
					$fac_detail_title1 = $row['fac_detail_title1'];
					$fac_title2 = $row['fac_title2'];
					$fac_detail_title2 = $row['fac_detail_title2'];
					$fac_title3 = $row['fac_title3'];
					$fac_detail_title3 = $row['fac_detail_title3'];
					$fac_link = $row['fac_link'];

				}
				?>
				<hr class="style-two">

				<p class="lead lead-lg text-center primary-color margin-bottom"><?php echo $fac_headtitle; ?></p>
				<div class="row">
					<div class="col-md-6">
						<h3 class="no-margin-top"><?php echo $fac_title; ?></h3>
						<p> <?php echo $fac_text; ?></p>

					</div>

					<div class="col-md-6">

						<div aria-multiselectable="true" role="tablist" id="accordion" class="panel-group">


							<div class="panel panel-info">
								<div class="panel-heading panel-heading-link">
									<a href="#collapseOne" data-parent="#accordion" data-toggle="collapse">
										<i class="fa fa-android" aria-hidden="true"></i><?php echo $fac_title1; ?>
									</a>
								</div>
								<div class="panel-collapse collapse in" id="collapseOne">
									<div class="panel-body">
										<p><?php echo $fac_detail_title1; ?></p>
									</div>
								</div>
							</div>

							<div class="panel panel-info">
								<div class="panel-heading panel-heading-link">
									<a class="collapsed" href="#collapseTwo" data-parent="#accordion" data-toggle="collapse">
										<i class="fa fa-windows" aria-hidden="true"></i><?php echo $fac_title2; ?>
									</a>
								</div>
								<div class="panel-collapse collapse" id="collapseTwo">
									<div class="panel-body">
										<p><?php echo $fac_detail_title2; ?></p>
										<a href="<?php echo $fac_link ; ?>" class="btn btn-warning"> กองทุน</a>
									</div>
								</div>
							</div>


							<div class="panel panel-info">
								<div class="panel-heading panel-heading-link">
									<a class="collapsed" href="#collapseThree" data-parent="#accordion" data-toggle="collapse">
										<i class="fa fa-apple" aria-hidden="true"></i><?php echo $fac_title3; ?>
									</a>
								</div>
								<div class="panel-collapse collapse" id="collapseThree">
									<div class="panel-body">
										<p><?php echo $fac_detail_title3; ?></p>

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		 <!-- News -->
		<section class="margin-bottom" >
				<div class="container" style="background-color: #fff; padding: 0px;" >
					<div  class="home-page ">
						<section class="news" style="background-color: #fff;">
							<h1 class="section-heading text-highlight" style="margin: 0px;"><span class="line"><a href="news_list.php">ข่าวและกิจกรรม</a></span></h1>
							<hr class="style-two">
							<div class="carousel-controls">
									<a data-slide="prev" href="#news-carousel" class="prev"><i class="fa fa-caret-left"></i></a>
									<a data-slide="next" href="#news-carousel" class="next"><i class="fa fa-caret-right"></i></a>
							</div><!--//carousel-controls-->

  							<div class="section-content clearfix" style="padding: 0px;">
  								<div class="carousel slide" id="news-carousel">
  									<div class="carousel-inner" >
  										<div class="item active">
  											<?php
  											$res = Select("tbnews", "order by id desc limit 3" );
  											while ($row = mysql_fetch_array($res))
  											{
  												$news_id = $row['id'];
  												$news_title = $row['news_title'];
  												$news_text = $row['news_text'];
  												$news_img = $row['news_img'];
  												$news_date = $row['news_date'];

  												?>
  												<div class="col-md-4">
  													<div class="thumbnail newslist" style="margin: 0 0 10px 0px;">
  														<a href="news_cs.php?NewsPage=<?= $news_id?>" class="pull-left">
  															<img alt="100x100" src="images/news/<?php echo $news_img; ?>" style="width: 100%;" data-holder-rendered="true">
  														</a>
  														<div class="media-body caption">
  															<h3 class="" style="margin-bottom: 0px;"><?php echo $news_title; ?></h3>
  															<p class="help-block "> เขียนเมื่อ <?php echo $news_date; ?></p>
  															<hr class="style-two">

  															<p > <?php  echo mb_substr($news_text, 0, 150,'UTF-8');  ?>...<a href="news_cs.php?NewsPage=<?= $news_id?>">อ่านต่อ</a></p>

  														</div>
  													</div>

  												</div>
  												<?php
  											}
  											?>
  										</div><!--//item-->

  										<div class="item">
  											<?php
  											$res = Select("tbnews", "order by id desc limit 3,3" );
  											while ($row = mysql_fetch_array($res))
  											{
  												$news_id = $row['id'];
  												$news_title = $row['news_title'];
  												$news_text = $row['news_text'];
  												$news_img = $row['news_img'];
  												$news_date = $row['news_date'];

  												?>
  												<div class="col-md-4">

  													<div class="thumbnail newslist" style="margin: 0 0 10px 0px;">
  														<a href="news_cs.php?NewsPage=<?= $news_id?>" class="pull-left">
  															<img alt="100x100" src="images/news/<?php echo $news_img;?>" style="width: 100%; " data-holder-rendered="true">
  														</a>
  														<div class="media-body caption">
  															<h3 class="" style="margin-bottom: 0px;"><?php echo $news_title; ?></h3>
  															<p class="help-block "> เขียนเมื่อ <?php echo $news_date; ?></p>
  															<hr class="style-two">

  															<p > <?php  echo mb_substr($news_text, 0, 100,'UTF-8');  ?>...<a href="news_cs.php?NewsPage=<?= $news_id?>">อ่านต่อ</a></p>

  														</div>
  													</div>

  												</div>
  												<?php
  											}
  											?>
  										</div><!--//item-->



  									</div><!--carousel-inner-->
  								</div><!--news-carousel-->
  							</div><!--section-content-->
  						</section><!--news-->

					</div>
				</div>
		</section>


	<!-- footer -->
	<?php
		include('footer.php');
	?>


	<!-- JQUERY -->
	<!-- <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script> -->
	<!-- <script type="text/javascript" src="./js/jquery.js"></script> -->

	<!-- bootstrap -->
	<script type="text/javascript" src="./js/bootstrap.min.js"></script>

	<!-- owl -->
	<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
	<script src="js/owlcarousel/owl.carousel.min.js"></script>

	<!-- custom -->
	<script src="js/DropdownHover.js"></script>
	<!-- <script src="js/vandors.js"></script>
	<script src="js/workings.js"></script> -->
	<script src="js/app.js"></script>

</body>
</html>
