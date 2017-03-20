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

    if(document.getElementById('slideheader_title').value == ""){
        alert('ป้อนหัวเรื่อง');
        document.getElementById('slideheader_title').focus();
        return false;
    }
    if(document.getElementById('slideheader_text').value == ""){
        alert('ป้อนรายละเอียด');
        document.getElementById('slideheader_text').focus();
        return false;
    }
    if(document.getElementById('slideheader_img').value == ""){
        alert('เพิ่มรูป');
        document.getElementById('slideheader_img').focus();
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

<!-- slider Header -->
 <?php
    $Act = $_GET['Act'];

    switch($Act){
        case 'Add' :
                    $slideheader_title = $_POST['slideheader_title'];
                    $slideheader_text = $_POST['slideheader_text'];

                    $slideheader_img_tmp = $_FILES['slideheader_img']['tmp_name'];
                    $slideheader_img_name = $_FILES['slideheader_img']['name'];
                    $slideheader_img_type = $_FILES['slideheader_img']['type'];
                    $filePath = "../images/home/slide/".$slideheader_img_name;

                    $Check = Select("tbslideheader","WHERE slideheader_title='".$slideheader_title."'");
                    $Num_Rows = Num_Rows($Check);

                    if($Num_Rows == 0){
                        move_uploaded_file($slideheader_img_tmp, $filePath);

                        $InsertReply = Insert("tbslideheader", "slideheader_title, slideheader_text, slideheader_img",
                            "'".$slideheader_title."','".trim($slideheader_text)."','".$slideheader_img_name."'");

                            header('Location: housebackSlideHeader.php');
                            exit;
                    }else{
                                echo "<script language=\"javascript\">";
                                echo "alert('ชื่อเรื่องนี้ : ".$slideheader_title." มีอยู่ในระบบแล้ว');";
                                echo "window.location='housebackSlideHeader.php';";
                                echo "</script>";
                    }

        break;


        case 'Update':
              $id = $_GET['id'];
              $slideheader_title_table = $_POST['slideheader_title_table'];
              $slideheader_text_table = $_POST['slideheader_text_table'];
              $slideheader_img_table = $_POST['slideheader_img_table'];

              $slideheader_img_tmp = $_FILES['slideheader_img']['tmp_name'];
              $slideheader_img_name = $_FILES['slideheader_img']['name'];
              $slideheader_img_type = $_FILES['slideheader_img']['type'];

              if($slideheader_img_name != ''){
                  $filePath = "../images/home/slide/".$slideheader_img_name;
                  $res = Select("tbslideheader", "where id = '".$id."'" );

                  while ($row = mysql_fetch_array($res))
                  {
                      $slideheader_img = $row['slideheader_img'];
                      if($slideheader_img){
                          unlink("../images/home/slide/$slideheader_img");
                      }
                  }
                  move_uploaded_file($slideheader_img_tmp, $filePath);
                  $Update = Update("tbslideheader",
                  "slideheader_title='".$slideheader_title_table."',
                  slideheader_text='".trim($slideheader_text_table)."',
                  slideheader_img='".$slideheader_img_name."' WHERE id = '".$id."'");

                  header('Location: housebackSlideHeader.php');
                  exit;
              }else{
                  $Update = Update("tbslideheader",
                  "slideheader_title='".$slideheader_title_table."',
                  slideheader_text='".trim($slideheader_text_table)."' WHERE id = '".$id."'");

                  header('Location: housebackSlideHeader.php');
                  exit;
              }
        break;

        case 'Del' :
              $Img_file = $_GET['Img_file'];
              $id = $_GET['id'];
              Delete("tbslideheader","WHERE id = '".$id."'");

              if($Img_file){
                unlink("../images/home/slide/$Img_file");
              }

              header('Location: housebackSlideHeader.php');
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
            <h1 align="center">Slide Carusel</h1>
            <div class="row">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Slide Carusel
                    </div>
                    <div class="panel-body">
                        <form action="?Act=Add" method ="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">ชื่อเรื่อง</label>

                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="slideheader_title" id="slideheader_title">
                                    </div>

                                 </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">รายละเอียด</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="slideheader_text" id="slideheader_text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">รูปภาพ</label>
                                    <div class="col-md-9">
                                        <input type="file" class="form-control" name="slideheader_img" id="slideheader_img" >
                                    </div>
                                </div>

                                <div class="form-group">
                                     <label class="col-md-3 control-label"></label>
                                    <div class="col-md-9">
                                         <button type="submit" class="btn btn-success" name="sumitSlideHeader" onclick="return CheckValue();">Add</button>
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
                                            <th>ภาพ</th>
                                            <th>จัดการ</th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                            $i = 1;
                                            $res = Select("tbslideheader", "" );
                                            while ($row = mysql_fetch_array($res))
                                            {
                                                    $id = $row['id'];
                                                    $slideheader_title = $row['slideheader_title'];
                                                    $slideheader_text = $row['slideheader_text'];
                                                    $slideheader_img = $row['slideheader_img'];

                                                ?>
                                                    <form action="?Act=Update&id=<?=$id;?>" method="post" role="form" enctype="multipart/form-data">
                                                    <tr>
                                                        <td class="hidden"><?php echo $id; ?></td>
                                                        <td><?php echo $i; ?></td>
                                                        <td><input type="text" name="slideheader_title_table" value="<?php echo $slideheader_title; ?>"></td>
                                                        <td>

                                                        <textarea name="slideheader_text_table" id="slideheader_text_table" rows="8" cols="40"><?php echo $slideheader_text; ?></textarea>

                                                        </td>

                                                        <td class="hidden" ><input type="text" name="slideheader_img_table"  value="<?php echo $slideheader_img; ?>"></td>

                                                        <td class="two">
                                                            <div class="col-md-12 no-padding " align="center">
                                                                <input type="file" name="slideheader_img">
                                                            </div><!-- /col-md-6 -->
                                                            <div class="col-md-12 " align="center">

                                                                <img style="max-width: 160px; max-height: 200px;"
                                                                src="<?php echo "../images/home/slide/".$slideheader_img;?>"
                                                                class="img-responsive">
                                                            </div><!-- /col-md-6 -->
                                                        </td>

                                                        <td>
                                                            <a href="JavaScript:if(confirm('Confirm Delete?')==true){window.location='?Act=Del&id=<?=$id;?>&Img_file=<?= $slideheader_img; ?>';}" class="btn btn-danger" name="btnDelete">D</a>

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
