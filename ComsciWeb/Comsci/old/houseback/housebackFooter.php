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
    <title>backSectionbox</title>

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

    if(document.getElementById('history_title').value == ""){
        alert('ป้อนข้อมูล');
        document.getElementById('history_title').focus();
        return false;
    }
    if(document.getElementById('history_text').value == ""){
        alert('ป้อนข้อมูล');
        document.getElementById('history_text').focus();
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

    <!-- History -->
    <?php
    $Act = $_GET['Act'];

    switch($Act){
        case 'UpdateSectionBox':
                    $id = $_GET['id'];
                    $section_title = $_POST['section_title'];
                    $section_text = $_POST['section_text'];

                    $Update = Update("tbsection_box", "
                        section_title='".$section_title."',
                        section_text='".trim($section_text)."' WHERE id = '".$id."'");

                        header('Location: housebackFooter.php');
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
        <h1 align="center">Footer</h1>

      <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    ก่อน footer
                </div>

                <div class="panel-body">
                    <?php
                    $res = Select("tbsection_box", "where id = 1" );
                    while ($row = mysql_fetch_array($res))
                    {
                        $id = $row['id'];
                        $section_title = $row['section_title'];
                        $section_text = $row['section_text'];
												$section_link = $row['section_link'];
                        ?>
                        <form action="?Act=UpdateSectionBox&id=<?=$id;?>" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                            <div class="col-md-11">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">หัวเรื่อง</label>

                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="section_title" id="section_title" value="<?php echo $section_title; ?>">
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">เนื้อหา</label>
                                    <div class="col-md-10">


																					<textarea name="section_text"  id="section_text" rows="8" cols="40"><?php echo $section_text; ?></textarea>
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
            </div>
        </div> <!--End row-->

    </div><!--Col-md-10-->
</div><!--Container-fluid-->

<script src="../js/DropdownHover.js"></script>
<script src="../js/app.js"></script>

</body>
<?php } ?>
</html>
