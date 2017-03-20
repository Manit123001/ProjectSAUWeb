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
    <title>backGuarantee</title>

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
        case 'UpdateGuarantee':
                    $id = $_GET['id'];
                    $guarantee_title = $_POST['guarantee_title'];
                    $guarantee_text = $_POST['guarantee_text'];

                    $Update = Update("tbguarantee", "
                        guarantee_title='".$guarantee_title."',
                        guarantee_text='".trim($guarantee_text)."' WHERE id = '".$id."'");

                        header('Location: housebackGuarantee.php');
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
        <h1 align="center">Guarantee</h1>



      <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Guarantee
                </div>

                <div class="panel-body">
                    <?php
                    $res = Select("tbguarantee", "where id = 1" );
                    while ($row = mysql_fetch_array($res))
                    {
                        $id = $row['id'];
                        $guarantee_title = $row['guarantee_title'];
                        $guarantee_text = $row['guarantee_text'];

                        ?>
                        <form action="?Act=UpdateGuarantee&id=<?=$id;?>" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                            <div class="col-md-11">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">ชื่อเรื่อง</label>

                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="guarantee_title" id="guarantee_title" value="<?php echo $guarantee_title; ?>">
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">เนื้อหา</label>
                                    <div class="col-md-10">
                                        <textarea class="form-control" rows="5"  name="guarantee_text" id="guarantee_text" placeholder="Entry Text" style="min-height:500px;">

                                        <?php echo $guarantee_text; ?>

                                        </textarea>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-md-2 control-label"></label>
                                    <div class="col-md-10">
                                         <button type="submit" class="btn btn-primary" name="sumitGuarantee"onclick="return CheckValue();">Update</button>
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
