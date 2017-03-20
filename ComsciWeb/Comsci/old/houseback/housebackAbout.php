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
    <title>Admission</title>

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

        if(document.getElementById('about_title').value == ""){
            alert('ป้อนหัวเรื่อง');
            document.getElementById('about_title').focus();
            return false;
        }

        if(document.getElementById('about_text').value == ""){
            alert('ป้อนรายละเอียด');
            document.getElementById('about_text').focus();
            return false;
        }

        if(document.getElementById('about_img').value == ""){
            alert('เพิ่มรูป');
            document.getElementById('about_img').focus();
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

        <!-- About -->
        <?php

        $Act = $_GET['Act'];
        switch($Act){
            case 'AddAbout' :
                $about_title = $_POST['about_title'];
                $about_text = $_POST['about_text'];
                $animation = $_POST['aboutAni'];

                $about_img_tmp = $_FILES['about_img']['tmp_name'];
                $about_img_name = $_FILES['about_img']['name'];
                $about_img_type = $_FILES['about_img']['type'];

                $filePath = "../images/home/about/".$about_img_name;

                $Check = Select("tbabout","WHERE about_title='".$about_title."'");
                $Num_Rows=Num_Rows($Check);

                if($Num_Rows == 0){
                    move_uploaded_file($about_img_tmp, $filePath);

                    $InsertReply = Insert("tbabout", "about_title, about_text, about_img, animation",
                        "'".$about_title."','".$about_text."','".$about_img_name."','".$animation."'");

                    header('Location: housebackAbout.php');
                    exit;
                }else{
                    echo "<script language=\"javascript\">";
                    echo "alert('ชื่อเรื่องนี้ : ".$about_title." มีอยู่ในระบบแล้ว');";
                    echo "window.location='housebackAbout.php';";
                    echo "</script>";
                }

            break;

            case 'DelAbout' :
                $Img_file = $_GET['Img_file'];
                $id = $_GET['id'];
                Delete("tbabout","WHERE id = '".$id."'");

                if($Img_file){
                    unlink("../images/home/about/$Img_file");

                    header('Location: housebackAbout.php');
                    exit;
                }

            break;

            case 'UpdateAbout':
                  $id = $_GET['id'];
                  $about_title_table = $_POST['about_title_table'];
                  $about_text_table = $_POST['about_text_table'];
                  $about_img_table = $_POST['about_img_table'];
                  $animation = $_POST['animation'];

                  $about_img_tmp = $_FILES['about_img']['tmp_name'];
                  $about_img_name = $_FILES['about_img']['name'];
                  $about_img_type = $_FILES['about_img']['type'];

                  if($about_img_name != ''){
                      $filePath = "../images/home/about/".$about_img_name;
                      $res = Select("tbabout", "where id = '".$id."'" );

                      while ($row = mysql_fetch_array($res))
                      {
                          $about_img = $row['about_img'];
                          if($about_img){
                              unlink("../images/home/about/$about_img");
                          }
                      }
                      move_uploaded_file($about_img_tmp, $filePath);
                      $Update = Update("tbabout", "
                          about_title='".$about_title_table."',
                          about_text='".$about_text_table."',
                          animation='".$animation."',
                          about_img='".$about_img_name."' WHERE id = '".$id."'");

                      header('Location: housebackAbout.php');
                      exit;
                  }else{
                      $Update = Update("tbabout", "
                          about_title='".$about_title_table."',
                          animation='".$animation."',
                          about_text='".$about_text_table."' WHERE id = '".$id."'");

                      header('Location: housebackAbout.php');
                      exit;
                  }
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
                <h1 align="center">About</h1>
                <div class="row">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            About
                        </div>
                        <div class="panel-body">
                            <form action="?Act=AddAbout" method ="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">ชื่อเรื่อง</label>

                                        <div class="col-md-9">
                                            <input type="text"  name="about_title" id="about_title">
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">รายละเอียด</label>
                                        <div class="col-md-9">
                                            <input type="text"  name="about_text" id="about_text">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">รูปภาพ</label>
                                        <div class="col-md-9">
                                            <input type="file"  name="about_img" id="about_img" >
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">อนิเมชั่น</label>
                                        <div class="col-md-9">
                                            <input type="radio" name="aboutAni" id="input" value="animation-delay-10" checked>
                                            animation 1
                                            <input type="radio" name="aboutAni" id="input" value="animation-delay-12">
                                            animation 2  <br>
                                            <input type="radio" name="aboutAni" id="input" value="animation-delay-14" >
                                            animation 3
                                            <input type="radio" name="aboutAni" id="input" value="animation-delay-16" >
                                            animation 4
                                        </div>
                                    </div>


                                    <div class="form-group">
                                       <label class="col-md-3 control-label"></label>
                                       <div class="col-md-9">
                                           <button type="submit" class="btn btn-success" name="sumitabout" onclick="return CheckValue();">Add</button>
                                       </div>
                                   </div>
                               </div>
                           </form>
                       </div>

                       <div class="row">
                        <div class="container">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>ชื่อเรื่อง</th>
                                            <th>รายละเอียด</th>
                                            <th>อนิเมชั่น</th>
                                            <th>ภาพ</th>
                                            <th>จัดการ</th>

                                        </tr>
                                    </thead>

                                    <tbody>


                                        <?php
                                        $res = Select("tbabout", "" );
                                        $i = 1;
                                        while ($row = mysql_fetch_array($res))
                                        {
                                            $id = $row['id'];
                                            $about_title = $row['about_title'];
                                            $about_text = $row['about_text'];
                                            $about_img = $row['about_img'];
                                            $animation = $row['animation'];
                                            ?>
                                            <form action="?Act=UpdateAbout&id=<?= $id;?>" method="post" role="form" enctype="multipart/form-data">
                                                <tr>
                                                    <td class="hidden"><?php echo $id; ?></td>
                                                    <td><?php echo $i; ?></td>
                                                    <td><input type="text" name="about_title_table" value="<?php echo $about_title; ?>"></td>
                                                    <td>

                                                      <textarea name="about_text_table" rows="8" cols="40"><?php echo $about_text; ?></textarea>
                                                    </td>
                                                    <td><input type="text" name="animation" value="<?php echo $animation; ?>"></td>
                                                    <td class="hidden"><input type="text" name="about_img_table" value="<?php echo $about_img; ?>"></td>

                                                    <td class="two">
                                                        <div class="col-md-12 no-padding " align="center">
                                                            <input type="file" name="about_img">
                                                        </div><!-- /col-md-6 -->
                                                        <div class="col-md-12 " align="center">

                                                            <img style="max-width: 100px; max-height: 100px;"
                                                            src="<?php echo "../images/home/about/".$about_img; ?>"
                                                            class="img-responsive">
                                                        </div><!-- /col-md-6 -->
                                                    </td>

                                                    <td>
                                                        <a href="JavaScript:if(confirm('Confirm Delete?')==true){window.location='?Act=DelAbout&id=<?=$id;?>&Img_file=<?= $about_img;?>';}" class="btn btn-danger" name="btnDelete">D</a>

                                                        <button type="submit" class="btn btn-primary" name="sumitSlideHeaderUpdate" >U</button>
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
