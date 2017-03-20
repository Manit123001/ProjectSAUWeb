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
    <title>backProjectTeacher</title>

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
        case 'AddProjectTeacher' :

                    $pt_title = $_POST['pt_title'];
                    $pt_text = $_POST['pt_text'];

                    $pt_img_tmp = $_FILES['pt_img']['tmp_name'];
                    $pt_img_name = $_FILES['pt_img']['name'];
                    $pt_img_type = $_FILES['pt_img']['type'];

                    $filePath = "../images/projectTeacher/".$pt_img_name;

                    $Check = Select("tbprojectt","WHERE pt_title='".$pt_title."'");
                    $Num_Rows = Num_Rows($Check);

                    if($Num_Rows == 0){
                        move_uploaded_file($pt_img_tmp, $filePath);

                        $InsertReply = Insert("tbprojectt", "pt_title, pt_text, pt_img",
                            "'".$pt_title."','".$pt_text."','".$pt_img_name."'");

                            header('Location: housebackProjectTeacher.php');
                            exit;
                    }else{
                                echo "<script language=\"javascript\">";
                                echo "alert('ชื่อเรื่องนี้ : ".$pt_title." มีอยู่ในระบบแล้ว');";
                                echo "window.location='housebackProjectTeacher.php';";
                                echo "</script>";
                    }
        break;




        case 'UpdateProjectTeacher':
              $id = $_GET['id'];
              $pt_title = $_POST['pt_title'];
              $pt_text = $_POST['pt_text'];

              $pt_img_tmp = $_FILES['pt_img']['tmp_name'];
              $pt_img_name = $_FILES['pt_img']['name'];
              $pt_img_type = $_FILES['pt_img']['type'];

              if($pt_img_name != ''){
                  $filePath = "../images/projectTeacher/".$pt_img_name;
                  $res = Select("tbprojectt", "where id = '".$id."'" );
                  while ($row = mysql_fetch_array($res))
                  {
                      $pt_img = $row['pt_img'];
                      if($pt_img){
                          unlink("../images/projectTeacher/$pt_img");
                      }
                  }
                  move_uploaded_file($pt_img_tmp, $filePath);

                  $Update = Update("tbprojectt", "
                      pt_title='".$pt_title."',
                      pt_text='".$pt_text."',
                      pt_img='".$pt_img_name."' WHERE id = '".$id."'");

                  header('Location: housebackProjectTeacher.php');
                  exit;
              }else{
                $Update = Update("tbprojectt", "
                pt_title='".$pt_title."',
                pt_text='".$pt_text."' WHERE id = '".$id."'");

                  header('Location: housebackProjectTeacher.php');
                  exit;
              }
        break;

        case 'DelProjectTeacher' :
            $Img_file = $_GET['Img_file'];
            $id = $_GET['id'];
            Delete("tbprojectt","WHERE id = '".$id."'");

            if($Img_file){
              unlink("../images/projectTeacher/$Img_file");
            }
            header('Location: housebackProjectTeacher.php');
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
            <h1 align="center">ผลงานอาจารย์</h1>

            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        ProjectTeacher
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">

                            <form action="?Act=AddProjectTeacher" method ="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">ชื่อเรื่อง</label>

                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="pt_title" id="pt_title">
                                    </div>

                                 </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">เนื้อหา</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" rows="5"  name="pt_text" id="pt_text"></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">รูปภาพ</label>
                                    <div class="col-md-9">
                                        <input type="file" class="form-control" name="pt_img" id="pt_img" >
                                    </div>
                                </div>


                                <div class="form-group">
                                     <label class="col-md-3 control-label"></label>
                                    <div class="col-md-9">
                                         <button type="submit" class="btn btn-success" name="sumitProjectTeacher" onclick="return CheckValue();">Add</button>
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

                                            <th>ภาพ</th>
                                            <th>จัดการ</th>

                                        </tr>
                                    </thead>

                                    <tbody>


                                        <?php
                                            $i = 1;
                                            $res = Select("tbprojectt", "order by id desc" );
                                            while ($row = mysql_fetch_array($res))
                                            {
                                                    $id = $row['id'];
                                                    $pt_title = $row['pt_title'];
                                                    $pt_text = $row['pt_text'];
                                                    $pt_img = $row['pt_img'];
                                                ?>
                                                <form  action="?Act=UpdateProjectTeacher&id=<?=$id;?>"  method ="post" role="form" enctype="multipart/form-data" >
                                                    <tr>
                                                        <td class="hidden"><?php echo $id; ?></td>
                                                        <td> <?php echo $i; ?></td>
                                                        <td><input type="text" name="pt_title" value="<?php echo $pt_title; ?>"></td>
                                                        <td ><textarea style="min-width: 200px;" class="form-control" rows="5" cols="10" name="pt_text"  value=""><?php echo $pt_text; ?></textarea></td>

                                                        <td class="two">
                                                            <div class="col-md-12 no-padding " align="center">
                                                                <input type="file" name="pt_img">
                                                            </div><!-- /col-md-6 -->
                                                            <div class="col-md-12 " align="center">

                                                                <img style="max-width: 100px; max-height: 100px;"
                                                                src="<?php echo "../images/projectTeacher/".$pt_img; ?>"
                                                                class="img-responsive">
                                                            </div><!-- /col-md-6 -->

                                                        </td>

                                                        <td>
                                                            <a href="JavaScript:if(confirm('Confirm Delete?')==true){window.location='?Act=DelProjectTeacher&id=<?= $id;?>&Img_file=<?=$pt_img;?>';}" class="btn btn-danger" name="btnDelete">D</a>

                                                            <button type="submit" class="btn btn-primary" name="sumitProjectTeacher" >U</button>
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
