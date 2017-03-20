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
      <title>Contact</title>

      <link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
      <script type="text/javascript" src="./js/jquery.js"></script>
      <script type="text/javascript" src="./js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="css/style2.css">

      <!-- custom -->
      <link rel="stylesheet" href="css/style.css">
      <link rel="stylesheet" href="css/vendors.css">

      <link rel="stylesheet" href="fonts/font-awesome/font-awesome-4.6.2/css/font-awesome.min.css">

</head>
<body>
    <?php
    $Act = $_GET['Act'];
    switch($Act){
          case 'AddContact' :
                  $message_name = $_POST['message_name'];
                  $message_email = $_POST['message_email'];
                  $message_text = $_POST['message_text'];
                  $message_ip = $_SERVER['REMOTE_ADDR'];
                  $date =  date("d/m/Y") ;

                  $InsertReply = Insert("tbcontact", "message_name, message_email, message_text, message_date, message_ip",
                  "'".$message_name."', '".$message_email."', '".$message_text."', '".$date."', '".$message_ip."'");

                  if($InsertReply){

                  echo "<script language=\"javascript\">";
                  echo "alert('ส่งข้อมูลเรียบร้อย);";
                  echo "window.location='contact.php';";
                  echo "</script>";
                }
                  // header('Location: contact.php');
                  // exit;

          break;
    }
    ?>
    <?php
      //header nav
        include ('header.php');
    ?>
<header class="main-header">
    <div class="container">
        <h1 class="page-title">ติดต่อสาขา</h1>
    </div>
</header>


<div class="container margin-bottom">
    <div class="row">
        <div class="col-md-12">
            <h2 class="no-margin-top">ติดต่อสอบถาม </h2>
        </div>
        <div class="col-md-8">
            <section>
              <p>น้องๆมีคำถาม อะไรติดต่อมาทางนี้ได้เลยนะค่ะ ทางเราจะตอบกลับไปทางอีกเมล์ค่ะ</p>


                <form action="?Act=AddContact" method ="post"  role="form"  enctype="multipart/form-data">
                      <div class="form-group">
                          <label for="message_name">Name</label>
                          <input type="name" name="message_name" id="message_name" class="form-control" placeholder=" Name">
                      </div>
                      <div class="form-group">
                          <label for="message_email">Email address</label>
                          <input type="email" name="message_email" id="message_email" class="form-control" placeholder="Your Email address">
                      </div>
                      <div class="form-group">
                          <label for="message_text">Mesagge</label>
                          <textarea rows="8"name="message_text" id="message_text" class="form-control" placeholder=" Message"></textarea>
                      </div>

                      <div class="form-group">
                          <button type="submit" class="btn btn-success" name="sumitnews" onclick="return CheckValue();">Add</button>
                      </div>
                      <div class="clearfix"></div>
                </form>

            </section>
        </div>

        <div class="col-md-4">
            <section>
                <div class="panel panel-primary">
                    <div class="panel-heading"><i class="fa fa-envelope-o"></i> สาขาวิทยาการคอมพิวเตอร์</div>
                    <div class="panel-body">
                        <h4 class=" no-margin-top ">Contacts</h4>
                        <hr class="style-two">
                        <div>
                            <strong>มหาวิทยาลัยเอเชียอาคเนย์ &nbsp;</strong><br>
                            9/1 ถนนเพชรเกษม (ติดซอยเพชรเกษม 106) <br>เขตหนองแขม กรุงเทพ, 10160 <br>
                            <abbr title="Phone">Phone:</abbr> 02-807-4594<br>
                            Mail: comsci@sau.ac.th

                        </div>

                    </div>
                </div>
            </section>
        </div>
    </div>

    <hr class="style-two">

    <section>
        <div class="well well-sm">

            <iframe width="100%" height="350" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d407.43421661399486!2d100.35633720890262!3d13.706978695567397!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e29605ec28301b%3A0xfcbacf3bea3301e0!2z4Lih4Lir4Liy4Lin4Li04LiX4Lii4Liy4Lil4Lix4Lii4LmA4Lit4LmA4LiK4Li14Lii4Lit4Liy4LiE4LmA4LiZ4Lii4LmM!5e0!3m2!1sen!2sus!4v1466496706404" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
        </div>
    </section>
</div>

    <?php
      //footer
        include ('footer.php');
    ?>

    <script src="js/DropdownHover.js"></script>
    <script src="js/vandors.js"></script>
    <!-- <script src="js/workings.js"></script> -->
    <script src="js/app.js"></script>

</body>
</html>
