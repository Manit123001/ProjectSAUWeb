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
	<title>Course</title>

	<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
    <script type="text/javascript" src="./js/jquery.js"></script>
    <script type="text/javascript" src="./js/bootstrap.min.js"></script>

    <!-- custom -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/vendors.css">

    <link rel="stylesheet" href="fonts/font-awesome/font-awesome-4.6.2/css/font-awesome.min.css">
<style>

ul, li {
  margin: 0;
  padding: 0;
}

.sitemap > li > ul {
  margin-top: 1.5rem;
}

ul {
  list-style: none;
}
ul li {
  line-height: 1.5rem;
  vertical-align: top;
  position: relative;
}
ul li a {
  text-decoration: none;
  color: #f80;
  display: inline-block;
}
ul ul {
  margin-left: 1.5rem;
  margin-bottom: 1.5rem;
}
ul ul li {
  position: relative;
}
ul ul li::before {
  content: "";
  display: inline-block;
  width: 3rem;
  height: 100%;
  border-left: 1px #ccc solid;
  position: absolute;
  top: -0.75rem;
}
ul ul li::before {
  content: "";
  display: inline-block;
  width: 3rem;
  height: 1.5rem;
  border-bottom: 1px #ccc solid;
  position: absolute;
  top: -0.75rem;
}
ul ul li a {
  margin-left: 3.75rem;
}

</style>


</head>
<body >
    <?php
      //header nav
    include ('header.php');
    ?>

    <header class="main-header">
        <div class="container">
            <h1 class="page-title">แนะนำสาขา</h1>

            <ol class="breadcrumb pull-right">
                <li><a href="#">แนะนำสาขา</a></li>
                <li class="active">ประวัติความเป็นมา</li>
            </ol>
        </div>
    </header>

    <div class="container margin-bottom" >
        <div class="row">
<ul class="sitemap">
  <li><a href="index.php">Home</a></li>

  <li><a href="javascript:void(0);">แนะนำสาขา</a>
    <ul>
      <li><a href="history.php">ประวัติความเป็นมา</a></li>
      <li><a href="teacher.php">บุคลากร</a></li>
      <li><a href="goal.php">จุดมุ่งหมาย </a></li>
      <li><a href="guarantee.php">ประกันคุณภาพ</a></li>
    </ul>
  </li>
  <li><a href="javascript:void(0);">หลักสูตร</a>
    <ul>
      <li><a href="course.php">ปริญญาตรีภาคปกติ</a></li>
    </ul>
  </li>
  <li><a href="javascript:void(0);">ผลงานความภาคภูมิใจ</a>
    <ul>
      <li><a href="project4.php">ผลงานนักศึกษา</a></li>
      <li><a href="projectteacher.php">ผลงานอาจารย์</a></li>
    </ul>
  </li>

  <li><a href="freshy.php">น้องใหม่ CS</a></li>

  <li><a href="javascript:void(0);">ข่าว-กิจกรรม</a>
    <ul>
      <li><a href="news_cs.php">ข่าวใหม่</a></li>
      <li><a href="gallery-cs.php">ภาพกิจกรรม</a></li>
    </ul>
  </li>

    <li><a href="success.php">ศิษย์เก่า </a></li>
    <li><a href="contact.php">ติดต่อสอบถาม</a></li>


      
</ul>


        </div><!--END ROW-->
    </div><!---END CONTAINER -->

    <?php
      //footer
    include ('footer.php');
    ?>


		<script src="js/DropdownHover.js"></script>
		<script src="js/app.js"></script>

		</body>
</body>

</html>
