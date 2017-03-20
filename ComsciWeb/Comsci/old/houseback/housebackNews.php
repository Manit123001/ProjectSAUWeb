<?php
    error_reporting(0);
    session_start();
    include ('../module/connectDB.php');
    include ('../module/function.php');
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width = device-width, initial-scale=1">
    <title>backNews</title>

    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>

    <!-- custom -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/vendors.css">

    <link rel="stylesheet" href="../fonts/font-awesome/font-awesome-4.6.2/css/font-awesome.min.css">

</head>


<script>
    function CheckValue(){

    if(document.getElementById('news_title').value == ""){
        alert('ป้อนหัวเรื่อง');
        document.getElementById('news_title').focus();
        return false;
    }

    if(document.getElementById('news_text').value == ""){
        alert('ป้อนรายละเอียด');
        document.getElementById('news_text').focus();
        return false;
    }


     if(document.getElementById('news_date').value == ""){
        alert('ป้อนรายละเอียด');
        document.getElementById('news_date').focus();
        return false;
    }

    if(document.getElementById('news_img').value == ""){
        alert('เพิ่มรูป');
        document.getElementById('news_img').focus();
        return false;
    }
}
</script>


<?php
    if($_SESSION['login_id']==''){
        echo "<script language=\"javascript\">";
        echo "alert('กรุณาล๊อคอินเข้าสู้ระบบ');";
        echo "window.location='../login.php';";
        echo "</script>";
    } else{
?>
<body>

    <!-- News -->
    <?php
    $Act = $_GET['Act'];

    switch($Act){
        case 'AddNews' :

                    $news_title = $_POST['news_title'];
                    $news_text = $_POST['news_text'];
                    $news_type = $_POST['news_Type'];
                    $news_date = $_POST['news_date'];

                    $news_img_tmp = $_FILES['news_img']['tmp_name'];
                    $news_img_name = $_FILES['news_img']['name'];
                    $news_img_type = $_FILES['news_img']['type'];
                    $filePath = "../images/news/".$news_img_name;

                    $newsDate = date ("Y-m-d",strtotime($news_date));


                    $Check = Select("tbnews","WHERE news_title='".$news_title."'");
                    $Num_Rows = Num_Rows($Check);

                    if($Num_Rows == 0){
                        move_uploaded_file($news_img_tmp, $filePath);

                        $InsertReply = Insert("tbnews", "news_title, news_text, news_type, news_date, news_img",
                            "'".$news_title."','".$news_text."','".$news_type."','".$newsDate."','".$news_img_name."'");

                            header('Location: housebackNews.php');
                            exit;
                    }else{
                                echo "<script language=\"javascript\">";
                                echo "alert('ชื่อเรื่องนี้ : ".$news_title." มีอยู่ในระบบแล้ว');";
                                echo "window.location='housebackNews.php';";
                                echo "</script>";
                    }
        break;




        case 'UpdateNews':
              $id = $_GET['id'];
              $news_title_table = $_POST['news_title_table'];
              $news_text_table = $_POST['news_text_table'];
              $news_type_table = $_POST['news_type_table'];
              $news_date_table = $_POST['news_date_table'];
              $news_img_table = $_POST['news_img_table'];

              $news_img_tmp = $_FILES['news_img']['tmp_name'];
              $news_img_name = $_FILES['news_img']['name'];
              $news_img_type = $_FILES['news_img']['type'];

              if($news_img_name != ''){
                  $filePath = "../images/news/".$news_img_name;
                  $res = Select("tbnews", "where id = '".$id."'" );
                  while ($row = mysql_fetch_array($res))
                  {
                      $news_img = $row['news_img'];
                      if($news_img){
                          unlink("../images/news/$news_img");
                      }
                  }
                  move_uploaded_file($news_img_tmp, $filePath);

                  $Update = Update("tbnews", "
                      news_title='".$news_title_table."',
                      news_text='".$news_text_table."',
                      news_type='".$news_type_table."',
                      news_date='".$news_date_table."',
                      news_img='".$news_img_name."' WHERE id = '".$id."'");

                  header('Location: housebackNews.php');
                  exit;
              }else{
                $Update = Update("tbnews", "
                    news_title='".$news_title_table."',
                    news_text='".$news_text_table."',
                    news_type='".$news_type_table."',
                    news_date='".$news_date_table."'WHERE id = '".$id."'");

                  header('Location: housebackNews.php');
                  exit;
              }
        break;

        case 'DelNews' :
            $Img_file = $_GET['Img_file'];
            $id = $_GET['id'];
            Delete("tbnews","WHERE id = '".$id."'");

            if($Img_file){
              unlink("../images/news/$Img_file");
            }
            header('Location: housebackNews.php');
            exit;

        break;
    }
?>

    <!-- Navbar and Header -->
    <?php
        include ('header.php');
    ?>

    <!-- Content -->
    <div class="container-fluid" style="margin-top:20px;" >
        <?php
            include ('admin.php');
        ?>
        <div class="col-md-10">
            <h1 align="center">News</h1>

            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        News
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">

                            <form action="?Act=AddNews" method ="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">ชื่อเรื่อง</label>

                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="news_title" id="news_title">
                                    </div>

                                 </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">เนื้อหา</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" rows="5"  name="news_text" id="news_text"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">ประเภท</label>
                                    <div class="col-md-9">
                                        <input type="radio" name="news_Type" id="input" value="กิจกรรม" checked>
                                        กิจกรรม
                                        <input type="radio" name="news_Type" id="input" value="ข่าวสาร">
                                        ข่าวสาร

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">วันที่เขียน</label>
                                    <div class="col-md-9">
                                        <input type="date" class="form-control" name="news_date" id="news_date">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">รูปภาพ</label>
                                    <div class="col-md-9">
                                        <input type="file" class="form-control" name="news_img" id="news_img" >
                                    </div>
                                </div>




                                <div class="form-group">
                                     <label class="col-md-3 control-label"></label>
                                    <div class="col-md-9">
                                         <button type="submit" class="btn btn-success" name="sumitnews" onclick="return CheckValue();">Add</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        </div>

                        <div class="col-md-12">
                            <div class="table-responsive" style="max-height:600px;">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>ชื่อเรื่อง</th>
                                            <th>รายละเอียด</th>
                                            <th>ประเภท</th>
                                            <th>วันที่เขียน</th>
                                            <th>ภาพ</th>
                                            <th>จัดการ</th>

                                        </tr>
                                    </thead>

                                    <tbody>


                                        <?php
                                            $i = 1;
                                            $res = Select("tbnews", "order by id desc" );
                                            while ($row = mysql_fetch_array($res))
                                            {
                                                    $id = $row['id'];
                                                    $news_title = $row['news_title'];
                                                    $news_text = $row['news_text'];
                                                    $news_type = $row['news_type'];
                                                    $news_date = $row['news_date'];
                                                    $news_img = $row['news_img'];
                                                ?>
                                                <form  action="?Act=UpdateNews&id=<?=$id;?>"  method ="post" role="form" enctype="multipart/form-data" >
                                                    <tr>
                                                        <td class="hidden"><?php echo $id; ?></td>
                                                        <td> <?php echo $i; ?></td>
                                                        <td><input type="text" name="news_title_table" value="<?php echo $news_title; ?>"></td>
                                                        <td ><textarea  class="form-control" rows="5" name="news_text_table"  value=""><?php echo $news_text; ?></textarea></td>

                                                        <td><input type="text" name="news_type_table"  value="<?php echo $news_type; ?>"></td>

                                                        <td><input type="date" name="news_date_table" value="<?php echo $news_date; ?>"></td>

                                                        <td class="hidden"><input type="text" name="news_img_table" value="<?php echo $news_img; ?>"></td>

                                                        <td class="two">
                                                            <div class="col-md-12 no-padding " align="center">
                                                                <input type="file" name="news_img">
                                                            </div><!-- /col-md-6 -->
                                                            <div class="col-md-12 " align="center">

                                                                <img style="max-width: 100px; max-height: 100px;"
                                                                src="<?php echo "../images/news/".$news_img; ?>"
                                                                class="img-responsive">
                                                            </div><!-- /col-md-6 -->

                                                        </td>

                                                        <td>
                                                            <a href="JavaScript:if(confirm('Confirm Delete?')==true){window.location='?Act=DelNews&id=<?= $id;?>&Img_file=<?= $news_img;?>';}" class="btn btn-danger" name="btnDelete">D</a>

                                                            <button type="submit" class="btn btn-primary" name="sumitNewsUpdate" >U</button>
                                                        </td>
                                                    </tr>
                                                </form>
                                                <?php
                                                $i++;
                                            }
                                        ?>

                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>






    <script src="../js/DropdownHover.js"></script>
    <script src="../js/app.js"></script>

</body>
<?php } ?>

</html>
