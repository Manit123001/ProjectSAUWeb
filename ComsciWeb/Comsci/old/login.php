<?php
    error_reporting(0);
    session_start();
    include ('module/connectDB.php');
    include ('module/function.php');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
	<meta name="description" content="สาขาวิทยาการคอมพิวเตอร์ มหาวิทยาลัยเอเชียอาคเนย์ มุ่งเน้นนักศึกษามีคความรุ้คู่คุณธรรมด้านคอมพิวเตอร์และไอที">
	<meta name="keywords" content="วิทยาการคอมพิวเตอร์, สาขาวิทยาการคอมพิวเตอร์, คอมพิวเตอร์, ไอที, มหาวิทยาลัยเอเชียอาคเนย์, computer science	">

	<meta name="viewport" content="width = device-width, initial-scale=1">
	<title>Comsci Login</title>


    <script type="text/javascript" src="./js/jquery.js"></script>
    <script type="text/javascript" src="./js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
    <!-- custom -->
    <!-- <link rel="stylesheet" href="css/style.css"> -->
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/vendors.css">
    <link rel="stylesheet" href="fonts/font-awesome/font-awesome-4.6.2/css/font-awesome.min.css">


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
    </script>

</head>

<?php
    if($_SESSION['login_id']!= null){
        header('Location:houseback/member.php');
        exit();
    }
?>
<body class="paper-back-full">


<div class="paper-back-full" >
    <div class="login-form-full">
        <div class="fix-box">
            <div class="text-center title-logo animated fadeInDown "><a href="index.php"><img src="images/science.png" alt="" style="max-width: 100%;"></a></div>

            <div class="transparent-div no-padding ">
                <ul class="nav nav-tabs nav-tabs-transparent">
                  <li class="active"><a data-toggle="tab" href="#home">Login</a></li>
<!--                   <li class=""><a data-toggle="tab" href="#home">Login</a></li>
 -->
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                      <div id="home" class="tab-pane active">

                        <form role="form" action="houseback/member.php?Act=Login" method="post">
                            <div class="form-group">
                                <div class="input-group ">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" placeholder="Username" class="form-control" name="UsernameLogin" id="UsernameLogin" autofocus>
                                </div>
                                <br>
                                <div class="input-group ">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    <input type="password" placeholder="Password" class="form-control" name="PasswordLogin" id="PasswordLogin">
                                </div>

                                <br>

                                <button class="btn btn-ar btn-primary pull-right" type="submit" name="submitlogin" id="submitlogin" onclick="return CheckUserLogin();">Login</button>
                                <div class="clearfix"></div>
                            </div>
                        </form>
                      </div>

                </div>
            </div>
        </div>
    </div>
</div>





<script src="js/DropdownHover.js"></script>
</body>
</html>
