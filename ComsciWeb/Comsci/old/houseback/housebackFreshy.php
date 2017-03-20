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
    <title>backFreshy</title>

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

    if(document.getElementById('news_title').value == ""){
        alert('ป้อนหัวเรื่อง');
        document.getElementById('news_title').focus();
        return false;
    }

    if(document.getElementById('news_text').value == ""){
        alert('ป้อนรายละเอียด');
        document.getElementById('news_text').focus();
        return false;
    }


     if(document.getElementById('news_date').value == ""){
        alert('ป้อนรายละเอียด');
        document.getElementById('news_date').focus();
        return false;
    }

    if(document.getElementById('news_img').value == ""){
        alert('เพิ่มรูป');
        document.getElementById('news_img').focus();
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
        case 'AddFreshy' :

                    $freshy_title = $_POST['freshy_title'];
                    $freshy_text = $_POST['freshy_text'];

                    $Check = Select("tbfreshy","WHERE freshy_title='".$freshy_title."'");
                    $Num_Rows = Num_Rows($Check);

                    if($Num_Rows == 0){
                        // move_uploaded_file($pt_img_tmp, $filePath);

                        $InsertReply = Insert("tbfreshy", "freshy_title, freshy_text",
                            "'".$freshy_title."','".$freshy_text."'");

                            header('Location: housebackfreshy.php');
                            exit;
                    }else{
                                echo "<script language=\"javascript\">";
                                echo "alert('ชื่อเรื่องนี้ : ".$freshy_title." มีอยู่ในระบบแล้ว');";
                                echo "window.location='housebackfreshy.php';";
                                echo "</script>";
                    }
        break;




        case 'UpdateFreshy':
              $id = $_GET['id'];
              $freshy_title = $_POST['freshy_title'];
              $freshy_text = $_POST['freshy_text'];


                $Update = Update("tbfreshy", "
                freshy_title='".$freshy_title."',
                freshy_text='".$freshy_text."' WHERE id = '".$id."'");

                  header('Location: housebackfreshy.php');
                  exit;

        break;

        case 'DelFreshy' :
            $id = $_GET['id'];
            Delete("tbfreshy","WHERE id = '".$id."'");

            header('Location: housebackfreshy.php');
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
            <h1 align="center">Freshy</h1>

            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Freshy
                    </div>
                    <div class="panel-body">
                        <div class="col-md-12">

                            <form action="?Act=AddFreshy" method ="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-md-1 control-label">ชื่อเรื่อง</label>

                                    <div class="col-md-12">
                                        <input type="text" class="form-control" name="freshy_title" id="freshy_title">
                                    </div>

                                 </div>

                                <div class="form-group">
                                    <label class="col-md-1 control-label">เนื้อหา</label>
                                    <div class="col-md-12">
                                        <textarea class="form-control" rows="15"  name="freshy_text" id="freshy_text"></textarea>
                                    </div>
                                </div>


                                <div class="form-group">

                                    <div class="col-md-1">
                                         <button type="submit" class="btn btn-success" name="sumitFreshy" onclick="return CheckValue();">Add</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        </div>

                        <div class="col-md-12">
                            <div class="table-responsive" style="max-height:600px;">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>ชื่อเรื่อง</th>
                                            <th>รายละเอียด</th>

                                            <th>จัดการ</th>

                                        </tr>
                                    </thead>

                                    <tbody>


                                        <?php
                                            $i = 1;
                                            $res = Select("tbfreshy", "order by id asc" );
                                            while ($row = mysql_fetch_array($res))
                                            {
                                                    $id = $row['id'];
                                                    $freshy_title = $row['freshy_title'];
                                                    $freshy_text = $row['freshy_text'];
                                                ?>
                                                <form  action="?Act=UpdateFreshy&id=<?=$id;?>"  method ="post" role="form" enctype="multipart/form-data" >
                                                    <tr>
                                                        <td class="hidden"><?php echo $id; ?></td>
                                                        <td> <?php echo $i; ?></td>
                                                        <td><input type="text" name="freshy_title" value="<?php echo $freshy_title; ?>"></td>
                                                        <td ><textarea style="min-width: 200px;" class="form-control" rows="5" cols="10" name="freshy_text"  value="">
                                                          <?php echo $freshy_text; ?></textarea></td>


                                                        <td>
                                                            <a href="JavaScript:if(confirm('Confirm Delete?')==true){window.location='?Act=DelFreshy&id=<?= $id;?>';}" class="btn btn-danger" name="btnDelete">D</a>

                                                            <button type="submit" class="btn btn-primary" name="sumitFreshy" >U</button>
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
