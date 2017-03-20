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
    <title>Member</title>

    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>

    <!-- custom -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/vendors.css">

    <link rel="stylesheet" href="../fonts/font-awesome/font-awesome-4.6.2/css/font-awesome.min.css">
</head>

<script language="javascript">
    function CheckUserLogin(){
        if(document.getElementById('UsernameLogin').value == ""){
            alert('กรุณากรอก Username ของท่าน');
            document.getElementById('UsernameLogin').focus();
            return false;
        }
        if(document.getElementById('PasswordLogin').value == ""){
            alert('กรุณากรอก Password ของท่าน');
            document.getElementById('PasswordLogin').focus();
            return false;
        }
    }
</script>

<body>
<!-- sql injection -->
<?php
    foreach ($_GET as $key => $value) {

    $_GET[$key]=addslashes(strip_tags(trim($value)));
    }
    if ($_GET['Login'] !='') {
        $_GET['Login']=(int) $_GET['Login'];
    }
    extract($_GET); // http://www.palthai.com/articles_view.php?id=17 อ้างอิง
?>

<?php
    $Act=$_GET['Act'];
    switch($Act){
        case 'Login' :
                        $UsernameLogin = addslashes(trim($_POST['UsernameLogin']));
                        $PasswordLogin = addslashes(trim($_POST['PasswordLogin']));

                        $SelectUserLogin = Select("member_login","WHERE login_Username='".$UsernameLogin."' AND login_Password='".$PasswordLogin."'");
                        $Num_Rows_Login = Num_Rows($SelectUserLogin);
                        if($Num_Rows_Login == 1){
                            $Member = mysql_fetch_array($SelectUserLogin);
                            $_SESSION['login_id'] = $Member['id'];
                            $_SESSION['login_username'] = $Member['login_username'];
                            $_SESSION['login_fname'] = $Member['login_fname'];
                            $_SESSION['login_lname'] = $Member['login_lname'];
                            $_SESSION['login_type'] = $Member['login_type'];
                            $_SESSION['login_tel'] = $Member['login_tel'];

                            header('Location: member.php');
                            exit;

                        }else{
                            echo "<script language=\"javascript\">";
                            echo "alert('Username Password ไม่ถูกต้อง');";
                            echo "</script>";
                        }
    break;
    case 'Logout' :
                    session_destroy();
                    echo "<script language=\"javascript\">";
                    echo "alert('คุณได้ออกจากระบบเรียบร้อยแล้ว');";
                    echo "window.location='../index.php';";
                    echo "</script>";
    break;

    case 'AddUser' :
                    $login_fname = $_POST['login_fname'];
                    $login_lname = $_POST['login_lname'];
                    $login_tel = $_POST['login_tel'];
                    $login_username = $_POST['login_username'];
                    $login_password = $_POST['login_password'];


                    $Check = Select("member_login","WHERE login_username='".$login_username."'");
                    $Num_Rows=Num_Rows($Check);

                    if($Num_Rows == 0){
                        $InsertReply = Insert("member_login", "login_fname, login_lname, login_tel, login_username, login_password",
                        "'".$login_fname."','".$login_lname."','".$login_tel."','".$login_username."', '".$login_password."'");

                        header('Location: member.php');
                        exit;
                    }else{
                        echo "<script language=\"javascript\">";
                        echo "alert('  Username ".$login_username." มีอยู่แล้ว');";
                        echo "window.location='member.php';";
                        echo "</script>";
                    }

        break;

    case 'DelUser' :
                    $login_id = $_GET['login_id'];
                    Delete("member_login","WHERE id = '".$login_id."'");

                    header('Location: member.php');
                    exit;


        break;

    case 'UpdataUser':
                    $login_id = $_GET['login_id'];
                    $login_fname = $_POST['login_fname'];
                    $login_lname = $_POST['login_lname'];
                    $login_tel = $_POST['login_tel'];
                    $login_username = $_POST['login_username'];
                    $login_password = $_POST['login_password'];

                    $Update = Update("member_login", "login_fname='".$login_fname."',login_lname='".$login_lname."',
                        login_tel='".$login_tel."',login_username='".$login_username."',login_password='".$login_password."' WHERE id = '".$login_id."'");

                        header('Location: member.php');
                        exit;
        break;
    }
    ?>

    <?php if ($_SESSION['login_id'] != "") {?>

    <!-- Navbar and Header -->
    <?php
        include ('header.php');
    ?>

    <div class="container-fluid" style="margin-top:20px;" >
        <?php
        // aside Menu
            include ('admin.php');
        ?>

        <div class="col-md-10" >
            <!-- info -->
              <h1 align="center">Member</h1>
              <?php
              $res = Select("member_login", "" );

              $login_type = $_SESSION['login_type'];


              if($login_type != "admin" ){
                ?>
                <div class="row">
                    <div class="col-md-6 nopadding">
                        <div class="row">
                            <div class="col-md-12">
                              <div class="panel panel-success">
                                  <div class="panel-heading"> General Information</div>
                                  <table  class="table table-hover">
                                      <tbody>
                                          <tr>
                                              <td>Name : </td>
                                              <td><?php echo $_SESSION['login_fname'].' '. $_SESSION['login_lname'];?></td>
                                          </tr>
                                          <tr>
                                              <td>Username : </td>
                                              <td><?php echo $_SESSION['login_username']; ?></td>
                                          </tr>

                                          <tr>
                                              <td>Website : </td>
                                              <td><?php echo $_SESSION['login_tel']; ?></td>
                                          </tr>
                                          <tr>
                                              <td><button class="btn btn-danger" type="button"
                                              onclick="window.location='?Act=Logout'"> Log Out </button></td>
                                              <td></td>

                                          </tr>
                                      </tbody>
                                  </table>
                              </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /row -->
                <?php
              }else{
                ?>
                <div class="row">
                    <div class="col-md-6 nopadding">
                        <div class="row">
                            <div class="col-md-12">
                              <div class="panel panel-success">
                                  <div class="panel-heading"> General Information</div>
                                  <table  class="table table-hover">
                                      <tbody>
                                          <tr>
                                              <td>Name : </td>
                                              <td><?php echo $_SESSION['login_fname'].'  '. $_SESSION['login_lname'];?></td>

                                          </tr>
                                          <tr>
                                              <td>Username : </td>
                                              <td><?php echo $_SESSION['login_username']; ?></td>
                                          </tr>

                                          <tr>
                                              <td>Tel : </td>
                                              <td><?php echo $_SESSION['login_tel']; ?></td>
                                          </tr>
                                          <tr>
                                              <td><button class="btn btn-danger" type="button"
                                              onclick="window.location='?Act=Logout'"> Log Out </button></td>
                                              <td></td>

                                          </tr>
                                      </tbody>
                                  </table>
                              </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /row -->
                <!-- admin -->
                <div class="row">
                      <!-- Add user -->
                  <div class="col-md-12 no-padding">
                    <div class="col-md-6">
                      <div class="panel panel-default">
                          <div class="panel-heading">เพิ่มผู้ใช้</div>
                          <div class="panel-body">
                                <form action="?Act=AddUser" method ="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <input type="text" class=" " name="login_fname" id="login_fname" placeholder="First Name">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class=" " name="login_lname" id="login_lname" placeholder="Surname">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <input type="text" class=" " name="login_tel" id="login_tel" placeholder="Mobile">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <input type="text" class=" " name="login_username" id="login_username" placeholder="Username">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <input type="password" class=" " name="login_password" id="login_password" placeholder="Password">
                                        </div>
                                    </div>

                                     <div class="form-group">
                                        <div class="col-md-12">
                                            <input type="password" class=" " name="repass" id="repass" placeholder="Re-Password">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                         <label class="col-md-3 control-label"></label>
                                        <div class="col-md-12">
                                             <button type="submit" class="btn btn-success" name="sumitabout" onclick="return CheckValue();">Add User</button>
                                        </div>
                                    </div>
                                </form>
                            </div><!-- /panel-body -->
                      </div>
                    </div>

                    <!-- table user -->
                    <div class="col-md-12 ">

                      <div class="panel panel-default">
                        <div class="panel-heading">จัดการผู้ใช้</div>

                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>ชื่อ</th>
                                            <th>สกุล</th>
                                            <th>เบอร์โทร</th>
                                            <th>Username</th>
                                            <th>Password</th>
                                            <th>Manage</th>
                                        </tr>
                                    </thead>

                                    <tbody>


                                        <?php
                                        $res = Select("member_login", "" );
                                        while ($row = mysql_fetch_array($res))
                                        {
                                            $id = $row['id'];
                                            $login_fname = $row['login_fname'];
                                            $login_lname = $row['login_lname'];
                                            $login_username = $row['login_username'];
                                            $login_password = $row['login_password'];
                                            $login_tel = $row['login_tel'];
                                            if($id == '1'){

                                              ?>
                                              <form action="?Act=UpdataUser&login_id=<?=$id;?>" method="post" role="form" enctype="multipart/form-data">
                                                  <tr>
                                                      <td><?php echo $id; ?></td>
                                                      <td><input type="text" class="two" name="login_fname"  value="<?php echo $login_fname; ?>"></td>
                                                      <td><input type="text" class="two" name="login_lname" value="<?php echo $login_lname; ?>"></td>
                                                      <td><input type="text" class="two" name="login_tel" value="<?php echo $login_tel; ?>"></td>
                                                      <td><input type="text" class="two" name="login_username"
                                                        readonly="true" ondblclick="this.readOnly='';" value="<?php echo $login_username; ?>">
                                                      </td>
                                                      <td><input type="text" class="two" name="login_password"
                                                        readonly="true"  value="<?php echo $login_password; ?>">
                                                      </td>

                                                      <td>
                                                          <button type="submit" class="btn btn-info" style="width:100%;" name="updateUser">U</button>
                                                      </td>
                                                  </tr>
                                              </form>
                                              <?php

                                            }else{
                                              ?>
                                              <form action="?Act=UpdataUser&login_id=<?=$id;?>" method="post" role="form" enctype="multipart/form-data">
                                                <tr>
                                                  <td><?php echo $id; ?></td>
                                                  <td><input type="text" class="two" name="login_fname" value="<?php echo $login_fname; ?>"></td>
                                                  <td><input type="text" class="two" name="login_lname" value="<?php echo $login_lname; ?>"></td>
                                                  <td><input type="text" class="two" name="login_tel" value="<?php echo $login_tel; ?>"></td>
                                                  <td><input type="text" class="two" name="login_username"
                                                    readonly="true" ondblclick="this.readOnly='';" value="<?php echo $login_username; ?>">
                                                  </td>
                                                  <td><input type="text" class="two" name="login_password"
                                                    readonly="true" ondblclick="this.readOnly='';" value="<?php echo $login_password; ?>">
                                                  </td>
                                                  <td>
                                                    <a href="JavaScript:if(confirm('Confirm Delete?')==true){ window.location='?Act=DelUser&login_id=<?=$id?>';}" class="btn btn-danger" name="btnDelete">D</a>

                                                    <button type="submit" class="btn btn-info" name="updateUser">U</button>
                                                  </td>
                                                </tr>
                                              </form>
                                              <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div><!-- /row -->

                <!--เพิ่มผู้ใช้-->


                <?php
              }
             ?>


        </div><!--end col-md-10-->
    </div><!--end container fluid-->

    <?php
    }else if($_SESSION['login_id'] == "") {

        echo "<script language=\"javascript\">";
        echo "window.location='../login.php';";
        echo "</script>";

    }
?>

<script src="../js/DropdownHover.js"></script>
<script src="../js/app.js"></script>

</body>
</html>
