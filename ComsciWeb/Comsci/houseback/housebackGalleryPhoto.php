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
    <title>backGallery</title>

    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
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
      case 'addimg' :
                  $group = $_GET['group'];

                  for($i=0;$i<count($_FILES['photo']['name']);$i++)
                    {
                      if($_FILES["photo"]["name"][$i] != "")
                      {
                        if(move_uploaded_file($_FILES["photo"]["tmp_name"][$i], "../images/gallery/$group/".$_FILES["photo"]["name"][$i]))
                        {
                          $InsertReply = Insert("tbgalleryalbum", "ga_img, ga_group", "'".$_FILES['photo']['name'][$i]."','".$group."' ");
                        }
                      }
                    }


// $nameimg = mb_substr($_FILES['photo']['name'][$i], 0, 40,'UTF-8')
      break;

      case 'UpdateGalleryAlbum':
            $id = $_GET['id'];
            $group = $_GET['group'];
            // $groupAlbum = $_GET['groupalbum'];

            $ga_img_tmp = $_FILES['ga_img']['tmp_name'];
            $ga_img_name = $_FILES['ga_img']['name'];
            $ga_img_type = $_FILES['ga_img']['type'];

            if($ga_img_name != ''){
                $filePath = "../images/gallery/$group/".$ga_img_name;
                $res = Select("tbgalleryalbum", "where id = '".$id."'" );

                while ($row = mysql_fetch_array($res))
                {
                    $ga_img = $row['ga_img'];
                    if($ga_img){
                        unlink("../images/gallery/$group/$ga_img");
                    }
                }
                move_uploaded_file($ga_img_tmp, $filePath);
                $Update = Update("tbgalleryalbum", "

                    ga_img='".$ga_img_name."' WHERE id = '".$id."'");

                // header('Location: housebackGalleryPhoto.php');
                // exit;
            }else{

                // header('Location: housebackGalleryPhoto.php');
                // exit;
            }
      break;

      case 'DelGalleryAlbum' :
                  $Img_file = $_GET['Img_file'];
                  $id = $_GET['id'];
                  $group = $_GET['group'];

                  Delete("tbgalleryalbum","WHERE id = '".$id."'");

                  if($Img_file){
                      unlink("../images/gallery/$group/$Img_file");

                  }

      break;

      case 'UpdateDetailImg':
                  $id = $_GET['id'];
                  $detail_title = $_POST['detail_title'];
                  $detail_text = $_POST['detail_text'];

                  $Update = Update("tbdetailimg", "
                      detail_title='".$detail_title."',
                      detail_text='".trim($detail_text)."' WHERE id = '".$id."'");

                      // header('Location: housebackHistory.php');
                      // exit;
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
        <h1 align="center">อัลบั้ม <?php echo $_GET['name'] ?></h1>
        <div class="" align="left">
          <a href="housebackGallery.php" class="btn btn-danger">ย้อนกลับ</a>

        </div>
        <br>
        <!--project-->
        <div class="row">
          <div class="panel panel-default">
              <div class="panel-heading">
                  รายละเอียด อัลบั้ม
              </div>

              <div class="panel-body">
                  <?php
                  $group = $_GET['group'];
                  $res = Select("tbdetailimg", "where detail_group = '".$group."'" );

                  while ($row = mysql_fetch_array($res))
                  {
                      $id = $row['id'];
                      $detail_title = $row['detail_title'];
                      $detail_text = $row['detail_text'];
                      $detail_group = $row['detail_group'];

                      ?>
                      <form action="?Act=UpdateDetailImg&id=<?=$id;?>&group=<?=$detail_group;?>" method="post" role="form" enctype="multipart/form-data">

                          <div class="col-md-11">
                              <p>
                                  กลุ่ม <?php echo $detail_group ?>
                              </p>
                              <div class="form-group">
                                  <label class="col-md-2 control-label">ชื่อเรื่อง</label>

                                  <div class="col-md-10">
                                      <input type="text" class="form-control" name="detail_title" id="detail_title" value="<?php echo $detail_title; ?>">
                                  </div>

                              </div>

                              <div class="form-group">
                                  <label class="col-md-2 control-label">เนื้อหา</label>
                                  <div class="col-md-10">
                                    <textarea name="detail_text" id="detail_text" rows="8" cols="40"><?php echo $detail_text; ?></textarea>

                                  </div>
                              </div>


                              <div class="form-group">
                                  <label class="col-md-2 control-label"></label>
                                  <div class="col-md-10">
                                       <button type="submit" class="btn btn-primary" name="sumitCourseHistory"onclick="return CheckValue();">Update</button>
                                  </div>
                           </div>
                         </div>
                     </form>
                     <?php
                 }
                 ?>
             </div><!--End panel-body-->
          </div><!--End panel-->

            <div class="panel panel-default">
                <div class="panel-heading">
                    อัลบั้ม
                </div>
                <?php  $group = $_GET['group'];?>
                <div class="panel-body">
                  <form action="?Act=addimg&group=<?=$group;?>" method ="post" class="form-horizontal" role="form" enctype="multipart/form-data">

                      <div class="modal-body">
                        <input type="hidden" name="id" id="id" value="">

                        <div class="form-group">
                          <label for="f1">name</label>
                          <?php

                            $id = $_GET['id'];;

                           ?>
                          <input type="file" name="photo[]" multiple accept=".png, .jpg, .jpeg"/>
                        </div><!-- /form-group -->

                        </div><!-- /modal-body -->

                        <div class="">
                          <input type="submit"  class="btn btn-primary" value="Add Image">
                        </div><!-- /modal-footer -->
                        <br>
                    </form>


                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>ชื่อเรื่อง</th>

                                <th>ภาพ</th>


                            </tr>
                        </thead>

                        <tbody>

                            <?php
                                $i = 1;
                                $group = $_GET['group'];

                                $res = Select("tbgalleryalbum", "where ga_group = '".$group."'" );
                                while ($row = mysql_fetch_array($res))
                                {
                                        $id = $row['id'];
                                        $ga_img = $row['ga_img'];
                                        $ga_group = $row['ga_group'];
                                    ?>
                                    <form  action="?Act=UpdateGalleryAlbum&id=<?=$id;?>&group=<?=$ga_group;?>"  method ="post" role="form" enctype="multipart/form-data" >
                                        <tr>
                                            <td class="hidden"><?php echo $id; ?></td>
                                            <td> <?php echo $i; ?></td>

                                            <td class="two">
                                                <div class="col-md-12 no-padding " align="center">
                                                    <input type="file" name="ga_img">
                                                </div><!-- /col-md-6 -->
                                                <div class="col-md-12 " align="center">

                                                    <img style="max-width: 100px; max-height: 100px;"
                                                    src="<?php echo "../images/gallery/".$group."/".$ga_img; ?>"
                                                    class="img-responsive">
                                                </div><!-- /col-md-6 -->

                                            </td>


                                            <td>
                                                <a href="JavaScript:if(confirm('Confirm Delete?')==true)
                                                {window.location='?Act=DelGalleryAlbum&id=<?= $id;?>&Img_file=<?=$ga_img;?>&group=<?=$ga_group;?>';}" class="btn btn-danger" name="btnDelete">D</a>

                                                <button type="submit" class="btn btn-primary" name="sumitGa" >U</button>
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
    </div><!--Col-md-10-->
</div><!--Container-fluid-->






<script src="../js/DropdownHover.js"></script>
<script src="../js/app.js"></script>

</body>
<?php } ?>
</html>
