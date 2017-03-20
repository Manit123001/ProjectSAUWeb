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
    <title>การติดตั้ง Bootstrap 3</title>

    <link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
    <script type="text/javascript" src="./js/jquery.js"></script>
    <script type="text/javascript" src="./js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style2.css">

    <!-- custom -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/vendors.css">

    <link rel="stylesheet" href="fonts/font-awesome/font-awesome-4.6.2/css/font-awesome.min.css">


</head>
<body>
<?php
    if(!isset($_GET['NewsPage']))
        {
            header("Location: news_list.php");
            exit;
        }
    ?>

    <?php
      //header nav
        include ('header.php');
    ?>

    <header class="main-header">
        <div class="container">
            <h1 class="page-title">ข่าว-กิจกรรม</h1>
            <ol class="breadcrumb pull-right">
                <li><a href="news_list.php">หน้าข่าว</a></li>
                <li class="active">กิจกรรม</li>
            </ol>

        </div>
    </header>

    <div class="container margin-bottom " style="margin-top: 50px;">
        <div class="row">

            <div class="col-sm-9">


              <?php

              $NewsPage = $_GET['NewsPage'];
              $res = Select("tbnews", "where id = $NewsPage" );
              while ($row = mysql_fetch_array($res))
              {
                  $news_id = $row['id'];

                  $news_title = $row['news_title'];
                  $news_text = $row['news_text'];
                  $news_img = $row['news_img'];
                  $news_date = $row['news_date'];
                  $news_type = $row['news_type'];

                  ?>
                  <section >
                        <h2 class="page-header no-margin-top"><?php echo $news_title; ?></h2>

                        <img alt="Image" style="max-height:430px; width:100%;" class="img-responsive imageborder" src="images/news/<?php echo $news_img; ?>">

                        <div class="media-body caption">
                          <p class="help-block "><i class="fa fa-clock-o">
                          </i> เขียนเมื่อ : <?php echo $news_date; ?> &nbsp;
                          <i class="fa fa-folder-open"></i> ประเภท : <?php echo $news_type; ?>
                        </p>

                        </div>

                        <p><?php echo $news_text; ?></p>
                  </section>



              <?php
            }
            ?>

          </div><!-- col-sm-9 -->

            <!-- right Menu -->
            <?php
                include ('rightmenu.php');
            ?>

        </div>
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
