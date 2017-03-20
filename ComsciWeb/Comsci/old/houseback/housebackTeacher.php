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
    <title>backTeacher</title>

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

    if(document.getElementById('teacher_img').value == ""){
        alert('เพิ่มรูป');
        document.getElementById('teacher_img').focus();
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
        case 'AddTeacher' :
                    $teacher_name = $_POST['teacher_name'];
                    $teacher_position = $_POST['teacher_position'];
                    $teacher_text = $_POST['teacher_text'];
                    $teacher_email = $_POST['teacher_email'];

                    $teacher_facebook = $_POST['teacher_facebook'];
                    $teacher_google = $_POST['teacher_google'];


                    $teacher_img_tmp = $_FILES['teacher_img']['tmp_name'];
                    $teacher_img_name = $_FILES['teacher_img']['name'];
                    $teacher_img_type = $_FILES['teacher_img']['type'];

                    $filePath = "../images/teacher/".$teacher_img_name;

                    $Check = Select("tbteacher","WHERE teacher_name='".$teacher_name."'");
                    $Num_Rows = Num_Rows($Check);

                    if($Num_Rows == 0){
                        move_uploaded_file($teacher_img_tmp, $filePath);

                        $InsertReply = Insert("tbteacher", "teacher_name, teacher_position, teacher_text, teacher_email, teacher_img, teacher_facebook, teacher_google",
                            "'".$teacher_name."','".$teacher_position."','".$teacher_text."','".$teacher_email."','".$teacher_img_name."','".$teacher_facebook."','".$teacher_google."'");

                            header('Location: housebackTeacher.php');
                            exit;

                    }else{
                        echo "<script language=\"javascript\">";
                        echo "alert('ใส่ข้อมูลก่อน ครับ ');";
                        echo "window.location='housebackTeacher.php';";
                        echo "</script>";
                    }
        break;

        case 'UpdateTeacher':
                    $id = $_GET['id'];
                    $teacher_name = $_POST['teacher_name'];
                    $teacher_text = $_POST['teacher_text'];
                    $teacher_position = $_POST['teacher_position'];
                    $teacher_email = $_POST['teacher_email'];
                    $teacher_facebook = $_POST['teacher_facebook'];
                    $teacher_google = $_POST['teacher_google'];
                    $teacher_img = $_POST['teacher_img'];
                    $teacher_img = $_POST['teacher_img'];

                    $teacher_img_tmp = $_FILES['teacher_img']['tmp_name'];
                    $teacher_img_name = $_FILES['teacher_img']['name'];
                    $teacher_img_type = $_FILES['teacher_img']['type'];

                    if($teacher_img_name != ''){
                        $filePath = "../images/teacher/".$teacher_img_name;
                        $res = Select("tbteacher", "where id = '".$id."'" );

                        while ($row = mysql_fetch_array($res))
                        {
                            $teacher_img = $row['teacher_img'];
                            if($teacher_img){
                                unlink("../images/teacher/$teacher_img");
                            }
                        }
                        move_uploaded_file($teacher_img_tmp, $filePath);
                        $Update = Update("tbteacher", "
                            teacher_name='".$teacher_name."',
                            teacher_text='".$teacher_text."',
                            teacher_position='".$teacher_position."',
                            teacher_email='".$teacher_email."',
                            teacher_facebook='".$teacher_facebook."',
                            teacher_google='".$teacher_google."',
                            teacher_img='".$teacher_img_name."' WHERE id = '".$id."'");

                            header('Location: housebackTeacher.php');
                            exit;

                    }else{
                        $Update = Update("tbteacher", "
                            teacher_name='".$teacher_name."',
                            teacher_text='".$teacher_text."',
                            teacher_position='".$teacher_position."',
                            teacher_email='".$teacher_email."',
                            teacher_facebook='".$teacher_facebook."',
                            teacher_google='".$teacher_google."' WHERE id = '".$id."'");

                            header('Location: housebackTeacher.php');
                            exit;

                    }
        break;



        case 'DelTeacher' :
                    $Img_file = $_GET['Img_file'];
                    $id = $_GET['id'];
                    Delete("tbteacher","WHERE id = '".$id."'");

                    if($Img_file){
                        unlink("../images/teacher/$Img_file");
                    }

                    header('Location: housebackTeacher.php');
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
                        <form action="?Act=AddTeacher" method ="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                            <div class="form-group">
                                <label class="col-md-3 control-label">ชื่ออาจารย์</label>

                                <div class="col-md-9">
                                    <input type="text"  name="teacher_name" id="teacher_name">
                                </div>

                             </div>

                             <div class="form-group">
                                <label class="col-md-3 control-label">ตำแหน่ง</label>

                                <div class="col-md-9">
                                    <input type="text"  name="teacher_position" id="teacher_position">
                                </div>

                             </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">ความสามารถ</label>
                                <div class="col-md-9">
                                    <textarea  rows="5"  name="teacher_text" id="teacher_text"></textarea>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-md-3 control-label">อีเมล์</label>
                                <div class="col-md-9">
                                    <input type="text"  name="teacher_email" id="teacher_email">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">ติดต่อ</label>
                                <div class="col-md-9 ">
                                    <table class="table table-hover">
                                        <tr>
                                            <td>
                                                <label >Facebook</label>
                                            </td>
                                            <td>
                                                <input  name="teacher_facebook" id="teacher_facebook" type="text" />
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <label> Google+</label>
                                            </td>
                                            <td>
                                                <input  name="teacher_google" id="teacher_facebook" type="text" />
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label">รูปภาพ</label>
                                <div class="col-md-9">
                                    <input type="file"  name="teacher_img" id="teacher_img" >
                                </div>
                            </div>

                            <div class="form-group">
                                 <label class="col-md-3 control-label"></label>
                                <div class="col-md-9">
                                     <button type="submit" class="btn btn-success" name="AddTeacher" onclick="return CheckValue();">Add</button>
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
                                            <th>#</th>
                                            <th>ชื่อ</th>
                                            <th>ความสามารถ</th>
                                            <th>ตำแหน่ง</th>
                                            <th>อีเมล์</th>
                                            <th>facebook</th>
                                            <th>google</th>
                                            <th>img</th>
                                            <th>จัดการ</th>
                                        </tr>
                                    </thead>

                                    <tbody >
                                        <?php
                                        $i = 1;
                                        $res = Select("tbteacher", " " );
                                        while ($row = mysql_fetch_array($res))
                                        {
                                            $id = $row['id'];
                                            $teacher_name = $row['teacher_name'];
                                            $teacher_position = $row['teacher_position'];
                                            $teacher_text = $row['teacher_text'];
                                            $teacher_email = $row['teacher_email'];
                                            $teacher_img = $row['teacher_img'];
                                            $teacher_facebook = $row['teacher_facebook'];
                                            $teacher_google = $row['teacher_google'];

                                            ?>
                                            <form  action="?Act=UpdateTeacher&id=<?=$id;?>" method ="post" role="form" enctype="multipart/form-data">
                                                <tr>
                                                    <td class="hidden"><?php echo $id; ?></td>
                                                    <td><?php echo $i; ?></td>

                                                    <td><input type="text"  name="teacher_name" value="<?php echo $teacher_name; ?>"></td>
                                                    <td ><textarea class="form-control two" rows="5" name="teacher_text"  value=""><?php echo $teacher_text; ?></textarea></td>
                                                    <td><input type="text"  name="teacher_position" value="<?php echo $teacher_position; ?>"></td>
                                                    <td><input type="text"  name="teacher_email" value="<?php echo $teacher_email; ?>"></td>
                                                    <td><input type="text"  name="teacher_facebook" value="<?php echo $teacher_facebook; ?>"></td>
                                                    <td><input type="text"  name="teacher_google" value="<?php echo $teacher_google; ?>"></td>
                                                    <td class="hidden"><input type="text"  name="teacher_img" value="<?php echo $teacher_img; ?>"></td>
                                                    <td>

                                                        <div class="col-md-12 no-padding " align="center">
                                                            <input type="file" class="form-control " name="teacher_img" style="width:150px;">
                                                        </div><!-- /col-md-6 -->
                                                        <div class="col-md-12 " align="center">

                                                            <img style="max-width: 100px; max-height: 100px;"
                                                                src="<?php echo "../images/teacher/".$teacher_img; ?>"
                                                                class="img-responsive">
                                                        </div><!-- /col-md-6 -->
                                                    </td>
                                                    <td>
                                                        <div  align="center">
                                                            <a href="JavaScript:if(confirm('Confirm Delete?')==true){window.location='?Act=DelTeacher&id=<?=$id;?>&Img_file=<?=$teacher_img;?>';}" class="btn btn-danger" name="btnDelete">D</a>

                                                            <button type="submit" class="btn btn-info " name="sumitUpdateTeacher" >U</button>

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
