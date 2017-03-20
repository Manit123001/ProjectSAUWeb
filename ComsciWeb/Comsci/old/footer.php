
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
          <a href="<?php echo $section_link; ?>" class="btn btn-success flat-color animation-delay-18 animated bounceInLeft"> สมัครเลยตอนนี้ </a>

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
                <h3 class="footer-title">คณะศิลปศาสตร์และวิทยาศาสตร์</h3>
                <ul >
                    <li><p> <b> <i class="fa fa-location-arrow" aria-hidden="true"></i></b>&nbsp;&nbsp; มหาวิทยาลัยเอเชียอาคเนย์ &nbsp; <br>
                      <b> <i class="fa fa-map-marker" aria-hidden="true"></i></b>&nbsp;&nbsp; 9/1 ถนนเพชรเกษม (ติดซอยเพชรเกษม 106) <br>เขตหนองแขม กรุงเทพ, 10160</p></li>
                    <li><p><b><i class="fa fa-phone" aria-hidden="true"></i></b>&nbsp;&nbsp; <a href="javascript:void(0);">02-807-4594 </a>&nbsp;&nbsp;
                      <b> <i class="fa fa-fax" aria-hidden="true"></i></b> &nbsp;<a href="javascript:void(0);">02-807-4594 </a> </p></li>
                    <li><p><b><i class="fa fa-envelope" aria-hidden="true"></i></b>&nbsp;&nbsp;  <a title="Email Us" href="javascript:void(0);">comsci@sau.ac.th </a></p></li>
                </ul>

            </div>


            <div class="col-md-4">
                <h3 class="footer-title">รายละเอียดเว็บไซต์</h3>
                <ul class="list-unstyled three_cols">
                    <li><a href="index.php">หน้าแรก</a></li>
                    <li><a href="teacher.php">บุคลากร</a></li>
                    <li><a href="course.php">หลักสูตร</a></li>
                    <li><a href="project4.php">ผลงานนักศึกษา</a></li>
                    <li><a href="freshy.php">น้องใหม่ CS</a></li>
                    <li><a href="news_list.php">ข่าว-กิจกรรม</a></li>
                    <li><a href="gallery-cs.php">ภาพกิจกรรม</a></li>
                    <li><a href="success.php">ศิษย์เก่า</a></li>
                    <li><a href="guarantee.php">ประกันคุณภาพ</a></li>
                    <li><a href="contact.php">ติดต่อสอบถาม</a></li>
                    <li><a href="contact.php">แผนผัง</a></li>
                    <li><a href="login.php">Login</a></li>

                </ul>
                <h3 class="footer-title">Social Media</h3>

                <ul class="social-navf model-8" >
                    <!-- <li><a href="https://twitter.com/vineethtrv" class="twitter"><i class="fa fa-twitter"></i></a></li> -->
                    <li><a href="https://plus.google.com/u/2/?hl=th" class="google-plus"><i class="fa fa-google-plus"></i></a></li>
                    <li><a href="https://www.facebook.com/saucomsci/?fref=ts" class="facebook"> <i class="fa fa-facebook"></i></a></li>
                    <li><a href="https://www.instagram.com/comscisau/" class="instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                    <!-- <li><a class="linkedin"><i class="fa fa-linkedin"></i></a></li>
                    <li><a class="pinterest"><i class="fa fa-pinterest-p"></i></a></li> -->
                </ul>

            </div>
            <div class="col-md-4">
                <div class="footer-widget">
                    <h3 class="footer-title">ภาพกิจกรรม</h3>
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
    <p> &copy; 2016 by <a href="https://www.facebook.com/manit.cholpinyo"> Manit Cholpinyo </a>@ Computer Science - SAU.</p>
</footer>

<!-- on top -->
<div id="back-top" style="display: none;">
    <a href="#header"><i class="fa fa-chevron-up"></i></a>
</div>
