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
    	<title>ProjectTeacher</title>

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
            <h1 class="page-title">ผลงานอาจารย์</h1>
            <ol class="breadcrumb pull-right">
                <li><a href="#">ผลงานความภาคภูมิใจ</a></li>
                <li class="active">ผลงานอาจารย์</li>
            </ol>
        </div>
    </header>


<div class="container margin-bottom">

    <div class="row">
        <div class="col-md-9">

					<div class="row masonry-container" style="position: relative; height: 1835.3px;">
            <?php
            $res = Select("tbprojectt", "order by id asc" );
            while ($row = mysql_fetch_array($res))
            {
                $id = $row['id'];
                $pt_title = $row['pt_title'];
                $pt_text = $row['pt_text'];
                $pt_img = $row['pt_img'];
                ?>

                <div class="col-md-4 col-sm-6 masonry-item blog-item wow fadeInUp" style="visibility: visible; animation-name: fadeInUp; position: absolute; left: 0px; top: 0px;">
           				 <div class="thumbnail">
                     	<a class="fancybox-effects-a" href="images/projectTeacher/<?php echo $pt_img; ?>" title="">
                        <img alt="" src="images/projectTeacher/<?php echo $pt_img; ?>"></a>

           						 <div class="caption">
           								 <h4><?php echo $pt_title; ?></h4>
           								 <p><?php echo $pt_text; ?></p>

           						 </div>
           				 </div>
           		 </div> <!-- masonry-item  -->
                <?php
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
<script src="js/workings.js"></script>
<script src="js/app.js"></script>


</body>
</html>
