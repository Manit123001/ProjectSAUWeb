

<!DOCTYPE HTML>
<html lang="th">
	<head>
		<title>Test Image SQL</title>
		<meta charset="UTF-8"/>
	</head>

	<!-- <meta http-equiv='refresh' content ='10;Url=test2.php'> -->


	<meta http-equiv="Content-Language" content="th"> 
	<meta http-equiv="content-Type" content="text/html; charset=window-874"> 
	<meta http-equiv="content-Type" content="text/html; charset=tis-620"> 

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<!-- <meta http-equiv='refresh' content ='10;Url=test2.php'> -->

	<link rel="stylesheet" type="text/css" href="./css/styleShow.css">
 	<script src="js/prefixfree.min.js"></script>

    <!-- customstyle -->

	<link rel="stylesheet" type="text/css" href="./css/style2.css">

    <link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">


    <link rel="stylesheet" href="css/jquery.fancybox.css">



	<body>
  <!--  BODY PAGE CONTENT -->
  <!-- NAV -->

		<nav id="custom-nav" class="navbar navbar-default navbar-fixed-top" role='navigation'>
		    <div class="container-fluid">
		      	<div class="navbar-header">
			        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-main">
				        <span class="sr-only">Toggle Navigation</span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
				        <span class="icon-bar"></span>
			        </button>
		        <a href="#" class="navbar-brand">SAU EXPO</a>
		      	</div>
		      <!-- .navbar-header -->
			    <div class="collapse navbar-collapse" id="navbar-collapse-main">
			        <ul class="nav navbar-nav navbar-right">
				        <li><a class="page-scroll" href="#home">Home</a></li>
				        <li><a class="page-scroll" href="#about">About</a></li>

				        <li><a class="page-scroll" href="#visitors">Visitors</a></li>
				        <li><a class="page-scroll" href="#luckyDown">Lucky Down</a></li>
			        </ul>
			    </div>
	      <!-- #navbar-collapse-main -->
	    	</div>
	  	</nav>
	  	
<header id="home" >
	<div  class="container-fluid" style="	padding: 0px;">	
	    <div class ="homecontain">
		    <div class="text-vcenter">
		      	<div class="header-content">
		            <div class="header-content-inner">
		                <h1>Project Expo 2016</h1>
		                <hr>
		                <p>South East Asia University</p>
		                <a href="#about" class="btn btn-primary btn-xl page-scroll">ABOUT !</a>
		            </div>
		        </div>
		    </div>
	    </div><!-- #home -->
  	</div>
</header>
		


	<div id="about">
	    <section class="bg-primary" id="about" style="background-color: #f05f40;">
	        <div class="container">
	            <div class="row">
	                <div class="col-lg-8 col-lg-offset-2 text-center">

	                    <h1 class="section-heading"><strong>About</strong> <span>'Expo</span> </h1>
	                    <hr class="light">
	                    <p class="text-faded" style="font-size: 26px;">งานแสดงผลงานโปรเจคจบของนักศึกษาของนักศึกษา ชั้นปีที่ 4 ของ คณะศิลปศาสตร์และวิทยาศาสตร์ , คณะบริหารธุรกิจ <br>  มหาวิทยาลัยเอเชียอาคเนย์ ประจำปีการศึกษา 2558   </p>
	                    <a href="#home" class="btn btn-default btn-xl page-scroll">Get Started!</a>
	                </div>
	            </div>
	        </div>
	    </section>
	</div>



	<div id="visitors" class=" pad-section  section no-padding scroll">
	    <div class="container-fluid">
	      	<div class="row text-center no-gutter">
		      	<div class="sectionTitle" >
		      		<h1 class="text-default " style="font-size: 38px;"><strong>Visitors</strong> <span>'Expo</span></h1>
	                    <hr class="light">
		      	</div>


				<!-- Content -->
				<div class="contain-fluid " >
					<div class="row "  >

						<?php
							$path = "./pictures/";
							$con = mysql_connect("localhost","expoSAU","1234") or die(mysql_error());
							mysql_select_db("images_expo");
							$strSQL = "SELECT * FROM tbexposau order by id desc";
							$res = mysql_query($strSQL);
							
							
							while($row = mysql_fetch_array($res))
							{
								$imageShow = $row["name_image"];

								?>
									<div class="col-lg-3 col-md-4 col-sm-6 work"  >
										<div class="thumbnail" style="padding: 0px; margin: 0px;">
											<div class="zoom-effect-container" >
				  								<div class="image-card">
										
                                    				<a href="<?php echo $path.$imageShow;?>.jpg" class="work-box">

                                        				<img src="<?php echo $path.$imageShow;?>.jpg" alt="">
														<div class="overlay">
								                            <div class="overlay-caption">
								                                <h5 style="font-size: 24px; color: #00fff0;"><strong><?php echo $imageShow;?></strong></h5>
                                                				<p>Expo 2016</p>
								                            </div>
								                        </div><!-- overlay -->
													</a>
												</div>
											</div>
											
										</div>
									</div>    


								<?php 
							}
							
							mysql_close($con);
						?>

									<div class="col-lg-3 col-md-4 col-sm-6 work" >
										<div class="thumbnail" style="padding: 0px; margin: 0px;">
											<div class="zoom-effect-container" >
				  								<div class="image-card">
										
                                    				<a href="./images/work-4.jpg" class="work-box">
                                        				<img src="./images/work-4.jpg" alt="" width="100%" height="100%">
														<div class="overlay">
								                            <div class="overlay-caption">
								                                <h5 style="font-size: 24px; color: #00fff0;"><strong>Visitors </strong></h5>
                                                				<p>Expo 2016</p>
								                            </div>
								                        </div><!-- overlay -->
													</a>
												</div>

											</div>
											
										</div>
									</div>   
									<div class="col-lg-3 col-md-4 col-sm-6 work" >
										<div class="thumbnail" style="padding: 0px; margin: 0px;">
											<div class="zoom-effect-container" >
				  								<div class="image-card">
										
                                    				<a href="./images/work-1.jpg" class="work-box">
                                        				<img src="./images/work-1.jpg" alt="" width="100%" height="100%">
														<div class="overlay">
								                            <div class="overlay-caption">
								                                <h5 style="font-size: 24px; color: #00fff0;"><strong>Visitors </strong></h5>
                                                				<p>Expo 2016</p>
								                            </div>
								                        </div><!-- overlay -->
													</a>
												</div>

											</div>
											
										</div>
									</div>   
									<div class="col-lg-3 col-md-4 col-sm-6 work" >
										<div class="thumbnail" style="padding: 0px; margin: 0px;">
											<div class="zoom-effect-container" >
				  								<div class="image-card">
										
                                    				<a href="./images/work-2.jpg" class="work-box">
                                        				<img src="./images/work-2.jpg" alt="" width="100%" height="100%">
														<div class="overlay">
								                            <div class="overlay-caption">
								                                <h5 style="font-size: 24px; color: #00fff0;"><strong>Visitors </strong></h5>
                                                				<p>Expo 2016</p>
								                            </div>
								                        </div><!-- overlay -->
													</a>
												</div>

											</div>
											
										</div>
									</div>   
									<div class="col-lg-3 col-md-4 col-sm-6 work" >
										<div class="thumbnail" style="padding: 0px; margin: 0px;">
											<div class="zoom-effect-container" >
				  								<div class="image-card">
										
                                    				<a href="./images/work-3.jpg" class="work-box">
                                        				<img src="./images/work-3.jpg" alt="" width="100%" height="100%">
														<div class="overlay">
								                            <div class="overlay-caption">
								                                <h5 style="font-size: 24px; color: #00fff0;"><strong>Visitors </strong></h5>
                                                				<p>Expo 2016</p>
								                            </div>
								                        </div><!-- overlay -->
													</a>
												</div>

											</div>
											
										</div>
									</div>    
					</div>	


					<br>
					<h2> ผู้เช้าชมงาน ^_^</h2>
					<br>
					 <a href="#visitors" class="btn btn-default btn-xl page-scroll">  Click to UP !!   </a>
					 <br>

				</div> <!--End Content Image-->
	    	</div>
	  	</div> 
	</div>
<!-- End Visitors -->

	<div id="luckyDown" class="pad-section section no-padding">
		<div class="container-fluid text-center" >
		      	<div class="row sectionTitle" >
			   		<h1 class="text-default" style="font-size: 38px;"><strong>LUCKY DOWN !!</strong></h1>
			   		<p >
			   			<h3>สุ่มผู้โชคดีที่ลงทะเบียนร่วมงาน Project Expo 2016 มหาวิทยาลัยเอเชียอาคเนย์</3>
			   		</p>
				</div>

				<div class="container">
 					<hr class="light">				
 				</div>
		 	<div class="row" style="margin-bottom: 50px">
		  		<button  id="again" type="button" class="btn btn-success "> <h4>Click To Spin+++++++++++ </h4></button>
		  	</div>
		  	
			
			<div class="lib-panel">
		  	<div class="row text-center " align="center">
		  		<div class="col-sm-2 col-md-3 col-lg-4" ></div>
		  		<div class="col-sm-8 col-md-6 col-lg-4 " >
			  	<div id="lucky" >
			  		<div >
						<?php
								$path = "./pictures/";
								$scanFile = scandir($path);
								$typeImage = array('jpg','jpeg','gif','png'); 
								$sumImage = array();
							
							// foreach ($scanFile as $x ) {
							// 	$sumImage = $x;
							// }
						?>

							<ul class="random" id='slideshow'>
										<li>
											<img class="img-rounded img-responsive box-shadow" src="./images/lucky.png" alt="">	
										</li>
								<?php
									$nameFile = array();	
									foreach($scanFile as $show => $value)
									{
										 	
										$file_parts = explode('.', $value);
										$ext = array_pop($file_parts);  
										$nameFile = $value;
											
										if(in_array($ext,$typeImage))
										{  
										?>

											<li>
												<img class="img-rounded img-responsive box-shadow" src="<?php echo $path.$nameFile; ?>" alt="" >

												<div class="row block ">
													<div class="text-center">	
														<h1 ><label class="text-primary" ><?php echo  substr($nameFile, 0, -4);?></label></h1>
													</div>
												</div>
												
											</li>

										<?php
										}
									}
								?> 
							</ul> 
					</div>
				</div>
				</div>
					  		<div class="col-sm-2 col-md-3 col-lg-4" ></div>

		  	</div><!-- row SPIN -->
		  	</div>
		</div> 
	</div>
<!-- End Lucky Down -->

	<footer class="footer">
		<div class="container-fluid">


			<div class="row" style="padding:30px 0 30px 0; background-color: #333">
				<div class="copyright text-center">
					Copyright &copy; 2016, The project by <span style="color: #fff;">Manit Cholpinyo</span> @ SAU EXPO
				</div>


			</div>
		</div>
	</footer>

	<!-- JQuery -->
  	<script type="text/javascript" src="./js/jquery.js"></script>
  	<!-- Bootstrap Core JavaScript -->
	<script type="text/javascript" src="./js/bootstrap.min.js"></script>

	    <!-- Plugin JavaScript -->
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/jquery.fittext.js"></script>

    <script src="js/creative.js"></script>

	<!-- lucky down -->
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="js/index.js"></script>

	<!-- Visitors -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/jquery.fancybox.pack.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/main.js"></script>



	</body>
</html>