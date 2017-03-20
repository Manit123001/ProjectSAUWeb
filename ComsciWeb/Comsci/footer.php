<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
  </head>
  <body>

    <aside class="container-fluid section-box">
      <div class="container ">

        <section class="section">
          <div class="action-box ">

            <?php
            $res = Select("tbsection_box", "" );
            while ($row = mysql_fetch_array($res))
            {
              $id = $row['id'];
              $section_title = $row['section_title'];
              $section_text = $row['section_text'];
              $section_link = $row['section_link'];

              ?>
              <h3><?php echo $section_title; ?></h3>
              <p><?php echo $section_text; ?></p>

              <a href="<?php echo $section_link; ?>" class="btn btn-success flat-color animation-delay-18 animated bounceInLeft">
                    <i class="fa fa-file-text" aria-hidden="true"></i> &nbsp; สมัครเลยตอนนี้ </a>
            </div>
              <?php
             }
             ?>

        </section>
      </div>
    </aside>

    <aside class="footer-aside">
        <div class="container">

            <div class="row">
                <div class="col-md-4">
                    <h3 class="footer-title">&#3588;&#3603;&#3632;&#3624;&#3636;&#3621;&#3611;&#3624;&#3634;&#3626;&#3605;&#3619;&#3660;&#3649;&#3621;&#3632;&#3623;&#3636;&#3607;&#3618;&#3634;&#3624;&#3634;&#3626;&#3605;&#3619;&#3660;</h3>
                    <ul >
                        <li><p> <b> <i class="fa fa-location-arrow" aria-hidden="true"></i></b>&nbsp;&nbsp; &#3617;&#3627;&#3634;&#3623;&#3636;&#3607;&#3618;&#3634;&#3621;&#3633;&#3618;&#3648;&#3629;&#3648;&#3594;&#3637;&#3618;&#3629;&#3634;&#3588;&#3648;&#3609;&#3618;&#3660; &nbsp; <br>
                          <b> <i class="fa fa-map-marker" aria-hidden="true"></i></b>&nbsp;&nbsp; 9/1 &#3606;&#3609;&#3609;&#3648;&#3614;&#3594;&#3619;&#3648;&#3585;&#3625;&#3617; (&#3605;&#3636;&#3604;&#3595;&#3629;&#3618;&#3648;&#3614;&#3594;&#3619;&#3648;&#3585;&#3625;&#3617; 106) <br>&#3648;&#3586;&#3605;&#3627;&#3609;&#3629;&#3591;&#3649;&#3586;&#3617; &#3585;&#3619;&#3640;&#3591;&#3648;&#3607;&#3614;, 10160</p></li>
                        <li><p><b><i class="fa fa-phone" aria-hidden="true"></i></b>&nbsp;&nbsp; <a href="javascript:void(0);">02-807-4594 </a>&nbsp;&nbsp;
                          <b> <i class="fa fa-fax" aria-hidden="true"></i></b> &nbsp;<a href="javascript:void(0);">02-807-4594 </a> </p></li>
                        <li><p><b><i class="fa fa-envelope" aria-hidden="true"></i></b>&nbsp;&nbsp;  <a title="Email Us" href="javascript:void(0);">comsci@sau.ac.th </a></p></li>
                    </ul>

                </div>


                <div class="col-md-4">
                    <h3 class="footer-title">&#3619;&#3634;&#3618;&#3621;&#3632;&#3648;&#3629;&#3637;&#3618;&#3604;&#3648;&#3623;&#3655;&#3610;&#3652;&#3595;&#3605;&#3660;</h3>
                    <ul class="list-unstyled three_cols">
                        <li><a href="index.php">&#3627;&#3609;&#3657;&#3634;&#3649;&#3619;&#3585;</a></li>
                        <li><a href="teacher.php">&#3610;&#3640;&#3588;&#3621;&#3634;&#3585;&#3619;</a></li>
                        <li><a href="course.php">&#3627;&#3621;&#3633;&#3585;&#3626;&#3641;&#3605;&#3619;</a></li>
                        <li><a href="project4.php">&#3612;&#3621;&#3591;&#3634;&#3609;&#3609;&#3633;&#3585;&#3624;&#3638;&#3585;&#3625;&#3634;</a></li>
                        <li><a href="freshy.php">&#3609;&#3657;&#3629;&#3591;&#3651;&#3627;&#3617;&#3656; CS</a></li>
                        <li><a href="news_list.php">&#3586;&#3656;&#3634;&#3623;-&#3585;&#3636;&#3592;&#3585;&#3619;&#3619;&#3617;</a></li>
                        <li><a href="gallery-cs.php">&#3616;&#3634;&#3614;&#3585;&#3636;&#3592;&#3585;&#3619;&#3619;&#3617;</a></li>
                        <li><a href="success.php">&#3624;&#3636;&#3625;&#3618;&#3660;&#3648;&#3585;&#3656;&#3634;</a></li>
                        <li><a href="guarantee.php">&#3611;&#3619;&#3632;&#3585;&#3633;&#3609;&#3588;&#3640;&#3603;&#3616;&#3634;&#3614;</a></li>
                        <li><a href="contact.php">&#3605;&#3636;&#3604;&#3605;&#3656;&#3629;&#3626;&#3629;&#3610;&#3606;&#3634;&#3617;</a></li>
                        <li><a href="sitemap.php">&#3649;&#3612;&#3609;&#3612;&#3633;&#3591;</a></li>
                        <li><a id="btnModal" href="javascript:void(0);" class="">&#3612;&#3641;&#3657;&#3592;&#3633;&#3604;&#3607;&#3635;</a></li>

                        <li><a href="login.php">Login</a></li>

                    </ul>
                    <h3 class="footer-title">Social Media</h3>
                    <div class="">
                      <ul class="social-navf model-8" >
                        <!-- <li><a href="https://twitter.com/vineethtrv" class="twitter"><i class="fa fa-twitter"></i></a></li> -->
                        <li><a href="https://plus.google.com/u/2/?hl=th" class="google-plus"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="https://www.facebook.com/saucomsci/?fref=ts" class="facebook"> <i class="fa fa-facebook"></i></a></li>
                        <li><a href="https://www.instagram.com/comscisau/" class="instagram"><i class="fa fa-instagram" ></i></a></li>
                        <!-- <li><a class="linkedin"><i class="fa fa-linkedin"></i></a></li>
                        <li><a class="pinterest"><i class="fa fa-pinterest-p"></i></a></li> -->
                      </ul>

                    </div>

                </div>
                <div class="col-md-4">
                    <div class="footer-widget">
                        <h3 class="footer-title">&#3616;&#3634;&#3614;&#3585;&#3636;&#3592;&#3585;&#3619;&#3619;&#3617;</h3>
                        <div class="row">
                          <?php
                          $res = Select("tbgallery", "order by id desc limit 4" );
                          while ($row = mysql_fetch_array($res))
                          {
                            $id = $row['id'];
                            $gallery_img = $row['gallery_img'];
                            $gallery_title = $row['gallery_title'];
                            $gallery_group = $row['gallery_group'];

                            ?>
                            <div class="col-lg-6 col-md-6 col-sm-3 col-xs-6">
                                <a class="thumbnail" href="gallery-cs-album.php?album=<?=$gallery_type;?>&group=<?=$gallery_group;?>"><img alt="Image" class="img-responsive" src="images/gallery/<?php echo $gallery_img; ?> " style="height:130px; min-height:100px; width:100%;"></a>
                            </div>

                             <?php
                           }
                           ?>

                        </div>
                    </div>
                </div>
            </div> <!-- row -->
            <hr class="style-three">

        </div> <!-- container -->
    </aside> <!-- footer-widgets -->

    <footer id="footer">
        <p> &copy; 2016 by <a href="https://www.facebook.com/manit.cholpinyo"> Manit Cholpinyo </a>CS#19 - SAU.</p>
    </footer>



    <!--  MOdel-->
    <!-- on top -->
    <div id="back-top" style="display: none;">
        <a href="#header"><i class="fa fa-chevron-up"></i></a>
    </div>
    <!--<button class="btn btn-default" type="button" data-toggle="modal" data-target="#modal-id">	Launch Modal 2
    				</button>-->

    <div class="modal fade" id="modal-id">
    				<div class="modal-dialog">
    					<div class="modal-content">
    						<div class="modal-header">
    							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    							<h4 class="modal-title">&#3612;&#3641;&#3657;&#3592;&#3633;&#3604;&#3607;&#3635;</h4>
    						</div>
    						<div class="modal-body">

    						    <center>  <img src="images/profile/profile.jpg" class="img-responsive img-thumbnail" alt="Image">	 </center>
                    <div align="center">
                        <h3>&#3609;&#3634;&#3618;&#3617;&#3634;&#3609;&#3636;&#3605; &#3593;&#3621;&#3616;&#3636;&#3597;&#3650;&#3597;</h3>
                        <p>&#3617;&#3627;&#3634;&#3623;&#3636;&#3607;&#3618;&#3634;&#3621;&#3633;&#3618;&#3648;&#3629;&#3648;&#3594;&#3637;&#3618;&#3629;&#3634;&#3588;&#3648;&#3609;&#3618;&#3660;</p>
                        <p>&#3588;&#3603;&#3632;&#3624;&#3636;&#3621;&#3611;&#3624;&#3634;&#3626;&#3605;&#3619;&#3660;&#3649;&#3621;&#3632;&#3623;&#3636;&#3607;&#3618;&#3634;&#3624;&#3634;&#3626;&#3605;&#3619;&#3660;</p>
                        <p>&#3626;&#3634;&#3586;&#3634;&#3623;&#3636;&#3607;&#3618;&#3634;&#3585;&#3634;&#3619;&#3588;&#3629;&#3617;&#3614;&#3636;&#3623;&#3648;&#3605;&#3629;&#3619;&#3660;</p>
                        facebook <a href="https://www.facebook.com/manit.cholpinyo"> Manit Cholpinyo</a>
                    </div>
      					</div>
    						<div class="modal-footer">
    							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    						</div>
    					</div>
    				</div>
    			</div>
    		<!-- Scrpit -->
    			<script type="text/javascript">
    				$('#btnModal').click(function(){
    					$('#modal-id').modal();
    				});
    			</script>

  </body>
</html>
