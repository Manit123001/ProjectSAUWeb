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
	<title>Computer Science</title>

  <script type="text/javascript" src="./js/jquery.js"></script>
  <script type="text/javascript" src="./js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">

  <!-- Add fancyBox -->
	<script type="text/javascript" src="fancybox/lib/jquery-1.10.1.min.js"></script>
	<script type="text/javascript" src="fancybox/source/jquery.fancybox.js?v=2.1.5"></script>
	<link rel="stylesheet" type="text/css" href="fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />

  <!-- custom -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/vendors.css">
  <link rel="stylesheet" href="fonts/font-awesome/font-awesome-4.6.2/css/font-awesome.min.css">

  <script type="text/javascript">
    // Change title type, overlay closing speed
    $(".fancybox-effects-a").fancybox({
      helpers: {
        title : {
          type : 'outside'
        },
        overlay : {
          speedOut : 0
        }
      }
    });
  </script>
</head>
<body>
    <?php
      //header nav
        include ('header.php');
    ?>
    <header class="main-header">
        <div class="container">
            <h1 class="page-title">ผลงานนักศึกษา</h1>
            <ol class="breadcrumb pull-right">
                <li><a href="#">ผลงานความภาคภูมิใจ</a></li>
                <li class="active">ผลงานนักศึกษา</li>
            </ol>
        </div>
    </header>


<div class="container margin-bottom">

    <div class="row">
        <div class="col-md-9">

            <!-- type -->
            <div class="portfolio-topbar ">
                <div class="row">
                    <div class="col-md-12">
                        <h4>ประเภทโปรเจค</h4>
                        <ul class="portfolio-topbar-cats">
                            <?php
                            $res = Select("tbproject4_type", "where project_type_name != '' " );
                            while ($row = mysql_fetch_array($res))
                            {
                                $news_id = $row['id'];
                                $project_type_name = $row['project_type_name'];
                                ?>
                                <li>
                                    <a href="project4.php?type=<?=$project_type_name;?>">
                                        <span data-filter=".<?php echo $project_type_name;?>" class="filter"> <?php echo $project_type_name;?></span>
                                    </a>
                                </li>
                                <?php
                                ?>
                                <?php
                            }
                            ?>

                        </ul>
                        <span class="topbar-border">&nbsp;</span>
                    </div>

                </div>
            </div>

            <!-- body -->
            <div class="row masonry-container" style="position: relative; height: 1835px;">
               <?php

                $type = $_GET['type'];
                if($type == '' ||  $type =='All'){

                    $type = $_GET['type'];
                    $res = Select("tbproject4", "where id > 1 order by id desc" );
                    while ($row = mysql_fetch_array($res))
                    {
                        $id = $row['id'];

                        $project_title = $row['project_title'];
                        $project_text = $row['project_text'];
                        $project_img = $row['project_img'];
                        $project_link = $row['project_link'];
                        $project_type = $row['project_type'];
                        ?>
                        <div class=" col-md-4 col-sm-6 col-xs-12 masonry-item blog-item <?php echo $project_type ?>"
                            style="display: inline-block; " data-bound="">

                            <div class="thumbnail">
                                <a class="fancybox-effects-a" href="images/project/<?php echo $project_img; ?>" title="">
                                  <img alt="Image" class="img-responsive" src="images/project/<?php echo $project_img ?>">
                                </a>
                                <div class="portfolio-item-caption ">
                                    <h4><?php echo $project_title ?></h4>
                                    <p><?php echo $project_text ?></p>

                                </div>

                                <!-- <hr class="style-two"> -->
                                <!-- <div align="center" >

                                    <a role="button" class="btn btn-ar btn-success  edit-customer" href="javascript:void(0);"
                                        data-id="<?php echo $id;?>"
                                        data-title ="<?php echo $project_title;?>"
                                        data-name="<?php echo $project_text;?>" >รายละเอียด </a>
                                </div> -->
                              <div class="clearfix"></div>
                            </div>
                        </div>
                        <?php
                    }

                }
                else {
                    $res = Select("tbproject4", "where id > 1 && project_type = '".$type."' order by id desc" );

                    while ($row = mysql_fetch_array($res))
                    {
                        $news_id = $row['id'];

                        $project_title = $row['project_title'];
                        $project_text = $row['project_text'];
                        $project_img = $row['project_img'];
                        $project_link = $row['project_link'];
                        $project_type = $row['project_type'];
                        ?>

                        <div class=" col-md-4 col-sm-6 col-xs-12 masonry-item blog-item <?php echo $project_type ?>" style="display: inline-block; " data-bound="">
                            <div class="thumbnail">
                              <a class="fancybox-effects-a" href="images/project/<?php echo $project_img; ?>" title="">
                                <img alt="Image" class="img-responsive" src="images/project/<?php echo $project_img ?>">
                              </a>

                                <div class="portfolio-item-caption ">
                                    <h4><?php echo $project_title; ?></h4>
                                    <p><?php echo $project_text; ?></p>
                                </div>

                                <!-- <hr class="style-two"> -->
                                <!-- <div align="center" >

                                    <a role="button" class="btn btn-ar btn-success  edit-customer" href="javascript:void(0);"
                                        data-id="<?php echo $id;?>"
                                        data-title ="<?php echo $project_title;?>"
                                        data-name="<?php echo $project_text;?>" >รายละเอียด </a>
                                </div> -->
                                <div class="clearfix"></div>

                            </div>
                        </div>
                        <?php
                    }
                }

                ?>
            </div> <!-- masonry-container  -->


        </div> <!-- col-md-9 -->

        <div class="modal fade" id="formEditCustomer">
          <div class="modal-dialog">
            <form action="save.php" method="post">
              <div class="modal-content">

                <div class="modal-header">
                  <h4>Form Data</h4>
                  <button type="button" class="close" data-dismiss="modal" >
                    <span aria-hidden="true">&times;</span>
                  </button>

                </button>
              </div>

              <div class="modal-body">
                <input type="hidden" name="id" id="id" value="">

                <div class="form-group">
                  <label for="f1">name</label>
                  <input type="text" name="f1" id="f1">
                </div><!-- /form-group -->

                <div class="form-group">
                  <label for="f2">name</label>
                  <textarea name="f2" id="f2" rows="8" cols="40"></textarea>
                </div><!-- /form-group -->

              </div><!-- /modal-body -->

              <div class="modal-footer">
                <input type="submit"  class="btn btn-success" value="save">
              </div><!-- /modal-footer -->
            </div>
          </form>
        </div>
      </div>




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
