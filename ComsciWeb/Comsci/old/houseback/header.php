
<div class="container-fluid header-fluid" >
   <!-- 00E676 -->
    <header class="header container" style="padding: 0; ">
        <div class="header-main container" >
            <div class="logo col-md-4 col-sm-4 animated bounceInDown  ">
              <?php
              $res = Select("tbheader", "where id = '1' " );
              while ($row = mysql_fetch_array($res))
              {
                  $id = $row['id'];
                  $header_logo = $row['header_logo'];

                  ?>
                  <a href="../index.php" ><img alt="Logo" src="../images/<?php echo $header_logo; ?>" id="logo" style="max-width: 100%; "></a>

                 <?php
              }
              ?>
            </div><!--//logo-->

            <!-- social -->
            <div class="info col-md-8 col-sm-8">
                <nav class="top-nav hidden-xs  ">
                    <ul class="top-nav-social hidden-sm">

                        <?php
                        $res = Select("tbheader", "where id = '1' " );
                        while ($row = mysql_fetch_array($res))
                        {
                            $id = $row['id'];
                            $header_social_link = $row['header_social_link'];
                            $header_icon_social = $row['header_icon_social'];

                            ?>
                            <li>
                                <a class="animated fadeIn animation-delay-6 google-plus" href="<?php echo $header_social_link; ?>">
                                <i class="fa fa-google" aria-hidden="true"></i></a>
                            </li>

                           <?php
                        }
                        ?>
                        <?php
                        $res = Select("tbheader", "where id = '1' " );
                        while ($row = mysql_fetch_array($res))
                        {
                            $id = $row['id'];
                            $header_social_link2 = $row['header_social_link2'];
                            $header_icon_social2 = $row['header_icon_social2'];

                            ?>
                            <li>
                                <a class="animated fadeIn animation-delay-8 facebook" href="<?php echo $header_social_link2; ?>">
                                <i class="fa fa-facebook" aria-hidden="true"></i></a>
                            </li>

                           <?php
                        }
                        ?>

                        <?php
                        $res = Select("tbheader", "where id = '1' " );
                        while ($row = mysql_fetch_array($res))
                        {
                            $id = $row['id'];
                            $header_social_link3 = $row['header_social_link3'];
                            $header_icon_social3 = $row['header_icon_social3'];

                            ?>
                            <li><a class="animated fadeIn animation-delay-9 instagram" href="<?php echo $header_social_link3; ?>">
                              <i class="fa fa-instagram" aria-hidden="true"></i></a></li>

                           <?php
                        }
                        ?>
                    </ul>
                </nav>

                <!-- contact -->
                <div class="contact pull-right ">

                    <?php
                    $res = Select("tbheader", "where id = '1' " );
                    while ($row = mysql_fetch_array($res))
                    {
                        $id = $row['id'];
                        $header_tel = $row['header_tel'];

                        ?>
                            <p class="phone"><i class="fa fa-phone"></i> <strong>T</strong> :
                              <?php echo $header_tel ?></p>

                       <?php
                    }
                    ?>
                    <?php
                    $res = Select("tbheader", "where id = '1' " );
                    while ($row = mysql_fetch_array($res))
                    {
                        $id = $row['id'];
                        $header_email = $row['header_email'];

                        ?>
                            <p class="email"><i class="fa fa-envelope"></i><strong>Mail</strong> :
                              <?php echo $header_email ?> </p>
                       <?php
                    }
                    ?>
                </div><!--//contact-->
            </div><!--//info-->
        </div><!--//header-main-->
    </header><!--//header-->
</div><!-- /container-fluid -->

<nav id="header" role="navigation" class="navbar navbar-default navbar-header-full navbar-dark yamm navbar-static-top" style="padding: 0px; margin: 0px;">
    <div class="container" >
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button data-target="#bs-example-navbar-collapse-1" data-toggle="collapse" class="navbar-toggle" type="button">
                <span class="sr-only">Toggle navigation</span>
                <i class="fa fa-bars"></i>

            </button>
            <a  href="index.php" class="navbar-brand hidden-lg hidden-md hidden-sm" id="ar-brand" style="color: #fff;">Menu </a>
        </div> <!-- navbar-header -->



        <div id="bs-example-navbar-collapse-1" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">

              <li class="dropdown">
                  <a href="../index.php" aria-expanded="false">หน้าแรก</a>
              </li>

                <li class="dropdown">
                    <a class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown" href="javascript:void(0);" aria-expanded="false">แนะนำสาขา <span class="caret " ></span></a>
                    <ul class="dropdown-menu dropdown-menu-left animated-2x animated fadeIn">
                        <li><a href="../history.php">ประวิติความเป็นมา</a></li>
                        <li><a href="../teacher.php">บุคลากร</a></li>
                        <li><a href="../goal.php">จุดมุ่งหมาย ปณิธาน พันธกิจ</a></li>
                        <li><a href="../guarantee.php" aria-expanded="false">ประกันคุณภาพ</a></li>

                    </ul>
                </li>

                <li class="dropdown">
                    <a class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown" href="javascript:void(0);" aria-expanded="false">หลักสูตร <span class="caret " ></span></a>
                    <ul class="dropdown-menu dropdown-menu-left animated-2x animated fadeIn">
                        <li> <a href="../course.php" aria-expanded="false">ปริญญาตรีภาคปกติ</a></li>

                    </ul>
                </li>


                <li class="dropdown">
                    <a class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown" href="javascript:void(0);" aria-expanded="false">ผลงานความภาคภูมิใจ <span class="caret " ></span></a>
                    <ul class="dropdown-menu dropdown-menu-left animated-2x animated fadeIn">
                      <li> <a href="../project4.php" aria-expanded="false">ผลงานนักศึกษา</a></li>
                      <li> <a href="../projectteacher.php" aria-expanded="false">ผลงานอาจารย์</a></li>

                    </ul>
                </li>
                <li class="dropdown">
                    <a href="../freshy.php" aria-expanded="false">น้องใหม่ CS</a>
                </li>


                <li class="dropdown">
                    <a class="dropdown-toggle" data-hover="dropdown" data-toggle="dropdown" href="javascript:void(0);" aria-expanded="false">ข่าว-กิจกรรม <span class="caret " ></span></a>
                    <ul class="dropdown-menu dropdown-menu-left animated-2x animated fadeIn">
                      <li> <a href="../news_list.php" aria-expanded="false">ข่าวใหม่</a></li>
                      <li> <a href="../gallery-cs.php" aria-expanded="false">ประมวลภาพ</a></li>

                    </ul>
                </li>

                <li class="dropdown">
                    <a href="../success.php" aria-expanded="false">ศิษย์เก่า</a>
                </li>

                <li class="dropdown">
                    <a href="../contact.php" aria-expanded="false">ติดต่อสอบถาม</a>
                </li>
            </ul>
        </div><!-- navbar-collapse -->
    </div><!-- container -->
</nav>
