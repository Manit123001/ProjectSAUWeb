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
    <title>backSuccess</title>

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
        case 'AddFancy' :

                    for($i=0;$i<count($_FILES['photo']['name']);$i++)
                    	{
                    		if($_FILES["photo"]["name"][$i] != "")
                    		{
                          $filePath = "../images/home/promote/".$_FILES["photo"]["name"][$i];

                    			if(move_uploaded_file($_FILES["photo"]["tmp_name"][$i], $filePath))
                    			{

                            $InsertReply = Insert("tbpromote", "fancy_img",
                                "'".$_FILES['photo']['name'][$i]."'");
                    			}
                    		}
                    	}

                      header('Location: housebackPromote.php');
                      exit;


        break;


        case 'UpdatePromote':
              $id = $_GET['id'];

              $fancy_img_tmp = $_FILES['fancy_img']['tmp_name'];
              $fancy_img_name = $_FILES['fancy_img']['name'];
              $fancy_img_type = $_FILES['fancy_img']['type'];

              if($fancy_img_name != ''){
                  $filePath = "../images/home/promote/".$fancy_img_name;
                  $res = Select("tbpromote", "where id = '".$id."'" );

                  while ($row = mysql_fetch_array($res))
                  {
                      $fancy_img = $row['fancy_img'];
                      if($fancy_img){
                          unlink("../images/home/promote/$fancy_img");
                      }
                  }
                  move_uploaded_file($fancy_img_tmp, $filePath);
                  $Update = Update("tbpromote", "
                      fancy_img='".$fancy_img_name."' WHERE id = '".$id."'");

                  header('Location: housebackPromote.php');
                  exit;
              }else{

                  header('Location: housebackPromote.php');
                  exit;
              }
        break;

        case 'DelPromote' :
                    $Img_file = $_GET['Img_file'];
                    $id = $_GET['id'];
                    Delete("tbpromote","WHERE id = '".$id."'");

                    if($Img_file){
                        unlink("../images/home/promote/$Img_file");
                    }
                    header('Location: housebackPromote.php');
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
        <h1 align="center">backPromote</h1>

        <!--project-->
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    promote
                </div>
                <div class="panel-body">
                        <!--1 left-->
                    <div class="col-md-6">
                        <form action="?Act=AddFancy" method ="post" class="form-horizontal" role="form" enctype="multipart/form-data">



                            <div class="form-group">
                                <label class="col-md-3 control-label">รูปภาพ</label>
                                <div class="col-md-9">
                                    <input type="file" class="form-control" name="photo[]" multiple accept=".png, .jpg, .jpeg"/>

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
                        <div  class="scrollspy-example" style="min-height:600px;">
                            <div class="table-responsive" >
                                <table class="table table-bordered" >
                                    <thead>
                                        <tr>
                                            <th>ID</th>

                                            <th>ภาพ</th>
                                            <th>จัดการ</th>
                                        </tr>
                                    </thead>

                                    <tbody >
                                        <?php
                                        $i = 1;
                                        $res = Select("tbpromote", "order by id asc" );
                                        while ($row = mysql_fetch_array($res))
                                        {
                                            $id = $row['id'];
                                            $fancy_img = $row['fancy_img'];

                                            ?>
                                            <form  action="?Act=UpdatePromote&id=<?= $id;?>"  method ="post" role="form" enctype="multipart/form-data" >
                                                <tr>
                                                    <td class="hidden"><?php echo $id; ?></td>
                                                    <td><?php echo $i; ?></td>
                                                    <!-- <td><input type="checkbox" name="name" value=""></td> -->


                                                    <td class="hidden"><input type="text" class="form-control" name="success_img" value="<?php echo $success_img; ?>"></td>

                                                    <td class="two">
                                                        <div class="col-md-12 no-padding " align="center">
                                                            <input type="file" name="fancy_img">
                                                        </div><!-- /col-md-6 -->
                                                        <div class="col-md-12 " align="center">

                                                            <img style="max-width: 160px; max-height: 100px;"
                                                            src="<?php echo "../images/home/promote/".$fancy_img; ?>"
                                                            class="img-responsive">
                                                        </div><!-- /col-md-6 -->
                                                    </td>
                                                    <td>
                                                        <div class="" align="center">
                                                            <a href="JavaScript:if(confirm('Confirm Delete?')==true){window.location='?Act=DelPromote&id=<?=$id;?>&Img_file=<?=$fancy_img;?>';}" class="btn btn-danger" name="btnDelete">D</a>

                                                            <button type="submit" class="btn btn-info " name="sumitUpdateSuccess" >U</button>

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
