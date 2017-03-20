
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">

  </head>
  <link rel="stylesheet" href="fonts/font-awesome/font-awesome-4.6.2/css/font-awesome.min.css">

  <body>

    <div class="col-md-2" style="padding:0px 15px 0px 0px; ">
        <div class="left-menu">

        <!-- <ul class="sidebar-nav animated fadeIn"> -->
        <ul class="sidebar-nav">
            <li class="active">

                <a class="collapsed" href="#coll-btn" data-toggle="collapse"><i class="fa fa-hand-o-up"></i> Manage</a>
                <ul class="menu-submenu list-unstyled collapse in" id="coll-btn">
                  
                    <li ><a  href="member.php"> Profile </a></li>
                    <?php
                    $res = Select("tbcontact", "where message_read !=''" );
                    $resid = Select("tbcontact", "" );
                    $numrow = mysql_num_rows($res);
                    $numId = mysql_num_rows($resid);
                    $notRead = ( $numId-$numrow);
                    ?>
                    <li ><a  href="housebackContact.php"> ติดต่อสอบถาม <span class="badge pull-right"><?php echo $notRead;?></span> </a></li>
                    <?php
                    ?>
                  </ul>
            </li>



            <li  class="active">
                <a class="collapsed" href="#news" data-toggle="collapse"><i class="fa fa-css3"></i>All Page</a>
                <ul class="menu-submenu list-unstyled collapse in" id="news">

                    <li >
                        <a class="collapsed" href="#coll-css" data-toggle="collapse"><i class="fa fa-css3"></i>หน้าแรก
                          <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i></a></li>

                        <ul class="menu-submenu tab2 list-unstyled collapse in" id="coll-css">
                            <li><a href="housebackSlideHeader.php"><i class="fa fa-header"></i> SlideHeader</a></li>
                            <li><a href="housebackAbout.php"><i class="fa fa-arrows-h"></i> About</a></li>
                            <li><a href="housebackAdmission.php"><i class="fa fa-quote-right"></i> Admission</a></li>
                            <li><a href="housebackPromote.php"><i class="fa fa-check-square-o"></i> Promote</a>
                            <li><a href="housebackFaculty.php"><i class="fa fa-check-square-o"></i> Faculty</a>
                        </ul>
                    </li>
                    <li>
                        <a class="collapsed" href="#major" data-toggle="collapse"><i class="fa fa-css3"></i>แนะนำสาขา <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i></a>
                        <ul class="menu-submenu tab2 list-unstyled collapse in" id="major">
                            <li><a href="housebackHistory.php"><i class="fa fa-header"></i> ประวัติสาขา</a></li>
                            <li><a href="housebackTeacher.php"><i class="fa fa-header"></i> อาจารย์</a></li>
                            <li><a href="housebackGoal.php"><i class="fa fa-header"></i> จุดมุ่งหมาย</a></li>
                            <li><a href="#"><i class="fa fa-header"></i> แผนผังเว็บ</a></li>
                        </ul>
                    </li>
                    <li>
                        <a class="collapsed" href="#Proudly" data-toggle="collapse"><i class="fa fa-css3"></i>ผลงามภาคภูมิใจ <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i></a>
                        <ul class="menu-submenu tab2 list-unstyled collapse in" id="Proudly">
                            <li><a href="housebackProject.php"><i class="fa fa-header"></i> ผลงานนักศึกษา</a></li>
                            <li><a href="housebackProjectTeacher.php"><i class="fa fa-header"></i> ผลงานอาจารย์</a></li>

                        </ul>
                    </li>
                    <li>
                        <a class="collapsed" href="#activity" data-toggle="collapse"><i class="fa fa-css3"></i>ข่าว-กิจกรรม <i class="fa fa-chevron-down pull-right" aria-hidden="true"></i></a>
                        <ul class="menu-submenu tab2 list-unstyled collapse in" id="activity">
                            <li><a href="housebackNews.php"><i class="fa fa-header"></i> ข่าว-กิจกรรม</a></li>
                            <li><a href="housebackGallery.php"><i class="fa fa-header"></i> ประมวลภาพกิจกรรม</a></li>

                        </ul>
                    </li>
                    <li><a href="housebackCourse.php"><i class="fa fa-table"></i>หลักสูตร </a></li>
                    <li><a href="housebackFreshy.php"><i class="fa fa-table"></i>น้องใหม่ CS </a></li>
                    <li><a href="housebackSuccess.php"><i class="fa fa-table"></i>ศิษย์เก่า </a></li>
                    <li><a href="housebackGuarantee.php"><i class="fa fa-table"></i>ประกันคุณภาพ </a></li>

                </ul>
            </li>

            <li class="active">
                <a class="collapsed" href="#coll-icons" data-toggle="collapse"><i class="fa fa-briefcase"></i> Header and Footer</a>
                <ul class="menu-submenu list-unstyled collapse in" id="coll-icons">
                    <li><a href="housebackHead.php"><i class="fa fa-font"></i>Header</a></li>
                    <li><a href="housebackFooter.php"><i class="fa fa-arrow-circle-right"></i> Footer</a></li>
                    <li><a href="housebackRightMenu.php"><i class="fa fa-arrow-circle-right"></i> Right Menu</a></li>
                </ul>
            </li>

            <!-- <li><a class="collapsed" href="housebackNews.php"><i class="fa fa-tasks"></i>News</a></li> -->


        </ul>
        </div>
    </div>

  </body>
</html>
