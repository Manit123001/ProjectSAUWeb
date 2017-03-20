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
    <title>backSuccess</title>

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

    if(document.getElementById('subject_normal').value == ""){
        alert('ป้อนหัวเรื่อง');
        document.getElementById('subject_normal').focus();
        return false;
    }

    if(document.getElementById('project_text').value == ""){
        alert('ป้อนรายละเอียด');
        document.getElementById('project_text').focus();
        return false;
    }


     if(document.getElementById('project_link   ').value == ""){
        alert('ป้อนรายละเอียด');
        document.getElementById('project_link   ').focus();
        return false;
    }

    if(document.getElementById('project_img').value == ""){
        alert('เพิ่มรูป');
        document.getElementById('project_img').focus();
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
        case 'AddSuccess' :

                    $success_title = $_POST['success_title'];
                    $success_text = $_POST['success_text'];
                    // $success_side = $_POST['success_side'];

                    $checkSide = Select("tbsuccess","");
                    $num_side = Num_Rows($checkSide);
                    error_log($success_text) ;
                    $side = $num_side%2;
                    if($side == 0){
                      $success_side ="left";
                      ;
                    }else{
                      $success_side ="right";
                    }

                    $success_img_tmp = $_FILES['success_img']['tmp_name'];
                    $success_img_name = $_FILES['success_img']['name'];
                    $success_img_type = $_FILES['success_img']['type'];

                    $filePath = "../images/success/".$success_img_name;

                    $Check = Select("tbsuccess","WHERE success_title='".$success_title."'");
                    $Num_Rows = Num_Rows($Check);

                    if($Num_Rows == 0){
                        move_uploaded_file($success_img_tmp, $filePath);

                        $InsertReply = Insert("tbsuccess", "success_title, success_text, success_side, success_img",
                            "'".$success_title."','".$success_text."','".$success_side."','".$success_img_name."'");

                            header('Location: housebackSuccess.php');
                            exit;
                    }else{
                        echo "<script language=\"javascript\">";
                        echo "alert('ใส่ข้อมูลก่อน ครับ ');";
                        echo "window.location='housebackSuccess.php';";
                        echo "</script>";
                    }
        break;


        case 'UpdateSuccess':
              $id = $_GET['id'];
              $success_title = $_POST['success_title'];
              $success_text = $_POST['success_text'];
              $success_side = $_POST['success_side'];
              $success_img = $_POST['success_img'];

              $success_img_tmp = $_FILES['success_img']['tmp_name'];
              $success_img_name = $_FILES['success_img']['name'];
              $success_img_type = $_FILES['success_img']['type'];

              if($success_img_name != ''){
                  $filePath = "../images/success/".$success_img_name;
                  $res = Select("tbsuccess", "where id = '".$id."'" );

                  while ($row = mysql_fetch_array($res))
                  {
                      $success_img = $row['success_img'];
                      if($success_img){
                          unlink("../images/success/$success_img");
                      }
                  }
                  move_uploaded_file($success_img_tmp, $filePath);
                  $Update = Update("tbsuccess", "
                      success_title='".$success_title."',
                      success_text='".$success_text."',
                      success_side='".$success_side."',
                      success_img='".$success_img_name."' WHERE id = '".$id."'");

                  header('Location: housebackSuccess.php');
                  exit;
              }else{
                  $Update = Update("tbsuccess", "
                      success_title='".$success_title."',
                      success_text='".$success_text."',
                      success_side='".$success_side."' WHERE id = '".$id."'");

                  header('Location: housebackSuccess.php');
                  exit;
              }
        break;

        case 'DelSuccess' :
                    $Img_file = $_GET['Img_file'];
                    $id = $_GET['id'];
                    Delete("tbsuccess","WHERE id = '".$id."'");

                    if($Img_file){
                        unlink("../images/success/$Img_file");
                    }
                    header('Location: housebackSuccess.php');
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
        <h1 align="center">Success</h1>

        <!--project-->
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Success
                </div>
                <div class="panel-body">
                        <!--1 left-->
                    <div class="col-md-6">
                        <form action="?Act=AddSuccess" method ="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="col-md-3 control-label">ชื่อเรื่อง</label>

                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="success_title" id="success_title">
                                </div>

                             </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">เนื้อหา</label>
                                <div class="col-md-9">
                                    <textarea class="form-control" rows="10"  name="success_text" id="success_text"></textarea>
                                </div>
                            </div>

                            <!-- <div class="form-group">
                                <label class="col-md-3 control-label">ประเภท</label>
                                <div class="col-md-9">
                                    <input type="radio" name="success_side"  value="left" id="left" checked> <label for="left">Left </label>
                                    <input type="radio" name="success_side" value="right" id="right"> <label for="right">Right </label>
                                </div>
                            </div> -->


                            <div class="form-group">
                                <label class="col-md-3 control-label">รูปภาพ</label>
                                <div class="col-md-9">
                                    <input type="file" class="form-control" name="success_img" id="success_img" >
                                </div>
                            </div>

                            <div class="form-group">
                                 <label class="col-md-3 control-label"></label>
                                <div class="col-md-9">
                                     <button type="submit" class="btn btn-success" name="sumitSuccess" onclick="return CheckValue();">Add</button>
                                </div>
                            </div>
                        </form>
                    </div><!-- /col-md-6 -->


                    <!--table-->
                    <div class="col-md-12">
                        <div  class="scrollspy-example" style="min-height:600px;">
                            <div class="table-responsive" >
                                <table class="table table-bordered" >
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>ชื่อเรื่อง</th>
                                            <th>รายละเอียด</th>
                                            <th>ประเภท</th>
                                            <th>ภาพ</th>
                                            <th>จัดการ</th>
                                        </tr>
                                    </thead>

                                    <tbody >
                                        <?php
                                        $i = 1;
                                        $res = Select("tbsuccess", "order by id desc" );
                                        while ($row = mysql_fetch_array($res))
                                        {
                                            $id = $row['id'];
                                            $success_title = $row['success_title'];
                                            $success_text = $row['success_text'];
                                            $success_side = $row['success_side'];
                                            $success_img = $row['success_img'];

                                            ?>
                                            <form  action="?Act=UpdateSuccess&id=<?= $id;?>"  method ="post" role="form" enctype="multipart/form-data" >
                                                <tr>
                                                    <td class="hidden"><?php echo $id; ?></td>
                                                    <td><?php echo $i; ?></td>
                                                    <td><input type="text" class="form-control" name="success_title" value="<?php echo $success_title; ?>"></td>

                                                    <td ><textarea class="form-control" rows="5" name="success_text"  value=""><?php echo $success_text; ?></textarea></td>

                                                    <td><input type="text" class="form-control" name="success_side"  value="<?php echo $success_side; ?>"></td>


                                                    <td class="hidden"><input type="text" class="form-control" name="success_img" value="<?php echo $success_img; ?>"></td>

                                                    <td class="two">
                                                        <div class="col-md-12 no-padding " align="center">
                                                            <input type="file" name="success_img">
                                                        </div><!-- /col-md-6 -->
                                                        <div class="col-md-12 " align="center">

                                                            <img style="max-width: 160px; max-height: 100px;"
                                                            src="<?php echo "../images/success/".$success_img; ?>"
                                                            class="img-responsive">
                                                        </div><!-- /col-md-6 -->
                                                    </td>
                                                    <td>
                                                        <div class="" align="center">
                                                            <a href="JavaScript:if(confirm('Confirm Delete?')==true){window.location='?Act=DelSuccess&id=<?=$id;?>&Img_file=<?=$success_img;?>';}" class="btn btn-danger" name="btnDelete">D</a>

                                                            <button type="submit" class="btn btn-info " name="sumitUpdateSuccess" >U</button>

                                                        </div><!-- / -->
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
                    </div><!-- /col-md-12 -->
                </div>


            </div>
        </div>

    </div><!--Col-md-10-->
</div><!--Container-fluid-->






<script src="../js/DropdownHover.js"></script>
<script src="../js/app.js"></script>

</body>
<?php } ?>
</html>
