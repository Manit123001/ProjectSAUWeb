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
    <meta name="viewport" content="width = device-width, initial-scale=1">
    <title>backGallery</title>

    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>

    <!-- custom -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/vendors.css">

    <link rel="stylesheet" href="fonts/font-awesome/font-awesome-4.6.2/css/font-awesome.min.css">

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
        echo "window.location='login.php';";
        echo "</script>";
    } else{
?>
<body>

    <!-- News -->
    <?php
    $Act = $_GET['Act'];

    switch($Act){
        case 'AddGallery' :
                    $name = '1000';
                    $gallery_title = $_POST['gallery_title'];
                    $gallery_text = $_POST['gallery_text'];
                    $gallery_img = $_POST['gallery_img'];


                    $gallery_img_tmp = $_FILES['gallery_img']['tmp_name'];
                    $gallery_img_name = $_FILES['gallery_img']['name'];
                    $gallery_img_type = $_FILES['gallery_img']['type'];

                    $Check = Select("tbgallery","");
                    $Num_Rows = Num_Rows($Check);
                    $nameGroup = $name + $Num_Rows;

                    $flgCreate = mkdir("images/gallery/$nameGroup");


                    $filePath = "images/gallery/".$gallery_img_name;

                    $Check = Select("tbgallery","WHERE gallery_title='".$gallery_title."'");
                    $Num_Rows = Num_Rows($Check);

                    if($Num_Rows == 0){
                        move_uploaded_file($gallery_img_tmp, $filePath);

                        $InsertReply = Insert("tbgallery", "gallery_title, gallery_text, gallery_img, gallery_group",
                            "'".$gallery_title."','".$gallery_text."','".$gallery_img_name."','".$nameGroup."'");

                        $InsertDetail = Insert("tbdetailimg", "detail_group","'".$nameGroup."'");

                            header('Location: housebackGallery.php');
                            exit;
                    }else{
                        echo "<script language=\"javascript\">";
                        echo "alert('ใส่ข้อมูลก่อน ครับ ');";
                        echo "window.location='housebackGallery.php';";
                        echo "</script>";
                    }
        break;


        case 'UpdateGallery':
              $id = $_GET['id'];
              $group = $_GET['group'];

              $gallery_title = $_POST['gallery_title'];
              $gallery_text = $_POST['gallery_text'];

              $gallery_img_tmp = $_FILES['gallery_img']['tmp_name'];
              $gallery_img_name = $_FILES['gallery_img']['name'];
              $gallery_img_type = $_FILES['gallery_img']['type'];

              if($gallery_img_name != ''){
                  $filePath = "images/gallery/".$gallery_img_name;
                  $res = Select("tbgallery", "where id = '".$id."'" );

                  while ($row = mysql_fetch_array($res))
                  {
                      $gallery_img = $row['gallery_img'];
                      if($gallery_img){
                          unlink("images/gallery/$gallery_img");
                      }
                  }
                  move_uploaded_file($gallery_img_tmp, $filePath);
                  $Update = Update("tbgallery", "
                      gallery_title='".$gallery_title."',
                      gallery_text='".$gallery_text."',
                      gallery_img='".$gallery_img_name."' WHERE id = '".$id."'");

                  header('Location: housebackGallery.php');
                  exit;
              }else{
                  $Update = Update("tbgallery", "
                      gallery_title='".$gallery_title."',
                      gallery_text='".$gallery_text."' WHERE id = '".$id."'");

                  header('Location: housebackGallery.php');
                  exit;
              }
        break;

        case 'DelGallery' :
                    $Img_file = $_GET['Img_file'];
                    $id = $_GET['id'];
                    $group = $_GET['group'];
                    $Check = Select("tbgalleryalbum","WHERE id ='".$id."'");


                      Delete("tbgalleryalbum","WHERE ga_group = '".$group."'");
                      Delete("tbgallery","WHERE id = '".$id."'");
                      Delete("tbdetailimg","WHERE detail_group = '".$group."'");

                    if($Img_file){
                        unlink("images/gallery/$Img_file");
                        removeFolder('images/gallery/'.$group);

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
                        <form action="?Act=AddGallery" method ="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="col-md-3 control-label">ชื่อเรื่อง</label>

                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="gallery_title" id="gallery_title">
                                </div>

                             </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">เนื้อหา</label>
                                <div class="col-md-9">
                                    <textarea class="form-control" rows="10"  name="gallery_text" id="gallery_text"></textarea>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-3 control-label">รูปภาพ</label>
                                <div class="col-md-9">
                                    <input type="file" class="form-control" name="gallery_img" id="gallery_img" >
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
                        <div  class="" style="min-height:600px;">
                           <div class="row">
                             <div class="">
                               <table class="table datatable">
                                 <thead>
                                   <tr>
                                     <th>#</th>
                                     <th>ชื่อเรื่อง</th>
                                     <th>รายละเอียด</th>
                                     <th>รูปภาพ</th>
                                     <th>เพิ่มอัลบัม</th>
                                     <th>จัดการ</th>

                                   </tr>
                                 </thead>

                                 <tbody>

                                   <?php
                                   $i = 1;
                                   $res = Select("tbgallery", "" );
                                   while ($row = mysql_fetch_array($res))
                                   {
                                     $id = $row['id'];
                                     $gallery_title = $row['gallery_title'];
                                     $gallery_text = $row['gallery_text'];
                                     $gallery_img = $row['gallery_img'];
                                     $gallery_group = $row['gallery_group'];
                                     ?>
                                      <form  action="?Act=UpdateGallery&id=<?=$id;?>&group=<?=$gallery_group;?>"  method ="post" role="form" enctype="multipart/form-data" >

                                         <tr>
                                             <td class="hidden"><?php echo $id; ?></td>
                                             <td> <?php echo $i; ?></td>
                                             <td><input type="text" name="gallery_title" value="<?php echo $gallery_title; ?>"></td>
                                             <td ><textarea  class="form-control" rows="5" cols="30" name="gallery_text"  value=""><?php echo $gallery_text; ?></textarea></td>
                                             <td class="two">
                                                 <div class="col-md-12 no-padding " align="center">
                                                     <input type="file" name="gallery_img">
                                                 </div><!-- /col-md-6 -->
                                                 <div class="col-md-12 " align="center">

                                                     <img style="max-width: 100px; max-height: 100px;"
                                                     src="<?php echo "images/gallery/".$gallery_img; ?>"
                                                     class="img-responsive">
                                                 </div><!-- /col-md-6 -->

                                             </td>


                                             <td>
                                               <a href="housebackGalleryPhoto.php?id=<?=$id;?>&group=<?=$gallery_group?>&name=<?=$gallery_title;?>"  class="btn btn-success" name="btnDelete">Upload Photo</a>

                                             </td>

                                             <td>
                                               <a href="JavaScript:if(confirm('Confirm Delete?')==true){window.location='?Act=DelGallery&id=<?=$id;?>&Img_file=<?=$gallery_img;?>&group=<?=$gallery_group;?>';}" class="btn btn-danger" name="btnDelete">D</a>

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


                      </div><!-- /col-md-12 -->
                </div>
            </div>
        </div>

    </div><!--Col-md-10-->
</div><!--Container-fluid-->






<script src="js/DropdownHover.js"></script>
<script src="js/app.js"></script>

</body>
<?php } ?>
</html>
