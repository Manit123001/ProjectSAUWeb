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

    if(document.getElementById('admis_title_content').value == ""){
        alert('ป้อนหัวเรื่อง');
        document.getElementById('admis_title_content').focus();
        return false;
    }

    if(document.getElementById('admis_text_content').value == ""){
        alert('ป้อนรายละเอียด');
        document.getElementById('admis_text_content').focus();
        return false;
    }

    if(document.getElementById('admis_link_content').value == ""){
        alert('เพิ่มรูป');
        document.getElementById('admis_link_content').focus();
        return false;
    }
    }

    function CheckValue2(){

    if(document.getElementById('admis_title_ImgSlide').value == ""){
        alert('ป้อนหัวเรื่อง');
        document.getElementById('admis_title_ImgSlide').focus();
        return false;
    }

    if(document.getElementById('admis_text_ImgSlide').value == ""){
        alert('ป้อนรายละเอียด');
        document.getElementById('admis_text_ImgSlide').focus();
        return false;
    }

    if(document.getElementById('admis_img_ImgSlide').value == ""){
        alert('ป้อนชื่อ');
        document.getElementById('admis_img_ImgSlide').focus();
        return false;
    }
    }

    function CheckValue3(){

    if(document.getElementById('admis_viedo2').value == ""){
        alert('Embed วีดีโอ');
        document.getElementById('admis_viedo2').focus();
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

    <!-- Admission -->
    <?php
    $Act = $_GET['Act'];

    switch($Act){
        case 'AddAdmis' :
                    if(isset($_POST['sumitAdmisImgSlide'])){

                        $admis_title_ImgSlide = $_POST['admis_title_ImgSlide'];
                        $admis_text_ImgSlide = $_POST['admis_text_ImgSlide'];

                        $admis_img_ImgSlide_tmp = $_FILES['admis_img_ImgSlide']['tmp_name'];
                        $admis_img_ImgSlide_name = $_FILES['admis_img_ImgSlide']['name'];
                        $admis_img_ImgSlide_type = $_FILES['admis_img_ImgSlide']['type'];

                        $filePath = "../images/home/".$admis_img_ImgSlide_name;


                        $Check = Select("tbadmission","WHERE admis_title ='".$admis_title_ImgSlide."'");
                        $Num_Rows = Num_Rows($Check);

                        if($Num_Rows == 0){
                            move_uploaded_file($admis_img_ImgSlide_tmp, $filePath);

                            $InsertReply = Insert("tbadmission", "admis_title, admis_text, admis_img", "'".$admis_title_ImgSlide."','".$admis_text_ImgSlide."','".$admis_img_ImgSlide_name."'");

                            header('Location: housebackAdmission.php');
                            exit;
                        }else{
                            echo "<script language=\"javascript\">";
                            echo "alert('ชื่อเรื่องนี้ : ".$admis_title_ImgSlide." มีอยู่ในระบบแล้ว');";
                            echo "window.location='housebackAdmission.php';";
                            echo "</script>";
                        }

                    }else if(isset($_POST['sumitAdmisWeb'])){

                        $admis_viedo = $_POST['admis_viedo'];

                        $Check = Select("tbadmission2","WHERE admis_viedo ='".$admis_viedo."'");
                        $Num_Rows = Num_Rows($Check);

                        if($Num_Rows == 0){

                                Insert("tbadmission2", "admis_viedo", "'".$admis_viedo."'");
                                header('Location: housebackAdmission.php');
                                exit;
                        }else{
                            echo "<script language=\"javascript\">";
                            echo "alert('ชื่อเรื่องนี้ : ".$admis_viedo." มีอยู่ในระบบแล้ว');";
                            echo "window.location='housebackAdmission.php';";
                            echo "</script>";
                        }
                    }


        break;



        case 'UpdateAdmis':

                    if(isset($_POST['sumitAdmisUpdate'])){
                        $id = $_GET['id'];
                        $admis_title_content = $_POST['admis_title_content'];
                        $admis_text_content = $_POST['admis_text_content'];
                        $admis_link_content = $_POST['admis_link_content'];

                        $Update = Update("tbadmission", "
                        admis_title='".$admis_title_content."',
                        admis_text='".trim($admis_text_content)."',
                        admis_webRegis='".$admis_link_content."' WHERE id = '".$id."'");

                        header('Location: housebackAdmission.php');
                        exit;

                    }else if(isset($_POST['sumitAdmisSlideUpdate'])){

                        $id = $_GET['id'];
                        $admis_title_table = $_POST['admis_title_table'];
                        $admis_text_table = $_POST['admis_text_table'];
                        $admis_img_table = $_POST['admis_img_table'];

                        $admis_img_tmp = $_FILES['admis_img']['tmp_name'];
                        $admis_img_name = $_FILES['admis_img']['name'];
                        $admis_img_type = $_FILES['admis_img']['type'];

                        if($admis_img_name != ''){
                            $filePath = "../images/home/admiss/".$admis_img_name;
                            $res = Select("tbadmission", "where id = '".$id."'" );

                            while ($row = mysql_fetch_array($res))
                            {
                                $admis_img = $row['admis_img'];
                                if($admis_img){
                                    unlink("../images/home/admiss/$admis_img");
                                }
                            }
                            move_uploaded_file($admis_img_tmp, $filePath);
                            $Update = Update("tbadmission", "
                            admis_title='".$admis_title_table."',
                            admis_text='".$admis_text_table."',
                            admis_img='".$admis_img_name."' WHERE id = '".$id."'");

                            header('Location: housebackAdmission.php');
                            exit;
                        }else{
                            $Update = Update("tbadmission", "
                            admis_title='".$admis_title_table."',
                            admis_text='".$admis_text_table."'WHERE id = '".$id."'");

                            header('Location: housebackAdmission.php');
                            exit;
                        }
                    }else if(isset($_POST['sumitAdmisSlideViedoUpdate'])){
                        $id = $_GET['id'];
                        $admis_viedo_table = $_POST['admis_viedo_table'];

                        $Update = Update("tbadmission2", "admis_viedo='".$admis_viedo_table."' WHERE id = '".$id."'");
                        header('Location: housebackAdmission.php');
                        exit;
                    }
        break;

        case 'DelAdmis' :
            $Img_file = $_GET['Img_file'];
            $id = $_GET['id'];
            Delete("tbadmission","WHERE id = '".$id."'");

            if($Img_file){
              unlink("../images/home/admiss/$Img_file");
            }
            header('Location: housebackAdmission.php');
            exit;
        break;


        case 'DelViedoAdmis' :

            $Img_file = $_GET['Img_file'];
            $id = $_GET['id'];
            Delete("tbadmission2","WHERE id = '".$id."'");
            header('Location: housebackAdmission.php');
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
            <!-- Admission -->
            <h1 align="center">Admission</h1>
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        เนื้อหา
                    </div>

                    <div class="panel-body">

                        <?php
                        $res = Select("tbadmission", "where id = 1" );
                        while ($row = mysql_fetch_array($res))
                        {
                                $id = $row['id'];
                                $admis_title = $row['admis_title'];
                                $admis_text = $row['admis_text'];
                                $admis_webRegis = $row['admis_webRegis'];

                            ?>
                            <form action="?Act=UpdateAdmis&id=<?= $id;?>" method ="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">ชื่อเรื่อง</label>

                                        <div class="col-md-10">
                                            <input type="text" value="<?php echo $admis_title; ?>"  name="admis_title_content" id="admis_title_content">
                                        </div>

                                     </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label">รายละเอียด</label>
                                        <div class="col-md-10">

                                              <textarea name="admis_text_content" id="admis_text_content" rows="8" cols="40"><?php echo $admis_text; ?></textarea>

                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="col-md-2 control-label">ลิงค์</label>
                                        <div class="col-md-10">
                                            <input type="text" value="<?php echo $admis_webRegis; ?>"  name="admis_link_content" id="admis_link_content">
                                        </div>
                                    </div>


                                    <div class="form-group">
                                         <label class="col-md-2 control-label"></label>
                                        <div class="col-md-10">
                                             <button type="submit" class="btn btn-primary" name="sumitAdmisUpdate" onclick="return CheckValue();">Update</button>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>


            <!--1 SlideImg -->
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        รูปภาพ สไลด์
                    </div>
                    <div class="panel-body">
                        <form action="?Act=AddAdmis" method ="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                            <div class="col-md-6">


                                <div class="form-group">
                                    <label class="col-md-3 control-label">ชื่อเรื่อง</label>
                                    <div class="col-md-9">
                                        <input type="text"  name="admis_title_ImgSlide" id="admis_title_ImgSlide">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">รายละเอียด</label>
                                    <div class="col-md-9">
                                        <input type="text"  name="admis_text_ImgSlide" id="admis_text_ImgSlide">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">รูปภาพ</label>
                                    <div class="col-md-9">
                                        <input type="file"  name="admis_img_ImgSlide" id="admis_img_ImgSlide" >
                                    </div>
                                </div>

                                <div class="form-group">
                                     <label class="col-md-3 control-label"></label>
                                    <div class="col-md-9">
                                         <button type="submit" class="btn btn-success" name="sumitAdmisImgSlide" onclick="return CheckValue2();"> Add </button>
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
                                            $i =1;
                                            $res = Select("tbadmission", " where id >= 5" );
                                            while ($row = mysql_fetch_array($res))
                                            {
                                                    $id = $row['id'];
                                                    $admis_title = $row['admis_title'];
                                                    $admis_text = $row['admis_text'];
                                                    $admis_img = $row['admis_img'];

                                                ?>
                                                <form action="?Act=UpdateAdmis&id=<?=$id;?>" method ="post" role="form" enctype="multipart/form-data">

                                                    <tr>
                                                        <td class="hidden"><?php echo $id; ?></td>
                                                        <td><?php echo $i; ?></td>
                                                        <td><input type="text" name="admis_title_table"
                                                          value="<?php echo $admis_title; ?>">
                                                        </td>
                                                        <td>

                                                          <textarea name="admis_text_table" rows="5" ><?php echo $admis_text; ?></textarea>
                                                        </td>

                                                        <td class="hidden"><input type="text" name="admis_img_table"
                                                          value="<?php echo $admis_img; ?>">
                                                        </td>

                                                        <td class="two">
                                                            <div class="col-md-12 no-padding " align="center">
                                                                <input type="file" name="admis_img">
                                                            </div><!-- /col-md-6 -->
                                                            <div class="col-md-12 " align="center">
                                                                <img style="max-width: 100px; max-height: 100px;"
                                                                src="<?php echo "../images/home/admiss/".$admis_img;?>"
                                                                class="img-responsive">
                                                            </div><!-- /col-md-6 -->
                                                        </td>

                                                        <td>
                                                            <a href="JavaScript:if(confirm('Confirm Delete?')==true){window.location='?Act=DelAdmis&id=<?=$id;?>&Img_file=<?= $admis_img;?>';}" class="btn btn-danger" name="btnDelete">D</a>

                                                            <button type="submit" class="btn btn-primary" name="sumitAdmisSlideUpdate" >U</button>
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


            <!--2 Slide Viedo -->
            <div class="row">

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Viedo สไลด์
                    </div>

                    <div class="panel-body">
                        <form action="?Act=AddAdmis" method ="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Embed วีดีโอ</label>
                                    <div class="col-md-9">

                                        <input type="text"  name="admis_viedo" id="admis_viedo2">

                                    </div>
                                </div>

                                <div class="form-group">
                                     <label class="col-md-3 control-label"></label>
                                    <div class="col-md-9">
                                            <button type="submit" class="btn btn-success" name="sumitAdmisWeb" onclick="return CheckValue3();"> AddEmbbed </button>

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
                                            <th>Embed Youtube</th>
                                            <th>จัดการ</th>
                                        </tr>
                                    </thead>

                                    <tbody>


                                        <?php
                                            $i = 1;
                                            $res = Select("tbadmission2", "" );
                                            while ($row = mysql_fetch_array($res))
                                            {
                                                    $id = $row['id'];

                                                    $admis_viedo = $row['admis_viedo'];

                                                ?>
                                                <form action="?Act=UpdateAdmis&id=<?= $id;?>"  method ="post" role="form" enctype="multipart/form-data">
                                                    <tr>
                                                        <td class="hidden"><?php echo $id; ?></td>
                                                        <td><?php echo $i; ?></td>
                                                        <td><input style="min-width: 100%" type="text" name="admis_viedo_table" value="<?php echo $admis_viedo; ?>"></td>

                                                        <td>
                                                            <a href="JavaScript:if(confirm('Confirm Delete?')==true){window.location='?Act=DelViedoAdmis&id=<?= $id;?>';}" class="btn btn-danger" name="btnViedoDelete">Delete</a>

                                                            <button type="submit" class="btn btn-primary" name="sumitAdmisSlideViedoUpdate" >Update</button>
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
