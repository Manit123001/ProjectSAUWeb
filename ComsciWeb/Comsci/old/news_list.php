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
    <title>list news</title>

    <link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
    <script type="text/javascript" src="./js/jquery.js"></script>
    <script type="text/javascript" src="./js/bootstrap.min.js"></script>

    <!-- custom -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/vendors.css">

    <link rel="stylesheet" href="fonts/font-awesome/font-awesome-4.6.2/css/font-awesome.min.css">



</head>
<body>


    <?php
      //header nav
        include ('header.php');
    ?>

    <header class="main-header">
        <div class="container">
            <h1 class="page-title">ข่าว-กิจกรรม</h1>
            <ol class="breadcrumb pull-right">
                <li><a href="#">ข่าว-กิจกรรม</a></li>
                <li class="active">ข่าวใหม่</li>
            </ol>

        </div>
    </header>

<div class="container margin-bottom" >
    <div class="row">
        <div class="col-md-9">

            <?php
                $per_page = 5;

                $pages_query = mysql_query("SELECT id FROM tbnews ");
                $numrow = mysql_num_rows($pages_query);
                $pages = ceil($numrow / $per_page );

                $page = (isset($_GET['page'])) ?(int)$_GET['page'] : 1;
                $start = ($page - 1) * $per_page;

                $res = Select("tbnews", "order by id desc limit $start, $per_page" );

                while ($row = mysql_fetch_array($res))
                {
                    $news_id = $row['id'];
                    $news_title = $row['news_title'];
                    $news_text = $row['news_text'];
                    $news_img = $row['news_img'];
                    $news_date = $row['news_date'];
                    $news_type = $row['news_type'];

                ?>
                <article class="post animated fadeIn">

                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h3 class="post-title"><a class="transicion"  href="news_cs.php?NewsPage=<?=$news_id?>"> <?php echo $news_title;?> </a></h3>
                            <div class="row">
                                <div class="col-lg-4">
                                    <a href="news_cs.php?NewsPage=<?=$news_id?>">
                                      <img style="max-height:300px; width:100%;" alt="Image" class="img-post img-responsive" alt="" src="images/news/<?php echo $news_img; ?>">
                                    </a>
                                </div>
                                <div class="col-lg-8 post-content">
                                    <p><?php echo mb_substr($news_text, 0, 200,'UTF-8'); ?>...</p>

                                </div>
                            </div>
                        </div>
                        <div class="panel-footer post-info-b">
                            <div class="row">
                                <div class=" col-md-6 col-sm-6 col-xs-9">
                                    <div class="col-md-6 no-padding" >
                                      <p class="help-block "><i class="fa fa-clock-o"></i> เขียนเมื่อ : <?php echo $news_date; ?> </p>
                                    </div>
                                    <div class="col-md-6 no-padding" >
                                      <p class="help-block "> <i class="fa fa-folder-open"></i> ประเภท : <?php echo $news_type; ?></p>
                                    </div>

                                </div>
                                <div class=" col-md-6 col-sm-6 col-xs-3" align="center" >
                                    <div class="col-md-12 read-more" >
                                        <a class="pull-right btn btn-success"  href="news_cs.php?NewsPage=<?=$news_id;?>">Read more</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </article> <!-- post -->

                <?php
                }
                ?>
                <section class="text-center">
                    <ul class="pagination pagination-lg pagination-border">

                      <?php
                      $prev = $page - 1;
                      $next = $page + 1;

                      if(!($page<=1)){
                          echo "<li><a href='news_list.php?page=$prev'>Prev</a></li>";
                      }


                      if($pages >= 1){
                          for ($x=1; $x <=$pages ; $x++) {
                            echo ($x == $page) ? '<li><a style="background-color:#2196F3; color:#fff;" href="?page='.$x.'">'.$x.'</a></li>'
                              : '<li><a  href="?page='.$x.'">'.$x.'</a></li>';
                          }
                      }
                      if(!($page>=$pages)){
                          echo "<li><a href='news_list.php?page=$next'>Next</a></li>";
                      }

                      ?>
                    </ul>
                </section>
                <?php
            ?>







        </div> <!-- col-md-8 -->

        <!-- right Menu -->
        <?php
            include ('rightmenu.php');
        ?>

    </div> <!-- row -->
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
