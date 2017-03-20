<?php
    error_reporting(0);
    session_start();
    include ('../module/connectDB.php');
    include ('../module/function.php');
    include ('../module/ConClass.php');
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width = device-width, initial-scale=1">
    <title>backProject</title>

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
        case 'AddProject' :

                    $project_title = $_POST['project_title'];
                    $project_text = $_POST['project_text'];
                    $project_type = $_POST['project_type'];
                    $project_link = $_POST['project_link'];

                    $project_img_tmp = $_FILES['project_img']['tmp_name'];
                    $project_img_name = $_FILES['project_img']['name'];
                    $project_img_type = $_FILES['project_img']['type'];

                    $filePath = "../images/project/".$project_img_name;

                    $Check = Select("tbproject4","WHERE project_title='".$project_title."'");
                    $Num_Rows = Num_Rows($Check);


                    if($Num_Rows == 0){
                        move_uploaded_file($project_img_tmp, $filePath);

                        $InsertReply = Insert("tbproject4", "project_title, project_text, project_type, project_link, project_img",
                            "'".$project_title."','".$project_text."','".$project_type."','".$project_link."','".$project_img_name."'");

                            header('Location: housebackProject.php');
                            exit;
                    }else{
                        echo "<script language=\"javascript\">";
                        echo "alert('ใส่ข้อมูลก่อน ครับ ');";
                        echo "window.location='housebackProject.php';";
                        echo "</script>";
                    }
        break;



        case 'UpdateProject':
              $id = $_GET['id'];
              $project_title = $_POST['project_title'];
              $project_text = $_POST['project_text'];
              $project_type = $_POST['project_type'];
              $project_link = $_POST['project_link'];
              $project_img = $_POST['project_img'];

              $project_img_tmp = $_FILES['project_img']['tmp_name'];
              $project_img_name = $_FILES['project_img']['name'];
              $project_img_type = $_FILES['project_img']['type'];

              if($project_img_name != ''){
                  $filePath = "../images/project/".$project_img_name;
                  $res = Select("tbproject4", "where id = '".$id."'" );

                  while ($row = mysql_fetch_array($res))
                  {
                      $project_img = $row['project_img'];
                      if($project_img){
                          unlink("../images/project/$project_img");
                      }
                  }
                  move_uploaded_file($project_img_tmp, $filePath);
                  $Update = Update("tbproject4", "
                      project_title='".$project_title."',
                      project_text='".$project_text."',
                      project_type='".$project_type."',
                      project_link='".$project_link."',
                      project_img='".$project_img_name."' WHERE id = '".$id."'");

                  header('Location: housebackProject.php');
                  exit;
              }else{
                  $Update = Update("tbproject4", "
                      project_title='".$project_title."',
                      project_text='".$project_text."',
                      project_type='".$project_type."',
                      project_link='".$project_link."' WHERE id = '".$id."'");

                  header('Location: housebackProject.php');
                  exit;
              }
        break;




        case 'DelProject' :
                    $Img_file = $_GET['Img_file'];
                    $id = $_GET['id'];
                    Delete("tbproject4","WHERE id = '".$id."'");

                    if($Img_file){
                        unlink("../images/project/$Img_file");
                    }

                    header('Location: housebackProject.php');
                    exit;
        break;

        // type
        case 'AddType' :

                    $project_type_name = $_POST['project_type_name'];

                    $Check = Select("tbproject4_type","WHERE project_type_name='".$project_type_name."'");
                    $Num_Rows = Num_Rows($Check);

                    if($Num_Rows == 0){
                        $InsertReply = Insert("tbproject4_type", "project_type_name",
                            "'".$project_type_name."'");

                            header('Location: housebackProject.php');
                            exit;

                    }else{
                        echo "<script language=\"javascript\">";
                        echo "alert('ชื่อซ้ำ');";
                        echo "window.location='housebackProject.php';";
                        echo "</script>";
                    }
        break;

        case 'UpdateType':
                    $id = $_GET['id'];
                    $project_type_name = $_POST['project_type_name'];
                    $Update = Update("tbproject4_type", "
                        project_type_name='".$project_type_name."' WHERE id = '".$id."'");

                        header('Location: housebackProject.php');
                        exit;
        break;

        case 'DelType' :
                    $Img_file = $_GET['Img_file'];
                    $id = $_GET['id'];
                    Delete("tbproject4_type","WHERE id = '".$id."'");

                    if($Img_file){
                        unlink("../images/project/$Img_file");
                    }

                    header('Location: housebackProject.php');
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
        <h1 align="center">Project</h1>



        <!--project-->
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Project
                </div>
                <div class="panel-body">
                        <!--1 left-->
                    <div class="col-md-6">
                        <form action="?Act=AddProject" method ="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="col-md-3 control-label">ชื่อเรื่อง</label>

                                <div class="col-md-9">
                                    <input type="text"  name="project_title" id="project_title">
                                </div>

                             </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">เนื้อหา</label>
                                <div class="col-md-9">
                                    <textarea  rows="5"  name="project_text" id="project_text"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">ประเภท</label>
                                <div class="col-md-9">
                                <?php
                                $res = Select("tbproject4_type", "where project_type_name !='' && id > '1' " );
                                $check = 'checked';

                                while ($row = mysql_fetch_array($res))
                                {
                                    $id = $row['id'];
                                    $project_type_name = $row['project_type_name'];


                                    ?>
                                    <div class="col-md-6 no-padding">
                                        <div class="">

                                            <input type="radio" name="project_type"  id="<?php echo $project_type_name;?>"
                                            value="<?php echo $project_type_name;?>" <?php echo $check?> />
                                            <label for="<?php echo $project_type_name; ?>">
                                                <?php echo $project_type_name; ?><label>
                                        </div><!-- /form-control -->

                                    </div><!-- /col-md-3 -->


                                    <?php
                                    $check ='';
                                }

                                ?>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-3 control-label">ลิงค์</label>
                                <div class="col-md-9">
                                    <input type="text"  name="project_link" id="project_link">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">รูปภาพ</label>
                                <div class="col-md-9">
                                    <input type="file"  name="project_img" id="project_img" >
                                </div>
                            </div>

                            <div class="form-group">
                                 <label class="col-md-3 control-label"></label>
                                <div class="col-md-9">
                                     <button type="submit" class="btn btn-success" name="sumitProject" onclick="return CheckValue();">Add</button>
                                </div>
                            </div>
                        </form>
                    </div><!-- /col-md-6 -->

                    <!-- 2 right-->
                    <div class="col-md-6">
                        <form action="?Act=AddType" method ="post" class="form-horizontal" role="form" enctype="multipart/form-data">

                            <div class="form-group">
                                <div class="col-md-10">
                                    <input type="text"  name="project_type_name" id="project_type_name" placeholder="เพิ่มประเภทโปรเจค">
                                </div>

                                <div class="col-md-2 ">
                                    <button type="submit"  class="btn btn-success" name="sumitAddType" style="width:100%;"
                                        onclick="return CheckValue(); ">Add</button>

                                    <div class ="clearfix"></div>
                                </div>
                            </div>
                        </form>
                        <div class="well">
                            <?php
                            $res = Select("tbproject4_type", "where project_type_name != '' " );
                            while ($row = mysql_fetch_array($res))
                            {
                                $id = $row['id'];
                                $project_type_name = $row['project_type_name'];

                                ?>
                                <form action="?Act=UpdateType&id=<?=$id;?>" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <div class="col-md-8">
                                            <input type="text"  name="project_type_name" id="project_type_name"
                                            value="<?php echo $project_type_name; ?>">
                                        </div>

                                        <div class="col-md-4">
                                         <button type="submit" class="btn btn-info" name="sumitUpdateType"onclick="return CheckValue();">U</button>
                                         <a href="JavaScript:if(confirm('Confirm Delete?')==true){window.location='?Act=DelType&id=<?= $id;?>';}" class="btn btn-danger" name="btnDelete">D </a>
                                     </div>
                                 </div>
                               </form>
                               <?php
                            }
                            ?>
                        </div><!-- /well -->
                    </div><!-- /col-md-6 -->

                    <!--table-->
                    <div class="col-md-12">
                        <div  class="scrollspy-example" style="min-height:600px;">
                            <div class="table-responsive" >
                                <table class="table table-bordered" >
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>ชื่อเรื่อง</th>
                                            <th>รายละเอียด</th>
                                            <th>ประเภท</th>
                                            <th>ลิงค์</th>
                                            <th>ภาพ</th>
                                            <th>จัดการ</th>
                                        </tr>
                                    </thead>

                                    <tbody >
                                        <?php
                                        $i =1 ;
                                        $res = Select("tbproject4", " where id > 1 order by id desc" );
                                        while ($row = mysql_fetch_array($res))
                                        {
                                            $id = $row['id'];
                                            $project_title = $row['project_title'];
                                            $project_text = $row['project_text'];
                                            $project_type = $row['project_type'];
                                            $project_link = $row['project_link'];
                                            $project_img = $row['project_img'];

                                            ?>
                                            <form  action="?Act=UpdateProject&id=<?= $id;?>"  method ="post" role="form" enctype="multipart/form-data" >
                                                <tr>
                                                    <td class="hidden"><?php echo $id; ?></td>
                                                    <td>
                                                      <?php echo $i; ?>
                                                    </td>
                                                    <td>
                                                      <input type="text"  name="project_title" value="<?php echo $project_title; ?>">
                                                    </td>

                                                    <td >
                                                      <textarea style="width: 200px;"  rows="5" name="project_text"
                                                        value=""><?php echo $project_text; ?></textarea>
                                                    </td>

                                                    <td>
                                                      <input type="text"  name="project_type"  value="<?php echo $project_type; ?>">
                                                    </td>

                                                    <td>
                                                      <input type="text"  name="project_link" value="<?php echo $project_link; ?>">
                                                    </td>

                                                    <td class="hidden">
                                                      <input type="text"  name="project_img" value="<?php echo $project_img; ?>">
                                                    </td>


                                                    <td class="two">
                                                        <div class="col-md-12 no-padding " align="center">
                                                            <input type="file" name="project_img">
                                                        </div><!-- /col-md-6 -->
                                                        <div class="col-md-12 " align="center">

                                                            <img style="max-width: 100px; max-height: 100px;"
                                                            src="<?php echo "../images/project/".$project_img; ?>"
                                                            class="img-responsive">
                                                        </div><!-- /col-md-6 -->
                                                    </td>
                                                    <td>
                                                        <div class="" align="center">
                                                            <a href="JavaScript:if(confirm('Confirm Delete?')==true){window.location='?Act=DelProject&id=<?=$id;?>&Img_file=<?=$project_img;?>';}" class="btn btn-danger" name="btnDelete">D</a>

                                                            <button type="submit" class="btn btn-info " name="sumitUpdateProject" >U</button>

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
