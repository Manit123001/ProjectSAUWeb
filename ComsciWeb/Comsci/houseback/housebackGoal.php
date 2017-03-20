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
    <title>backGoal</title>

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
        case 'UpdateGoal':
                    $id = $_GET['id'];
                    $goal_title = $_POST['goal_title'];
                    $goal_text = $_POST['goal_text'];

                    $Update = Update("tbgoal", "
                        goal_title='".$goal_title."',
                        goal_text='".trim($goal_text)."' WHERE id = '".$id."'");

                        header('Location: housebackGoal.php');
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
        <h1 align="center">จุดมุ่งหมาย</h1>



      <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    ประวัติความเป็นมา
                </div>

                <div class="panel-body">
                    <?php
                    $res = Select("tbgoal", "where id = 1" );
                    while ($row = mysql_fetch_array($res))
                    {
                        $id = $row['id'];
                        $goal_title = $row['goal_title'];
                        $goal_text = $row['goal_text'];

                        ?>
                        <form action="?Act=UpdateGoal&id=<?=$id;?>" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                            <div class="col-md-11">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">ชื่อเรื่อง</label>

                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="goal_title" id="goal_title" value="<?php echo $goal_title; ?>">
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">เนื้อหา</label>
                                    <div class="col-md-10">


                                        <textarea name="goal_text" id="goal_text" rows="30" cols="40"  placeholder="Entry Text"><?php echo $goal_text; ?></textarea>


                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-md-2 control-label"></label>
                                    <div class="col-md-10">
                                         <button type="submit" class="btn btn-primary" name="sumitGoal"onclick="return CheckValue();">Update</button>
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
