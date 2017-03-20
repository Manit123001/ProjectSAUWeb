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

        if(document.getElementById('fac_headtitle').value == ""){
            alert('ป้อนหัวเรื่อง');
            document.getElementById('fac_headtitle').focus();
            return false;
        }

        if(document.getElementById('fac_title').value == ""){
            alert('ป้อนรายละเอียด');
            document.getElementById('fac_title').focus();
            return false;
        }

        if(document.getElementById('fac_text').value == ""){
            alert('เพิ่มข้อความ');
            document.getElementById('fac_text').focus();
            return false;
        }
        if(document.getElementById('fac_title1').value == ""){
            alert('เพิ่มข้อความ');
            document.getElementById('fac_title1').focus();
            return false;
        }

        if(document.getElementById('fac_detail_title1').value == ""){
            alert('ป้อนรายละเอียด1');
            document.getElementById('fac_detail_title1').focus();
            return false;
        }

        if(document.getElementById('fac_title2').value == ""){
            alert('เพิ่มรูป2');
            document.getElementById('fac_title2').focus();
            return false;
        }
        if(document.getElementById('fac_detail_title2').value == ""){
            alert('ป้อนหัวเรื่อง2');
            document.getElementById('fac_detail_title2').focus();
            return false;
        }

        if(document.getElementById('fac_title3').value == ""){
            alert('ป้อนรายละเอียด3');
            document.getElementById('fac_title3').focus();
            return false;
        }
        if(document.getElementById('fac_detail_title3').value == ""){
            alert('ป้อนรายละเอียด3');
            document.getElementById('fac_detail_title3').focus();
            return false;
        }

        if(document.getElementById('fac_link').value == ""){
            alert('ชื่อเว็บ');
            document.getElementById('fac_link').focus();
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
        <!-- Faculty -->
        <?php
        $Act = $_GET['Act'];

        switch($Act){
            case 'UpdateFac':

            if(isset($_POST['sumitFacUpdate'])){
                $FacID = $_GET['FacID'];

                $fac_headtitle = $_POST['fac_headtitle'];
                $fac_title = $_POST['fac_title'];
                $fac_text = $_POST['fac_text'];
                $fac_title1 = $_POST['fac_title1'];
                $fac_detail_title1 = $_POST['fac_detail_title1'];
                $fac_title2 = $_POST['fac_title2'];
                $fac_detail_title2 = $_POST['fac_detail_title2'];
                $fac_title3 = $_POST['fac_title3'];
                $fac_detail_title3 = $_POST['fac_detail_title3'];
                $fac_link = $_POST['fac_link'];

                $Update = Update("tbfaculty", "
                    fac_headtitle='".$fac_headtitle."',
                    fac_title='".$fac_title."',
                    fac_text='".$fac_text."',
                    fac_title1='".$fac_title1."',
                    fac_detail_title1='".$fac_detail_title1."',
                    fac_title2='".$fac_title2."',
                    fac_detail_title2='".$fac_detail_title2."',
                    fac_title3='".$fac_title3."',
                    fac_detail_title3='".$fac_detail_title3."',
                    fac_link='".$fac_link."' WHERE id = '".$FacID."'");

                header('Location: housebackFaculty.php');
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
                <!-- Faculty -->
                <h1 align="center">Faculty</h1>

                <div class="row">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            คณะ
                        </div>

                        <div class="panel-body">


                            <?php
                            $res = Select("tbfaculty", "where id = 1" );
                            while ($row = mysql_fetch_array($res))
                            {
                                # code...
                                $fac_id = $row['id'];
                                $fac_headtitle = $row['fac_headtitle'];
                                $fac_title = $row['fac_title'];
                                $fac_text = $row['fac_text'];
                                $fac_title1 = $row['fac_title1'];
                                $fac_detail_title1 = $row['fac_detail_title1'];
                                $fac_title2 = $row['fac_title2'];
                                $fac_detail_title2 = $row['fac_detail_title2'];
                                $fac_title3 = $row['fac_title3'];
                                $fac_detail_title3 = $row['fac_detail_title3'];
                                $fac_link = $row['fac_link'];


                                ?>
                                <form action="?Act=UpdateFac&FacID=<?= $fac_id;?>" method ="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                                    <div class="col-md-12">

                                        <div class="form-group">
                                            <label class="col-md-2 control-label">header</label>
                                            <div class="col-md-10">
                                                <input type="text" value="<?php echo $fac_headtitle; ?>" class="form-control" name="fac_headtitle" id="fac_headtitle">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label">สาขา</label>
                                            <div class="col-md-10">
                                                <input type="text" value="<?php echo $fac_title; ?>" class="form-control" name="fac_title" id="fac_title">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label">ข้อมูลสาขา</label>
                                            <div class="col-md-10">
                                                <input type="text" value="<?php echo $fac_text; ?>" class="form-control" name="fac_text" id="fac_text">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label">panel1</label>
                                            <div class="col-md-10">
                                                <input type="text" value="<?php echo $fac_title1; ?>" class="form-control" name="fac_title1" id="fac_title1">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label">รายละเอียด panel1</label>
                                            <div class="col-md-10">
                                                <input type="text" value="<?php echo $fac_detail_title1; ?>" class="form-control" name="fac_detail_title1" id="fac_detail_title1">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label">panel2</label>
                                            <div class="col-md-10">
                                                <input type="text" value="<?php echo $fac_title2; ?>" class="form-control" name="fac_title2" id="fac_title2">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label">รายละเอียด panel1</label>
                                            <div class="col-md-10">
                                                <input type="text" value="<?php echo $fac_detail_title2; ?>" class="form-control" name="fac_detail_title2" id="fac_detail_title2">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label">panel3</label>
                                            <div class="col-md-10">
                                                <input type="text" value="<?php echo $fac_title3; ?>" class="form-control" name="fac_title3" id="fac_title3">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label">รายละเอียด panel3</label>
                                            <div class="col-md-10">
                                                <input type="text" value="<?php echo $fac_detail_title3; ?>" class="form-control" name="fac_detail_title3" id="fac_detail_title3">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-2 control-label">ลิงค์กองทุน</label>
                                            <div class="col-md-10">
                                                <input type="text" value="<?php echo $fac_link; ?>" class="form-control" name="fac_link" id="fac_link">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                           <label class="col-md-2 control-label"></label>
                                           <div class="col-md-10">
                                               <button type="submit" class="btn btn-primary" name="sumitFacUpdate"onclick="return CheckValue();" >Update</button>
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


           </div>
       </div>






       <script src="../js/DropdownHover.js"></script>
       <script src="../js/app.js"></script>
   </body>
   <?php } ?>

   </html>
