<?php
    error_reporting(0);
    session_start();
    include ('../module/ConClass.php');
    include ('../module/connectDB.php');
    include ('../module/function.php');
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width = device-width, initial-scale=1">
    <title>backCourse</title>

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
        // image
        case 'UpdateCourseImg' :

                $id = $_GET['id'];
                $course_img_tmp = $_FILES['course_img']['tmp_name'];
                $course_img_name = $_FILES['course_img']['name'];
                $course_img_type = $_FILES['course_img']['type'];

                if($course_img_name != ''){
                    $filePath = "../images/course/".$course_img_name;
                    $res = Select("tbcourse", "where id = '1'" );

                    while ($row = mysql_fetch_array($res))
                    {
                        $course_img = $row['course_img'];
                        if($course_img){
                          unlink("../images/course/$course_img");
                        }
                    }
                    move_uploaded_file($course_img_tmp, $filePath);
                    $Update = Update("tbcourse",
                    "course_img='".$course_img_name."' WHERE id = '".$id."'");

                    header('Location: housebackCourse.php');
                    exit;
                }else{

                    header('Location: housebackCourse.php');
                    exit;
                }
        break;
        // tab1
        case 'UpdateCourse':

            if(isset($_POST['sumitCourseUpdate'])){
                $id = $_GET['id'];

                $course_title = $_POST['course_title'];
                $course_text = $_POST['course_text'];
                $Update = Update("tbcourse", "
                course_title='".$course_title."',
                course_text='".$course_text."' WHERE id = '".$id."'");

                header('Location: housebackCourse.php');
                exit;
            }

        break;

        // tab2
        // header
        case 'UpdateTitleTab2':
            if(isset($_POST['sumitCourseUpdateTitleTab2'])){
                $id = $_GET['id'];
                $course_title = $_POST['course_title'];

                $Update = Update("tbcourse",
                "course_title='".$course_title."' WHERE id = '".$id."'");

                header('Location: housebackCourse.php');
                exit;
            }
        break;

        // 1
        case 'UpdateGroup1':
            if(isset($_POST['sumitCourseUpdate'])){
                $id = $_GET['id'];
                $course_group1 = $_POST['course_group1'];

                $Update = Update("tbsubject_group",
                "typecourse='".$course_group1."' WHERE id = '".$id."'");

                header('Location: housebackCourse.php');
                exit;
            }
        break;



        case 'AddGroup1' :
                $subject_normal = $_POST['subject_normal'];
                $credits_normal = $_POST['credits_normal'];

                $Check = Select("tbsubject_group","WHERE subject_normal='".$subject_normal."'");
                $Num_Rows = Num_Rows($Check);

                if($Num_Rows == 0){

                    $InsertReply = Insert("tbsubject_group", "subject_normal, credits_normal",
                        "'".$subject_normal."','".$credits_normal."'");

                        header('Location: housebackCourse.php');
                        exit;
                }else{
                            echo "<script language=\"javascript\">";
                            echo "alert('ใส่ข้อมูลก่อน ครับ ');";
                            echo "window.location='housebackCourse.php';";
                            echo "</script>";
                }
        break;

        case 'UpdateSubjectGroup1':
            if(isset($_POST['submitUpdateSubjectGroup1'])){
                $id = $_GET['id'];
                $subject_normal = $_POST['subject_normal'];
                $credits_normal = $_POST['credits_normal'];

                $Update = Update("tbsubject_group", "
                    subject_normal='".$subject_normal."',
                    credits_normal='".$credits_normal."' WHERE id = '".$id."'");

                    header('Location: housebackCourse.php');
                    exit;
            }
        break;

        case 'DelGroup1' :
                    $id = $_GET['id'];
                    Delete("tbsubject_group","WHERE id = '".$id."'");

                    header('Location: housebackCourse.php');
                    exit;
        break;
        // sub 1
        case 'AddSubNormal1' :
                $humanities = $_POST['humanities'];
                $code_human = $_POST['code_human'];
                $credits_human = $_POST['credits_human'];

                $Check = Select("tbsubject_normal","WHERE humanities='".$humanities."'");
                $Num_Rows = Num_Rows($Check);

                if($Num_Rows == 0){

                    $InsertReply = Insert("tbsubject_normal", "humanities, code_human, credits_human",
                        "'".$humanities."','".$code_human."','".$credits_human."'");

                        header('Location: housebackCourse.php');
                        exit;
                }else{
                            echo "<script language=\"javascript\">";
                            echo "alert('ใส่ข้อมูลก่อน ครับ ');";
                            echo "window.location='housebackCourse.php';";
                            echo "</script>";
                }
        break;

        case 'UpdateSubNormal1':

            if(isset($_POST['submitUpdateSubNormal1'])){
                $id = $_GET['id'];
                $humanities = $_POST['humanities'];
                $code_human = $_POST['code_human'];
                $credits_human = $_POST['credits_human'];


                $Update = Update("tbsubject_normal", "
                    humanities='".$humanities."',
                    code_human='".$code_human."',
                    credits_human='".$credits_human."' WHERE id = '".$id."'");

                    header('Location: housebackCourse.php');
                    exit;
            }
        break;

        case 'DelSubNormal1' :
                $id = $_GET['id'];
                Delete("tbsubject_normal","WHERE id = '".$id."'");

                header('Location: housebackCourse.php');
                exit;
        break;


        // sub 2
        case 'AddSubSocial' :
                $social = $_POST['social'];
                $code_social  = $_POST['code_social'];
                $credits_social = $_POST['credits_social'];

                $Check = Select("tbsubject_normal","WHERE social='".$social."'");
                $Num_Rows = Num_Rows($Check);

                if($Num_Rows == 0){

                    $InsertReply = Insert("tbsubject_normal", "social, code_social, credits_social",
                        "'".$social."','".$code_social."','".$credits_social."'");

                        header('Location: housebackCourse.php');
                        exit;
                }else{
                            echo "<script language=\"javascript\">";
                            echo "alert('ใส่ข้อมูลก่อน ครับ ');";
                            echo "window.location='housebackCourse.php';";
                            echo "</script>";
                }
        break;

        case 'UpdateSubSocial':

            if(isset($_POST['submitUpdateSubSocial'])){
                $id = $_GET['id'];
                $social = $_POST['social'];
                $code_social  = $_POST['code_social'];
                $credits_social = $_POST['credits_social'];


                $Update = Update("tbsubject_normal", "
                    social='".$social."',
                    code_social='".$code_social."',
                    credits_social='".$credits_social."' WHERE id = '".$id."'");

                    header('Location: housebackCourse.php');
                    exit;
            }
        break;

        case 'DelSubSocial' :
                $id = $_GET['id'];
                Delete("tbsubject_normal","WHERE id = '".$id."'");
        break;

        // sub 3
        case 'AddSubLanguage' :
                $language = $_POST['language'];
                $code_language  = $_POST['code_language'];
                $credits_language = $_POST['credits_language'];

                $Check = Select("tbsubject_normal","WHERE language='".$language."'");
                $Num_Rows = Num_Rows($Check);

                if($Num_Rows == 0){

                    $InsertReply = Insert("tbsubject_normal", "language, code_language, credits_language",
                        "'".$language."','".$code_language."','".$credits_language."'");

                        header('Location: housebackCourse.php');
                        exit;
                }else{
                            echo "<script language=\"javascript\">";
                            echo "alert('ใส่ข้อมูลก่อน ครับ ');";
                            echo "window.location='housebackCourse.php';";
                            echo "</script>";
                }
        break;

        case 'UpdateSubLanguage':

            if(isset($_POST['submitUpdateSubLanguage'])){
                $id = $_GET['id'];
                $language = $_POST['language'];
                $code_language  = $_POST['code_language'];
                $credits_language = $_POST['credits_language'];


                $Update = Update("tbsubject_normal", "
                    language='".$language."',
                    code_language='".$code_language."',
                    credits_language='".$credits_language."' WHERE id = '".$id."'");

                    header('Location: housebackCourse.php');
                    exit;
            }
        break;

        case 'DelSubLanguage' :
                $id = $_GET['id'];
                Delete("tbsubject_normal","WHERE id = '".$id."'");
        break;

        // sub 4
        case 'AddSubScience' :
                $science = $_POST['science'];
                $code_science  = $_POST['code_science'];
                $credits_science = $_POST['credits_science'];

                $Check = Select("tbsubject_normal","WHERE science='".$science."'");
                $Num_Rows = Num_Rows($Check);

                if($Num_Rows == 0){

                    $InsertReply = Insert("tbsubject_normal", "science, code_science, credits_science",
                        "'".$science."','".$code_science."','".$credits_science."'");

                        header('Location: housebackCourse.php');
                        exit;
                }else{
                            echo "<script language=\"javascript\">";
                            echo "alert('ใส่ข้อมูลก่อน ครับ ');";
                            echo "window.location='housebackCourse.php';";
                            echo "</script>";
                }
        break;

        case 'UpdateSubScience':

            if(isset($_POST['submitUpdateSubScience'])){
                $id = $_GET['id'];
                $science = $_POST['science'];
                $code_science  = $_POST['code_science'];
                $credits_science = $_POST['credits_science'];


                $Update = Update("tbsubject_normal", "
                    science='".$science."',
                    code_science='".$code_science."',
                    credits_science='".$credits_science."' WHERE id = '".$id."'");

                    header('Location: housebackCourse.php');
                    exit;
            }
        break;

        case 'DelSubScience' :
                $id = $_GET['id'];
                Delete("tbsubject_normal","WHERE id = '".$id."'");

                header('Location: housebackCourse.php');
                exit;
        break;

        // sub 5
        case 'AddSubPhysical' :
                $physical = $_POST['physical'];
                $code_physical  = $_POST['code_physical'];
                $credits_physical = $_POST['credits_physical'];

                $Check = Select("tbsubject_normal","WHERE physical='".$physical."'");
                $Num_Rows = Num_Rows($Check);

                if($Num_Rows == 0){

                    $InsertReply = Insert("tbsubject_normal", "physical, code_physical, credits_physical",
                        "'".$physical."','".$code_physical."','".$credits_physical."'");

                        header('Location: housebackCourse.php');
                        exit;
                }else{
                            echo "<script language=\"javascript\">";
                            echo "alert('ใส่ข้อมูลก่อน ครับ ');";
                            echo "window.location='housebackCourse.php';";
                            echo "</script>";
                }
        break;

        case 'UpdateSubPhysical':

            if(isset($_POST['submitUpdateSubPhysical'])){
                $id = $_GET['id'];
                $physical = $_POST['physical'];
                $code_physical  = $_POST['code_physical'];
                $credits_physical = $_POST['credits_physical'];


                $Update = Update("tbsubject_normal", "
                    physical='".$physical."',
                    code_physical='".$code_physical."',
                    credits_physical='".$credits_physical."' WHERE id = '".$id."'");

                    header('Location: housebackCourse.php');
                    exit;
            }
        break;

        case 'DelSubPhysical' :
                $id = $_GET['id'];
                Delete("tbsubject_normal","WHERE id = '".$id."'");

                header('Location: housebackCourse.php');
                exit;

                header('Location: housebackCourse.php');
                exit;
        break;
        // end 1


        // 2
        case 'UpdateGroupSpecial2':
            if(isset($_POST['sumitCourseUpdate2'])){
                $id = $_GET['id'];
                $course_group2 = $_POST['course_group2'];

                $Update = Update("tbsubject_group",
                    "typecourse='".$course_group2."' WHERE id = '".$id."'");
            }
        break;

        case 'AddGroup2' :
                $subject_speci = $_POST['subject_speci'];
                $credits_speci = $_POST['credits_speci'];

                $Check = Select("tbsubject_group","WHERE subject_speci='".$subject_speci."'");
                $Num_Rows = Num_Rows($Check);

                if($Num_Rows == 0){

                    $InsertReply = Insert("tbsubject_group", "subject_speci, credits_speci",
                        "'".$subject_speci."','".$credits_speci."'");

                        header('Location: housebackCourse.php');
                        exit;
                }else{
                            echo "<script language=\"javascript\">";
                            echo "alert('ใส่ข้อมูลก่อน ครับ ');";
                            echo "window.location='housebackCourse.php';";
                            echo "</script>";
                }
        break;


        case 'UpdateSubjectGroup2':
            if(isset($_POST['submitUpdateSubjectGroup2'])){
                $id = $_GET['id'];
                $subject_speci = $_POST['subject_speci'];
                $credits_speci = $_POST['credits_speci'];


                $Update = Update("tbsubject_group", "
                    subject_speci='".$subject_speci."',
                    credits_speci='".$credits_speci."' WHERE id = '".$id."'");

                    header('Location: housebackCourse.php');
                    exit;
            }
        break;

        case 'DelGroup2' :
                    $id = $_GET['id'];
                    Delete("tbsubject_group","WHERE id = '".$id."'");
        break;

        // sub 1
        case 'AddSubBasic1' :
                $basic1 = $_POST['basic1'];
                $code_basic1 = $_POST['code_basic1'];
                $credits_basic1 = $_POST['credits_basic1'];

                $Check = Select("tbsubject_speci","WHERE basic1='".$basic1."'");
                $Num_Rows = Num_Rows($Check);

                if($Num_Rows == 0){

                    $InsertReply = Insert("tbsubject_speci", "basic1, code_basic1, credits_basic1",
                        "'".$basic1."','".$code_basic1."','".$credits_basic1."'");

                        header('Location: housebackCourse.php');
                        exit;
                }else{
                            echo "<script language=\"javascript\">";
                            echo "alert('ใส่ข้อมูลก่อน ครับ ');";
                            echo "window.location='housebackCourse.php';";
                            echo "</script>";
                }
        break;

        case 'UpdateSubBasic1':

            if(isset($_POST['submitUpdateSubBasic1'])){
                $id = $_GET['id'];
                $basic1 = $_POST['basic1'];
                $code_basic1 = $_POST['code_basic1'];
                $credits_basic1 = $_POST['credits_basic1'];


                $Update = Update("tbsubject_speci", "
                    basic1='".$basic1."',
                    code_basic1='".$code_basic1."',
                    credits_basic1='".$credits_basic1."' WHERE id = '".$id."'");

                    header('Location: housebackCourse.php');
                    exit;
            }
        break;

        case 'DelSubBasic1' :
                $id = $_GET['id'];
                Delete("tbsubject_speci","WHERE id = '".$id."'");

                header('Location: housebackCourse.php');
                exit;
        break;

        // sub 2
        case 'AddSubMajor' :
                $major = $_POST['major'];
                $code_major = $_POST['code_major'];
                $credits_major = $_POST['credits_major'];

                $Check = Select("tbsubject_speci","WHERE major='".$major."'");
                $Num_Rows = Num_Rows($Check);

                if($Num_Rows == 0){

                    $InsertReply = Insert("tbsubject_speci", "major, code_major, credits_major",
                        "'".$major."','".$code_major."','".$credits_major."'");

                        header('Location: housebackCourse.php');
                        exit;
                }else{
                            echo "<script language=\"javascript\">";
                            echo "alert('ใส่ข้อมูลก่อน ครับ ');";
                            echo "window.location='housebackCourse.php';";
                            echo "</script>";
                }
        break;

        case 'UpdateSubMajor':

            if(isset($_POST['submitUpdateSubMajor'])){
                $id = $_GET['id'];
                $major = $_POST['major'];
                $code_major = $_POST['code_major'];
                $credits_major = $_POST['credits_major'];


                $Update = Update("tbsubject_speci", "
                    major='".$major."',
                    code_major='".$code_major."',
                    credits_major='".$credits_major."' WHERE id = '".$id."'");

                    header('Location: housebackCourse.php');
                    exit;
            }
        break;

        case 'DelSubMajor' :
                $id = $_GET['id'];
                Delete("tbsubject_speci","WHERE id = '".$id."'");
        break;

        // sub 3
        case 'AddSubElective' :
                $elective = $_POST['elective'];
                $code_elective = $_POST['code_elective'];
                $credits_elective = $_POST['credits_elective'];

                $Check = Select("tbsubject_speci","WHERE elective='".$elective."'");
                $Num_Rows = Num_Rows($Check);

                if($Num_Rows == 0){

                    $InsertReply = Insert("tbsubject_speci", "elective, code_elective, credits_elective",
                        "'".$elective."','".$code_elective."','".$credits_elective."'");

                        header('Location: housebackCourse.php');
                        exit;
                }else{
                            echo "<script language=\"javascript\">";
                            echo "alert('ใส่ข้อมูลก่อน ครับ ');";
                            echo "window.location='housebackCourse.php';";
                            echo "</script>";
                }
        break;

        case 'UpdateSubbElective':

            if(isset($_POST['submitUpdateSubElective'])){
                $id = $_GET['id'];
                $elective = $_POST['elective'];
                $code_elective = $_POST['code_elective'];
                $credits_elective = $_POST['credits_elective'];


                $Update = Update("tbsubject_speci", "
                    elective='".$elective."',
                    code_elective='".$code_elective."',
                    credits_elective='".$credits_elective."' WHERE id = '".$id."'");

                    header('Location: housebackCourse.php');
                    exit;
            }
        break;

        case 'DelSubElective' :
                $id = $_GET['id'];
                Delete("tbsubject_speci","WHERE id = '".$id."'");

                header('Location: housebackCourse.php');
                exit;
        break;
        // encd 2



        // 3
        case 'UpdateGroupElective3':
            if(isset($_POST['sumitCourseUpdateGroupElective3'])){
                $id = $_GET['id'];
                $course_group3 = $_POST['course_group3'];

                $Update = Update("tbsubject_group",
                    "typecourse='".$course_group3."' WHERE id = '".$id."'");

                    header('Location: housebackCourse.php');
                    exit;
            }
        break;



        case 'AddGroup3' :
                $subject_choice = $_POST['subject_choice'];
                $credits_choice = $_POST['credits_choice'];

                $Check = Select("tbsubject_group","WHERE subject_choice='".$subject_choice."'");
                $Num_Rows = Num_Rows($Check);

                if($Num_Rows == 0){

                    $InsertReply = Insert("tbsubject_group", "subject_choice, credits_choice",
                        "'".$subject_choice."','".$credits_choice."'");

                        header('Location: housebackCourse.php');
                        exit;
                }else{
                            echo "<script language=\"javascript\">";
                            echo "alert('ใส่ข้อมูลก่อน ครับ ');";
                            echo "window.location='housebackCourse.php';";
                            echo "</script>";
                }
        break;

        case 'UpdateSubjectGroup3':
            if(isset($_POST['submitUpdateSubjectGroup3'])){
                $id = $_GET['id'];
                $subject_choice = $_POST['subject_choice'];
                $credits_choice = $_POST['credits_choice'];


                $Update = Update("tbsubject_group", "
                    subject_choice='".$subject_choice."',
                    credits_choice='".$credits_choice."' WHERE id = '".$id."'");

                    header('Location: housebackCourse.php');
                    exit;
            }
        break;

        case 'DelGroup3' :
                    $id = $_GET['id'];
                    Delete("tbsubject_group","WHERE id = '".$id."'");
        break;

        // sub 1
        case 'AddSubChoice' :
                $elective = $_POST['elective'];
                $code_elective = $_POST['code_elective'];
                $credits_elective = $_POST['credits_elective'];

                $Check = Select("tbsubject_choice","WHERE elective='".$elective."'");
                $Num_Rows = Num_Rows($Check);

                if($Num_Rows == 0){

                    $InsertReply = Insert("tbsubject_choice", "elective, code_elective, credits_elective",
                        "'".$elective."','".$code_elective."','".$credits_elective."'");

                        header('Location: housebackCourse.php');
                        exit;
                }else{
                            echo "<script language=\"javascript\">";
                            echo "alert('ใส่ข้อมูลก่อน ครับ ');";
                            echo "window.location='housebackCourse.php';";
                            echo "</script>";
                }
        break;

        case 'UpdateSubChoice':

            if(isset($_POST['submitUpdateSubChoice'])){
                $id = $_GET['id'];
                $elective = $_POST['elective'];
                $code_elective = $_POST['code_elective'];
                $credits_elective = $_POST['credits_elective'];


                $Update = Update("tbsubject_choice", "
                    elective='".$elective."',
                    code_elective='".$code_elective."',
                    credits_elective='".$credits_elective."' WHERE id = '".$id."'");

                    header('Location: housebackCourse.php');
                    exit;
            }
        break;

        case 'DelSubChoice' :
                $id = $_GET['id'];
                Delete("tbsubject_choice","WHERE id = '".$id."'");

                header('Location: housebackCourse.php');
                exit;
        break;

        // end 3


        // tab3
        case 'UpdateCourseTab3':

            if(isset($_POST['sumitCourseUpdateTab3'])){
                $id = $_GET['id'];

                $tab3_title = $_POST['tab3_title'];
                $tab3_text = $_POST['tab3_text'];
                $Update = Update("tbcourse", "
                    tab3_title='".$tab3_title."',
                    tab3_text='".$tab3_text."' WHERE id = '".$id."'");

                    header('Location: housebackCourse.php');
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
        <h1 align="center">Course</h1>

        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Course
                </div>

                <div class="panel-body">
                    <?php
                    $res = Select("tbcourse", "where id = 1" );
                    while ($row = mysql_fetch_array($res))
                    {
                        $id = $row['id'];
                        $course_title = $row['course_title'];
                        $course_text = $row['course_text'];
                        $course_img = $row['course_img'];

                        ?>
                        <form action="?Act=UpdateCourseImg&id=<?=$id;?>" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                            <div class="col-md-11">
                                <div class="form-group">
                                    <div class="col-md-6">

                                        <label class="col-md-2 control-label">ภาพ</label>

                                        <div class="col-md-8">
                                            <input type="file" class="form-control" name="course_img" id="course_img" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <img style="height:200px;" src="../images/course/<?php echo $course_img ?>" alt="" />
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label"></label>
                                    <div class="col-md-10">
                                         <button type="submit" class="btn btn-success" name="sumitCourseUpdateCourseImg"onclick="return CheckValue();">ChangeImage</button>
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

        <!--Tab1-->
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Tab1
                </div>

                <div class="panel-body">
                    <?php
                    $res = Select("tbcourse", "where id = 1" );
                    while ($row = mysql_fetch_array($res))
                    {
                        $id = $row['id'];
                        $course_title = $row['course_title'];
                        $course_text = $row['course_text'];
                        $course_img = $row['course_img'];

                        ?>
                        <form action="?Act=UpdateCourse&id=<?=$id;?>" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                            <div class="col-md-11">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">ชื่อเรื่อง</label>

                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="course_title" id="course_title1" value="<?php echo $course_title; ?>">
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">เนื้อหา</label>
                                    <div class="col-md-10">
                                        <textarea class="form-control" rows="5"  name="course_text" id="course_text1" placeholder="Entry Text" style="min-height:500px;">

                                        <?php echo trim($course_text); ?>

                                        </textarea>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-md-2 control-label"></label>
                                    <div class="col-md-10">
                                         <button type="submit" class="btn btn-primary" name="sumitCourseUpdate"onclick="return CheckValue();">Update</button>
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

        <!--Tab2-->
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Tab2
                </div>
                <!--header -->
                <div class="panel-body">
                    <?php
                    $res = Select("tbcourse", "where id = 2" );
                    while ($row = mysql_fetch_array($res))
                    {
                        $id = $row['id'];
                        $course_title = $row['course_title'];

                        ?>
                        <form action="?Act=UpdateTitleTab2&id=<?=$id;?>" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                            <div class="col-md-11">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">หัวเรื่อง</label>

                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="course_title" id="course_title" value="<?php echo $course_title; ?>">
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label"></label>
                                    <div class="col-md-10">
                                         <button type="submit" class="btn btn-primary" name="sumitCourseUpdateTitleTab2"onclick="return CheckValue();">Update</button>
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



        <!--1-->
        <div class="row">
            <div class="panel panel-default">


                <div class="panel-heading">
                    1
                </div>

                <div class="panel-body">
                    <!--Left list subject-->
                    <div class="col-md-6">
                        <?php
                        $db = new db();
                        $row = $db ->findByPk('tbsubject_group', 'id', 1)->executeRow();
                        if(!empty($row)){
                            $id = $row['id'];
                            $typecourse = $row['typecourse'];
                        }
                        ?>
                        <form action="?Act=UpdateGroup1&id=<?=$id;?>" method ="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="course_group1" id="course_group1" placeholder="หมวดวิชา"
                                        value="<?php echo $typecourse; ?>">
                                </div>
                                <div class="col-md-2 " >
                                    <button type="submit" class="btn btn-info " name="sumitCourseUpdate"onclick="return CheckValue();"  style="width:100%;"> U </button>
                                    <div class ="clearfix"></div>
                                </div>

                            </div>
                            <hr/>
                        </form>

                        <form action="?Act=AddGroup1" method ="post" class="form-horizontal" role="form" enctype="multipart/form-data">

                            <div class="form-group">
                                <div class="col-md-7">
                                    <input type="text" class="form-control" name="subject_normal" id="subject_normal1" placeholder="เพิ่มรายวิชา">
                                </div>
                                <div class="col-md-3 ">
                                    <input type="text" class="form-control" name="credits_normal" id="credits_normal1" placeholder="หน่วยกิจ">
                                </div>
                                <div class="col-md-2 ">
                                    <button type="submit"  class="btn btn-success" name="sumitAddGroup1" style="width:100%;"
                                        onclick="return CheckValue(); ">Add</button>

                                    <div class ="clearfix"></div>
                                </div>
                            </div>
                        </form>

                        <div class="col-md-12 no-padding" >
                            <div class="form-group" >
                                <div class="table-responsive ">
                                    <table class="table table-bordered" >
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>รายวิชา </th>
                                                <th>หน่วยกิจ</th>
                                                <th>รายละเอียด</th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                            <?php
                                            $res = Select("tbsubject_group", "where subject_normal != ''" );
                                            while ($row = mysql_fetch_array($res))
                                            {
                                                $id = $row['id'];
                                                $subject_normal = $row['subject_normal'];
                                                $credits_normal = $row['credits_normal'];

                                                ?>
                                                <form action="?Act=UpdateSubjectGroup1&id=<?=$id;?>" method ="post" role="form" enctype="multipart/form-data" >
                                                    <tr>
                                                        <td><?php echo $id; ?></td>
                                                        <td><input type="text" class="form-control" name="subject_normal" id="subject_normal"
                                                            placeholder="หมวดวิชา" value="<?php echo $subject_normal; ?>"></td>
                                                        <td><input type="text" class="form-control" name="credits_normal"
                                                            value="<?php echo $credits_normal; ?>"></td>
                                                        <td>
                                                            <div class="" align="center">
                                                                <div class="col-md-6 col-xs-6 no-padding">
                                                                    <a href="JavaScript:if(confirm('Confirm Delete?')==true){window.location=
                                                                        '?Act=DelGroup1&id=<?=$id;?>';}" class="btn btn-danger" name="btnDelete">D</a>
                                                                </div><!-- /col-md-6 -->

                                                                <div class="col-md-6 col-xs-6 no-padding">
                                                                    <button type="submit" class="btn btn-info" name="submitUpdateSubjectGroup1" >U</button>
                                                                </div><!-- /col-md-6 -->
                                                            </div><!-- /row -->
                                                        </td>
                                                    </tr>
                                                </form>
                                                <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div><!-- /row -->
                        </div><!-- /col-md-12 -->
                    </div><!-- /col-md-6 -->


                    <!--Right list subject-->
                    <div class="col-md-6" >
                        <div class="row">
                            <div  class="scrollspy-example" style="min-height:600px;">

                                <!--1-->
                                <div class="well">
                                    <?php
                                    $db = new db();

                                    //query data and show
                                    $row = $db ->findByPk('tbsubject_group', 'id', 1)->executeRow();
                                    if(!empty($row)){
                                        $subject_normal = $row['subject_normal'];
                                    }
                                    ?>
                                    <form action="?Act=UpdateGroup1" method ="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" name="login_fname" id="login_fname" placeholder="รายวิชา" disabled
                                                value="<?php echo $subject_normal;?>">
                                            </div>
                                        </div>
                                    </form>
                                    <form action="?Act=AddSubNormal1" method ="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="col-md-3 ">
                                                <input type="text" class="form-control " name="code_human" id="code_human" placeholder="รหัสวิชา">
                                            </div>
                                            <div class="col-md-4 ">
                                                <input type="text" class="form-control  " name="humanities" id="humanities" placeholder="ชื่อวิชา">
                                            </div>

                                            <div class="col-md-3 ">
                                                <input type="text" class="form-control" name="credits_human" id="credits_human" placeholder="หน่วยกิจ">
                                            </div>
                                            <div class="col-md-2 ">
                                                <button type="submit"  class="btn btn-success" name="AddSubNormal1" style="width:100%;"
                                                    onclick="return CheckValue(); ">Add</button>
                                                <div class ="clearfix"></div>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="col-md-12 no-padding" >
                                        <div class="form-group" >
                                            <div class="table-responsive ">
                                                <table class="table table-bordered" >
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>รหัสวิชา</th>
                                                            <th>ชื่อวิชา </th>
                                                            <th>หน่วยกิจ</th>
                                                            <th>จัดการ</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>

                                                        <?php


                                                        $res = Select("tbsubject_normal", "where humanities != ''" );
                                                        while ($row = mysql_fetch_array($res))
                                                        {
                                                            $id = $row['id'];
                                                            $code_human = $row['code_human'];
                                                            $humanities = $row['humanities'];
                                                            $credits_human = $row['credits_human'];

                                                            ?>
                                                            <form action="?Act=UpdateSubNormal1&id=<?=$id;?>" method ="post" role="form" enctype="multipart/form-data">
                                                                <tr>
                                                                    <td><?php echo $id; ?></td>
                                                                    <td><input type="text" class="form-control one" name="code_human" id="code_human"
                                                                        value="<?php echo $code_human; ?>"></td>
                                                                    <td><input type="text" class="form-control two" name="humanities" id="humanities"
                                                                        value="<?php echo $humanities; ?>"></td>
                                                                    <td><input type="text" class="form-control three" name="credits_human" id="credits_human"
                                                                        value="<?php echo $credits_human; ?>"></td>
                                                                    <td>
                                                                        <div class="" align="center">
                                                                            <div class="col-md-6 col-xs-6 no-padding">
                                                                                <a href="JavaScript:if(confirm('Confirm Delete?')==true){window.location='?Act=DelSubNormal1&id=<?= $id;?>';}" class="btn btn-danger" name="btnDelete">D</a>
                                                                            </div><!-- /col-md-6 -->

                                                                            <div class="col-md-6 col-xs-6 no-padding">
                                                                                <button type="submit" class="btn btn-info" name="submitUpdateSubNormal1" >U</button>
                                                                            </div><!-- /col-md-6 -->
                                                                        </div><!-- /row -->
                                                                    </td>
                                                                </tr>
                                                            </form>
                                                        <?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div><!-- form-group -->
                                    </div><!-- /col-md-12 -->
                                    <div class="clearfix"> </div>
                                </div><!-- /well -->

                                <!--2-->
                                <div class="well">
                                    <?php
                                    $db = new db();

                                    //query data and show
                                    $row = $db ->findByPk('tbsubject_group', 'id', 2)->executeRow();
                                    if(!empty($row)){
                                        $subject_normal = $row['subject_normal'];
                                    }
                                    ?>
                                    <form action="?Act=UpdateGroup2" method ="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" name="login_fname" id="login_fname" placeholder="รายวิชา" disabled
                                                value="<?php echo $subject_normal;?>">
                                            </div>
                                        </div>
                                    </form>

                                    <form action="?Act=AddSubSocial" method ="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="col-md-3 ">
                                                <input type="text" class="form-control " name="code_social" id="code_social" placeholder="รหัสวิชา">
                                            </div>
                                            <div class="col-md-4 ">
                                                <input type="text" class="form-control  " name="social" id="social" placeholder="ชื่อวิชา">
                                            </div>
                                            <div class="col-md-3 ">
                                                <input type="text" class="form-control" name="credits_social" id="credits_social" placeholder="หน่วยกิจ">
                                            </div>
                                            <div class="col-md-2 ">
                                                <button type="submit"  class="btn btn-success" name="btnAddSubSocial" style="width:100%;"
                                                    onclick="return CheckValue(); ">Add</button>
                                                <div class ="clearfix"></div>
                                            </div>
                                        </div>
                                    </form>

                                    <div class="col-md-12 no-padding" >
                                        <div class="form-group" >
                                            <div class="table-responsive ">
                                                <table class="table table-bordered" >
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>รหัสวิชา</th>
                                                            <th>ชื่อวิชา </th>
                                                            <th>หน่วยกิจ</th>
                                                            <th>จัดการ</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>

                                                        <?php


                                                        $res = Select("tbsubject_normal", "where social != ''" );
                                                        while ($row = mysql_fetch_array($res))
                                                        {
                                                            $id = $row['id'];
                                                            $code_social = $row['code_social'];
                                                            $social = $row['social'];
                                                            $credits_social = $row['credits_social'];

                                                            ?>
                                                            <form action="?Act=UpdateSubSocial&id=<?=$id;?>" method ="post" role="form" enctype="multipart/form-data">
                                                                <tr>
                                                                    <td><?php echo $id; ?></td>
                                                                    <td><input type="text" class="form-control one" name="code_social" id="code_social"
                                                                        value="<?php echo $code_social; ?>"></td>
                                                                    <td><input type="text" class="form-control two" name="social" id="social"
                                                                        value="<?php echo $social; ?>"></td>
                                                                    <td><input type="text" class="form-control three" name="credits_social" id="credits_social"
                                                                        value="<?php echo $credits_social; ?>"></td>
                                                                    <td>
                                                                        <div class="" align="center">
                                                                            <div class="col-md-6 col-xs-6 no-padding">
                                                                                <a href="JavaScript:if(confirm('Confirm Delete?')==true){window.location='?Act=DelSubSocial&id=<?= $id;?>';}" class="btn btn-danger" name="btnDelete">D</a>
                                                                            </div><!-- /col-md-6 -->

                                                                            <div class="col-md-6 col-xs-6 no-padding">
                                                                                <button type="submit" class="btn btn-info" name="submitUpdateSubSocial" >U</button>
                                                                            </div><!-- /col-md-6 -->
                                                                        </div><!-- /row -->
                                                                    </td>
                                                                </tr>
                                                            </form>
                                                        <?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div><!-- form-group -->
                                    </div><!-- /col-md-12 -->
                                    <div class="clearfix"> </div>
                                </div><!-- /well -->

                                <!--3-->
                                <div class="well">
                                    <?php
                                    $db = new db();

                                    //query data and show
                                    $row = $db ->findByPk('tbsubject_group', 'id', 3)->executeRow();
                                    if(!empty($row)){
                                        $subject_normal = $row['subject_normal'];
                                    }
                                    ?>
                                    <form action="?Act=UpdateGroup3" method ="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" name="login_fname" id="login_fname" placeholder="รายวิชา" disabled
                                                value="<?php echo $subject_normal;?>">
                                            </div>
                                        </div>
                                    </form>
                                    <form action="?Act=AddSubLanguage" method ="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="col-md-3 ">
                                                <input type="text" class="form-control " name="code_language" id="code_language" placeholder="รหัสวิชา">
                                            </div>
                                            <div class="col-md-4 ">
                                                <input type="text" class="form-control  " name="language" id="language" placeholder="ชื่อวิชา">
                                            </div>

                                            <div class="col-md-3 ">
                                                <input type="text" class="form-control" name="credits_language" id="credits_language" placeholder="หน่วยกิจ">
                                            </div>
                                            <div class="col-md-2 ">
                                                <button type="submit"  class="btn btn-success" name="AddSubLanguage" style="width:100%;"
                                                    onclick="return CheckValue(); ">Add</button>
                                                <div class ="clearfix"></div>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="col-md-12 no-padding" >
                                        <div class="form-group" >
                                            <div class="table-responsive ">
                                                <table class="table table-bordered" >
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>รหัสวิชา</th>
                                                            <th>ชื่อวิชา </th>
                                                            <th>หน่วยกิจ</th>
                                                            <th>จัดการ</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>

                                                        <?php


                                                        $res = Select("tbsubject_normal", "where language != ''" );
                                                        while ($row = mysql_fetch_array($res))
                                                        {
                                                            $id = $row['id'];
                                                            $code_language = $row['code_language'];
                                                            $language = $row['language'];
                                                            $credits_language = $row['credits_language'];

                                                            ?>
                                                            <form action="?Act=UpdateSubLanguage&id=<?=$id;?>" method ="post" role="form" enctype="multipart/form-data">
                                                                <tr>
                                                                    <td><?php echo $id; ?></td>
                                                                    <td><input type="text" class="form-control one" name="code_language" id="code_language"
                                                                        value="<?php echo $code_language; ?>"></td>
                                                                    <td><input type="text" class="form-control two" name="language" id="language"
                                                                        value="<?php echo $language; ?>"></td>
                                                                    <td><input type="text" class="form-control three" name="credits_language" id="credits_language"
                                                                        value="<?php echo $credits_language; ?>"></td>
                                                                    <td>
                                                                        <div class="" align="center">
                                                                            <div class="col-md-6 col-xs-6 no-padding">
                                                                                <a href="JavaScript:if(confirm('Confirm Delete?')==true){window.location='?Act=DelSubLanguage&id=<?=$id;?>';}" class="btn btn-danger" name="btnDelete">D</a>
                                                                            </div><!-- /col-md-6 -->

                                                                            <div class="col-md-6 col-xs-6 no-padding">
                                                                                <button type="submit" class="btn btn-info" name="submitUpdateSubLanguage" >U</button>
                                                                            </div><!-- /col-md-6 -->
                                                                        </div><!-- /row -->
                                                                    </td>
                                                                </tr>
                                                            </form>
                                                        <?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div><!-- form-group -->
                                    </div><!-- /col-md-12 -->
                                    <div class="clearfix"> </div>
                                </div><!-- /well -->

                                <!--4-->
                                <div class="well">
                                    <?php
                                    $db = new db();

                                    //query data and show
                                    $row = $db ->findByPk('tbsubject_group', 'id', 4)->executeRow();
                                    if(!empty($row)){
                                        $subject_normal = $row['subject_normal'];
                                    }
                                    ?>
                                    <form action="?Act=UpdateGroup4" method ="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" name="login_fname" id="login_fname" placeholder="รายวิชา" disabled
                                                value="<?php echo $subject_normal;?>">
                                            </div>
                                        </div>
                                    </form>
                                    <form action="?Act=AddSubScience" method ="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="col-md-3 ">
                                                <input type="text" class="form-control " name="code_science" id="code_science" placeholder="รหัสวิชา">
                                            </div>
                                            <div class="col-md-4 ">
                                                <input type="text" class="form-control  " name="science" id="science" placeholder="ชื่อวิชา">
                                            </div>

                                            <div class="col-md-3 ">
                                                <input type="text" class="form-control" name="credits_science" id="credits_science" placeholder="หน่วยกิจ">
                                            </div>
                                            <div class="col-md-2 ">
                                                <button type="submit"  class="btn btn-success" name="AddSubScience" style="width:100%;"
                                                    onclick="return CheckValue(); ">Add</button>
                                                <div class ="clearfix"></div>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="col-md-12 no-padding" >
                                        <div class="form-group" >
                                            <div class="table-responsive ">
                                                <table class="table table-bordered" >
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>รหัสวิชา</th>
                                                            <th>ชื่อวิชา </th>
                                                            <th>หน่วยกิจ</th>
                                                            <th>จัดการ</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>

                                                        <?php


                                                        $res = Select("tbsubject_normal", "where science != ''" );
                                                        while ($row = mysql_fetch_array($res))
                                                        {
                                                            $id = $row['id'];
                                                            $code_science = $row['code_science'];
                                                            $science = $row['science'];
                                                            $credits_science = $row['credits_science'];

                                                            ?>
                                                            <form action="?Act=UpdateSubScience&id=<?=$id;?>" method ="post" role="form" enctype="multipart/form-data">
                                                                <tr>
                                                                    <td><?php echo $id; ?></td>
                                                                    <td><input type="text" class="form-control one" name="code_science" id="code_science"
                                                                        value="<?php echo $code_science; ?>"></td>
                                                                    <td><input type="text" class="form-control two" name="science" id="science"
                                                                        value="<?php echo $science; ?>"></td>
                                                                    <td><input type="text" class="form-control three" name="credits_science" id="credits_science"
                                                                        value="<?php echo $credits_science; ?>"></td>
                                                                    <td>
                                                                        <div class="" align="center">
                                                                            <div class="col-md-6 col-xs-6 no-padding">
                                                                                <a href="JavaScript:if(confirm('Confirm Delete?')==true){window.location='?Act=DelSubScience&id=<?=$id;?>';}" class="btn btn-danger" name="btnDelete">D</a>
                                                                            </div><!-- /col-md-6 -->

                                                                            <div class="col-md-6 col-xs-6 no-padding">
                                                                                <button type="submit" class="btn btn-info" name="submitUpdateSubScience" >U</button>
                                                                            </div><!-- /col-md-6 -->
                                                                        </div><!-- /row -->
                                                                    </td>
                                                                </tr>
                                                            </form>
                                                        <?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div><!-- form-group -->
                                    </div><!-- /col-md-12 -->
                                    <div class="clearfix"> </div>
                                </div><!-- /well -->

                                <!--5-->
                                <div class="well">
                                    <?php
                                    $db = new db();

                                    //query data and show
                                    $row = $db ->findByPk('tbsubject_group', 'id', 5)->executeRow();
                                    if(!empty($row)){
                                        $subject_normal = $row['subject_normal'];
                                    }
                                    ?>
                                    <form action="?Act=UpdateGroup1" method ="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" name="login_fname" id="login_fname" placeholder="รายวิชา" disabled
                                                value="<?php echo $subject_normal;?>">
                                            </div>
                                        </div>
                                    </form>
                                    <form action="?Act=AddSubPhysical" method ="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="col-md-3 ">
                                                <input type="text" class="form-control " name="code_physical" id="code_physical" placeholder="รหัสวิชา">
                                            </div>
                                            <div class="col-md-4 ">
                                                <input type="text" class="form-control  " name="physical" id="physical" placeholder="ชื่อวิชา">
                                            </div>

                                            <div class="col-md-3 ">
                                                <input type="text" class="form-control" name="credits_physical" id="credits_physical" placeholder="หน่วยกิจ">
                                            </div>
                                            <div class="col-md-2 ">
                                                <button type="submit"  class="btn btn-success" name="AddSubPhysical" style="width:100%;"
                                                    onclick="return CheckValue(); ">Add</button>
                                                <div class ="clearfix"></div>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="col-md-12 no-padding" >
                                        <div class="form-group" >
                                            <div class="table-responsive ">
                                                <table class="table table-bordered" >
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>รหัสวิชา</th>
                                                            <th>ชื่อวิชา </th>
                                                            <th>หน่วยกิจ</th>
                                                            <th>จัดการ</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>

                                                        <?php


                                                        $res = Select("tbsubject_normal", "where physical != ''" );
                                                        while ($row = mysql_fetch_array($res))
                                                        {
                                                            $id = $row['id'];
                                                            $code_physical = $row['code_physical'];
                                                            $physical = $row['physical'];
                                                            $credits_physical = $row['credits_physical'];

                                                            ?>
                                                            <form action="?Act=UpdateSubPhysical&id=<?=$id;?>" method ="post" role="form" enctype="multipart/form-data">
                                                                <tr>
                                                                    <td><?php echo $id; ?></td>
                                                                    <td><input type="text" class="form-control one" name="code_physical" id="code_physical"
                                                                        value="<?php echo $code_physical; ?>"></td>
                                                                    <td><input type="text" class="form-control two" name="physical" id="physical"
                                                                        value="<?php echo $physical; ?>"></td>
                                                                    <td><input type="text" class="form-control three" name="credits_physical" id="credits_physical"
                                                                        value="<?php echo $credits_physical; ?>"></td>
                                                                    <td>
                                                                        <div class="" align="center">
                                                                            <div class="col-md-6 col-xs-6 no-padding">
                                                                                <a href="JavaScript:if(confirm('Confirm Delete?')==true){window.location='?Act=DelSubPhysical&id=<?= $id;?>';}" class="btn btn-danger" name="btnDelete">D</a>
                                                                            </div><!-- /col-md-6 -->

                                                                            <div class="col-md-6 col-xs-6 no-padding">
                                                                                <button type="submit" class="btn btn-info" name="submitUpdateSubPhysical" >U</button>
                                                                            </div><!-- /col-md-6 -->
                                                                        </div><!-- /row -->
                                                                    </td>
                                                                </tr>
                                                            </form>
                                                        <?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div><!-- form-group -->
                                    </div><!-- /col-md-12 -->
                                    <div class="clearfix"> </div>
                                </div><!-- /well -->
                            </div><!--scrollspy-example-->
                        </div><!-- /row -->
                    </div><!-- /col-md-6 -->
                </div><!--End panel-body-->
            </div><!--End panel-default-->
        </div>


        <!--2-->
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    2
                </div>

                <div class="panel-body">
                    <!--Left list subject-->
                    <div class="col-md-6">
                        <?php
                        $db = new db();
                        $row = $db ->findByPk('tbsubject_group', 'id', 2)->executeRow();
                        if(!empty($row)){
                            $id = $row['id'];
                            $typecourse = $row['typecourse'];
                        }
                        ?>
                        <form action="?Act=UpdateGroupSpecial2&id=<?=$id;?>" method ="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="course_group2" id="course_group2" placeholder="หมวดวิชา"
                                        value="<?php echo $typecourse; ?>">
                                </div>
                                <div class="col-md-2 " >
                                    <button type="submit" class="btn btn-info " name="sumitCourseUpdate2"onclick="return CheckValue();" style="width:100%;"> U </button>
                                    <div class ="clearfix"></div>
                                </div>

                            </div>
                            <hr/>
                        </form>

                        <form action="?Act=AddGroup2" method ="post" class="form-horizontal" role="form" enctype="multipart/form-data">

                            <div class="form-group">
                                <div class="col-md-7">
                                    <input type="text" class="form-control" name="subject_speci" id="subject_speci" placeholder="เพิ่มรายวิชา">
                                </div>
                                <div class="col-md-3 ">
                                    <input type="text" class="form-control" name="credits_speci" id="credits_speci" placeholder="หน่วยกิจ">
                                </div>
                                <div class="col-md-2 ">
                                    <button type="submit"  class="btn btn-success" name="sumitAddGroup2" style="width:100%;"
                                        onclick="return CheckValue(); ">Add</button>

                                    <div class ="clearfix"></div>
                                </div>
                            </div>
                        </form>

                        <div class="col-md-12 no-padding" >
                            <div class="form-group" >
                                <div class="table-responsive ">
                                    <table class="table table-bordered" >
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>รายวิชา </th>
                                                <th>หน่วยกิจ</th>
                                                <th>รายละเอียด</th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                            <?php
                                            $res = Select("tbsubject_group", "where subject_speci != ''" );
                                            while ($row = mysql_fetch_array($res))
                                            {
                                                $id = $row['id'];
                                                $subject_speci = $row['subject_speci'];
                                                $credits_speci = $row['credits_speci'];

                                                ?>
                                                <form action="?Act=UpdateSubjectGroup2&id=<?=$id;?>" method ="post" role="form" enctype="multipart/form-data" >
                                                    <tr>
                                                        <td><?php echo $id; ?></td>
                                                        <td><input type="text" class="form-control" name="subject_speci" id="subject_speci"
                                                            placeholder="หมวดวิชา" value="<?php echo $subject_speci; ?>"></td>

                                                        <td><input type="text" class="form-control" name="credits_speci" id="credits_speci"
                                                            value="<?php echo $credits_speci; ?>"></td>

                                                        <td>
                                                            <div class="" align="center">
                                                                <div class="col-md-6 col-xs-6 no-padding">
                                                                    <a href="JavaScript:if(confirm('Confirm Delete?')==true){window.location=
                                                                        '?Act=DelGroup2&id=<?=$id;?>';}" class="btn btn-danger" name="btnDelete">D</a>
                                                                </div><!-- /col-md-6 -->

                                                                <div class="col-md-6 col-xs-6 no-padding">
                                                                    <button type="submit" class="btn btn-info" name="submitUpdateSubjectGroup2" >U</button>
                                                                </div><!-- /col-md-6 -->
                                                            </div><!-- /row -->
                                                        </td>
                                                    </tr>
                                                </form>
                                                <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div><!-- /row -->
                        </div><!-- /col-md-12 -->
                    </div><!-- /col-md-6 -->


                    <!--Right list subject-->
                    <div class="col-md-6" >
                        <div class="row">
                            <div  class="scrollspy-example" style="min-height:600px;">

                                <!--1-->
                                <div class="well">
                                    <?php
                                    $db = new db();

                                    //query data and show
                                    $row = $db ->findByPk('tbsubject_group', 'id', 1)->executeRow();
                                    if(!empty($row)){
                                        $subject_speci = $row['subject_speci'];
                                    }
                                    ?>
                                    <form action="?Act=UpdateGroup2" method ="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" name="login_fname" id="login_fname" placeholder="รายวิชา" disabled
                                                value="<?php echo $subject_speci;?>">
                                            </div>
                                        </div>
                                    </form>
                                    <form action="?Act=AddSubBasic1" method ="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="col-md-3 ">
                                                <input type="text" class="form-control " name="code_basic1" id="code_basic1" placeholder="รหัสวิชา">
                                            </div>
                                            <div class="col-md-4 ">
                                                <input type="text" class="form-control  " name="basic1" id="basic1" placeholder="ชื่อวิชา">
                                            </div>

                                            <div class="col-md-3 ">
                                                <input type="text" class="form-control" name="credits_basic1" id="credits_basic1" placeholder="หน่วยกิจ">
                                            </div>
                                            <div class="col-md-2 ">
                                                <button type="submit"  class="btn btn-success" name="AddSubBasic1" style="width:100%;"
                                                    onclick="return CheckValue(); ">Add</button>
                                                <div class ="clearfix"></div>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="col-md-12 no-padding" >
                                        <div class="form-group" >
                                            <div class="table-responsive ">
                                                <table class="table table-bordered" >
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>รหัสวิชา</th>
                                                            <th>ชื่อวิชา </th>
                                                            <th>หน่วยกิจ</th>
                                                            <th>จัดการ</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>

                                                        <?php


                                                        $res = Select("tbsubject_speci", "where basic1 != ''" );
                                                        while ($row = mysql_fetch_array($res))
                                                        {
                                                            $id = $row['id'];
                                                            $code_basic1 = $row['code_basic1'];
                                                            $basic1 = $row['basic1'];
                                                            $credits_basic1 = $row['credits_basic1'];

                                                            ?>
                                                            <form action="?Act=UpdateSubBasic1&id=<?=$id;?>" method ="post" role="form" enctype="multipart/form-data">
                                                                <tr>
                                                                    <td><?php echo $id; ?></td>
                                                                    <td><input type="text" class="form-control one" name="code_basic1" id="code_basic1"
                                                                        value="<?php echo $code_basic1; ?>"></td>
                                                                    <td><input type="text" class="form-control two" name="basic1" id="basic1"
                                                                        value="<?php echo $basic1; ?>"></td>
                                                                    <td><input type="text" class="form-control three" name="credits_basic1" id="credits_basic1"
                                                                        value="<?php echo $credits_basic1; ?>"></td>
                                                                    <td>
                                                                        <div class="" align="center">
                                                                            <div class="col-md-6 col-xs-6 no-padding">
                                                                                <a href="JavaScript:if(confirm('Confirm Delete?')==true){window.location='?Act=DelSubBasic1&id=<?= $id;?>';}" class="btn btn-danger" name="btnDelete">D</a>
                                                                            </div><!-- /col-md-6 -->

                                                                            <div class="col-md-6 col-xs-6 no-padding">
                                                                                <button type="submit" class="btn btn-info" name="submitUpdateSubBasic1" >U</button>
                                                                            </div><!-- /col-md-6 -->
                                                                        </div><!-- /row -->
                                                                    </td>
                                                                </tr>
                                                            </form>
                                                        <?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div><!-- form-group -->
                                    </div><!-- /col-md-12 -->
                                    <div class="clearfix"> </div>
                                </div><!-- /well -->

                                <!--2-->
                                <div class="well">
                                    <?php
                                    $db = new db();

                                    //query data and show
                                    $row = $db ->findByPk('tbsubject_group', 'id', 2)->executeRow();
                                    if(!empty($row)){
                                        $subject_speci = $row['subject_speci'];
                                    }
                                    ?>
                                    <form action="?Act=UpdateGroup2" method ="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" name="login_fname" id="login_fname" placeholder="รายวิชา" disabled
                                                value="<?php echo $subject_speci;?>">
                                            </div>
                                        </div>
                                    </form>
                                    <form action="?Act=AddSubMajor" method ="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="col-md-3 ">
                                                <input type="text" class="form-control " name="code_major" id="code_major" placeholder="รหัสวิชา">
                                            </div>
                                            <div class="col-md-4 ">
                                                <input type="text" class="form-control  " name="major" id="major" placeholder="ชื่อวิชา">
                                            </div>

                                            <div class="col-md-3 ">
                                                <input type="text" class="form-control" name="credits_major" id="credits_major" placeholder="หน่วยกิจ">
                                            </div>
                                            <div class="col-md-2 ">
                                                <button type="submit"  class="btn btn-success" name="AddSubMajor" style="width:100%;"
                                                    onclick="return CheckValue(); ">Add</button>
                                                <div class ="clearfix"></div>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="col-md-12 no-padding" >
                                        <div class="form-group" >
                                            <div class="table-responsive ">
                                                <table class="table table-bordered" >
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>รหัสวิชา</th>
                                                            <th>ชื่อวิชา </th>
                                                            <th>หน่วยกิจ</th>
                                                            <th>จัดการ</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>

                                                        <?php


                                                        $res = Select("tbsubject_speci", "where major != ''" );
                                                        while ($row = mysql_fetch_array($res))
                                                        {
                                                            $id = $row['id'];
                                                            $code_major = $row['code_major'];
                                                            $major = $row['major'];
                                                            $credits_major = $row['credits_major'];

                                                            ?>
                                                            <form action="?Act=UpdateSubMajor&id=<?=$id;?>" method ="post" role="form" enctype="multipart/form-data">
                                                                <tr>
                                                                    <td><?php echo $id; ?></td>
                                                                    <td><input type="text" class="form-control one" name="code_major" id="code_major"
                                                                        value="<?php echo $code_major; ?>"></td>
                                                                    <td><input type="text" class="form-control two" name="major" id="major"
                                                                        value="<?php echo $major; ?>"></td>
                                                                    <td><input type="text" class="form-control three" name="credits_major" id="credits_major"
                                                                        value="<?php echo $credits_major; ?>"></td>
                                                                    <td>
                                                                        <div class="" align="center">
                                                                            <div class="col-md-6 col-xs-6 no-padding">
                                                                                <a href="JavaScript:if(confirm('Confirm Delete?')==true){window.location='?Act=DelSubMajor&id=<?= $id;?>';}" class="btn btn-danger" name="btnDelete">D</a>
                                                                            </div><!-- /col-md-6 -->

                                                                            <div class="col-md-6 col-xs-6 no-padding">
                                                                                <button type="submit" class="btn btn-info" name="submitUpdateSubMajor" >U</button>
                                                                            </div><!-- /col-md-6 -->
                                                                        </div><!-- /row -->
                                                                    </td>
                                                                </tr>
                                                            </form>
                                                        <?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div><!-- form-group -->
                                    </div><!-- /col-md-12 -->
                                    <div class="clearfix"> </div>
                                </div><!-- /well -->

                                <!--3-->
                                <div class="well">
                                    <?php
                                    $db = new db();

                                    //query data and show
                                    $row = $db ->findByPk('tbsubject_group', 'id', 3)->executeRow();
                                    if(!empty($row)){
                                        $subject_speci = $row['subject_speci'];
                                    }
                                    ?>
                                    <form action="?Act=UpdateGroup3" method ="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" name="login_fname" id="login_fname" placeholder="รายวิชา" disabled
                                                value="<?php echo $subject_speci;?>">
                                            </div>
                                        </div>
                                    </form>
                                    <form action="?Act=AddSubElective" method ="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="col-md-3 ">
                                                <input type="text" class="form-control " name="code_elective" id="code_elective" placeholder="รหัสวิชา">
                                            </div>
                                            <div class="col-md-4 ">
                                                <input type="text" class="form-control  " name="elective" id="elective" placeholder="ชื่อวิชา">
                                            </div>

                                            <div class="col-md-3 ">
                                                <input type="text" class="form-control" name="credits_elective" id="credits_elective" placeholder="หน่วยกิจ">
                                            </div>
                                            <div class="col-md-2 ">
                                                <button type="submit"  class="btn btn-success" name="AddSubElective" style="width:100%;"
                                                    onclick="return CheckValue(); ">Add</button>
                                                <div class ="clearfix"></div>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="col-md-12 no-padding" >
                                        <div class="form-group" >
                                            <div class="table-responsive ">
                                                <table class="table table-bordered" >
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>รหัสวิชา</th>
                                                            <th>ชื่อวิชา </th>
                                                            <th>หน่วยกิจ</th>
                                                            <th>จัดการ</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>

                                                        <?php


                                                        $res = Select("tbsubject_speci", "where elective != ''" );
                                                        while ($row = mysql_fetch_array($res))
                                                        {
                                                            $id = $row['id'];
                                                            $code_elective = $row['code_elective'];
                                                            $elective = $row['elective'];
                                                            $credits_elective = $row['credits_elective'];

                                                            ?>
                                                            <form action="?Act=UpdateSubbElective&id=<?=$id;?>" method ="post" role="form" enctype="multipart/form-data">
                                                                <tr>
                                                                    <td><?php echo $id; ?></td>
                                                                    <td><input type="text" class="form-control one" name="code_elective" id="code_elective"
                                                                        value="<?php echo $code_elective; ?>"></td>
                                                                    <td><input type="text" class="form-control two" name="elective" id="elective"
                                                                        value="<?php echo $elective; ?>"></td>
                                                                    <td><input type="text" class="form-control three" name="credits_elective" id="credits_elective"
                                                                        value="<?php echo $credits_elective; ?>"></td>
                                                                    <td>
                                                                        <div class="" align="center">
                                                                            <div class="col-md-6 col-xs-6 no-padding">
                                                                                <a href="JavaScript:if(confirm('Confirm Delete?')==true){window.location='?Act=DelSubElective&id=<?= $id;?>';}" class="btn btn-danger" name="btnDelete">D</a>
                                                                            </div><!-- /col-md-6 -->

                                                                            <div class="col-md-6 col-xs-6 no-padding">
                                                                                <button type="submit" class="btn btn-info" name="submitUpdateSubElective" >U</button>
                                                                            </div><!-- /col-md-6 -->
                                                                        </div><!-- /row -->
                                                                    </td>
                                                                </tr>
                                                            </form>
                                                        <?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div><!-- form-group -->
                                    </div><!-- /col-md-12 -->
                                    <div class="clearfix"> </div>
                                </div><!-- /well -->

                            </div><!--scrollspy-example-->
                        </div><!-- /row -->
                    </div><!-- /col-md-6 -->
                </div><!--End panel-body-->
            </div><!--End panel-default-->
        </div>

        <!--3-->
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    3
                </div>

                <div class="panel-body">
                    <!--Left list subject-->
                    <div class="col-md-6">
                        <?php
                        $db = new db();
                        $row = $db ->findByPk('tbsubject_group', 'id', 3)->executeRow();
                        if(!empty($row)){
                            $id = $row['id'];
                            $typecourse = $row['typecourse'];
                        }
                        ?>
                        <form action="?Act=UpdateGroupElective3&id=<?=$id;?>" method ="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                            <div class="form-group">
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="course_group3" id="course_group3" placeholder="หมวดวิชา"
                                        value="<?php echo $typecourse; ?>">
                                </div>
                                <div class="col-md-2 " >
                                    <button type="submit" class="btn btn-info " name="sumitCourseUpdateGroupElective3"onclick="return CheckValue();" style="width:100%;"> U </button>
                                    <div class ="clearfix"></div>
                                </div>

                            </div>
                            <hr/>
                        </form>

                        <form action="?Act=AddGroup3" method ="post" class="form-horizontal" role="form" enctype="multipart/form-data">

                            <div class="form-group">
                                <div class="col-md-7">
                                    <input type="text" class="form-control" name="subject_choice" id="subject_choice" placeholder="เพิ่มรายวิชา">
                                </div>
                                <div class="col-md-3 ">
                                    <input type="text" class="form-control" name="credits_choice" id="credits_choice" placeholder="หน่วยกิจ">
                                </div>
                                <div class="col-md-2 ">
                                    <button type="submit"  class="btn btn-success" name="sumitAddGroup3" style="width:100%;"
                                        onclick="return CheckValue(); ">Add</button>

                                    <div class ="clearfix"></div>
                                </div>
                            </div>
                        </form>

                        <div class="col-md-12 no-padding" >
                            <div class="form-group" >
                                <div class="table-responsive ">
                                    <table class="table table-bordered" >
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>รายวิชา </th>
                                                <th>หน่วยกิจ</th>
                                                <th>รายละเอียด</th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                            <?php
                                            $res = Select("tbsubject_group", "where subject_choice != ''" );
                                            while ($row = mysql_fetch_array($res))
                                            {
                                                $id = $row['id'];
                                                $subject_choice = $row['subject_choice'];
                                                $credits_choice = $row['credits_choice'];

                                                ?>
                                                <form action="?Act=UpdateSubjectGroup3&id=<?=$id;?>" method ="post" role="form" enctype="multipart/form-data" >
                                                    <tr>
                                                        <td><?php echo $id; ?></td>
                                                        <td><input type="text" class="form-control" name="subject_choice" id="subject_choice"
                                                            placeholder="หมวดวิชา" value="<?php echo $subject_choice; ?>"></td>

                                                        <td><input type="text" class="form-control" name="credits_choice" id="credits_choice"
                                                            value="<?php echo $credits_choice; ?>"></td>

                                                        <td>
                                                            <div class="" align="center">
                                                                <div class="col-md-6 col-xs-6 no-padding">
                                                                    <a href="JavaScript:if(confirm('Confirm Delete?')==true){window.location=
                                                                        '?Act=DelGroup3&id=<?=$id;?>';}" class="btn btn-danger" name="btnDelete">D</a>
                                                                </div><!-- /col-md-6 -->

                                                                <div class="col-md-6 col-xs-6 no-padding">
                                                                    <button type="submit" class="btn btn-info" name="submitUpdateSubjectGroup3" >U</button>
                                                                </div><!-- /col-md-6 -->
                                                            </div><!-- /row -->
                                                        </td>
                                                    </tr>
                                                </form>
                                                <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div><!-- /row -->
                        </div><!-- /col-md-12 -->
                    </div><!-- /col-md-6 -->


                    <!--Right list subject-->
                    <div class="col-md-6" >
                        <div class="row">
                            <div  class="scrollspy-example" style="min-height:600px;">


                                <!--1-->
                                <div class="well">
                                    <?php
                                    $db = new db();

                                    //query data and show
                                    $row = $db ->findByPk('tbsubject_group', 'id', 1)->executeRow();
                                    if(!empty($row)){
                                        $subject_choice = $row['subject_choice'];
                                    }
                                    ?>
                                    <form action="?Act=UpdateGroupChoice3" method ="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <input type="text" class="form-control" name="login_fname" id="login_fname" placeholder="รายวิชา" disabled
                                                value="<?php echo $subject_choice;?>">
                                            </div>
                                        </div>
                                    </form>
                                    <form action="?Act=AddSubChoice" method ="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="col-md-3 ">
                                                <input type="text" class="form-control " name="code_elective" id="code_elective" placeholder="รหัสวิชา">
                                            </div>
                                            <div class="col-md-4 ">
                                                <input type="text" class="form-control  " name="elective" id="elective" placeholder="ชื่อวิชา">
                                            </div>

                                            <div class="col-md-3 ">
                                                <input type="text" class="form-control" name="credits_elective" id="credits_elective" placeholder="หน่วยกิจ">
                                            </div>
                                            <div class="col-md-2 ">
                                                <button type="submit"  class="btn btn-success" name="AddSubChoice" style="width:100%;"
                                                    onclick="return CheckValue(); ">Add</button>
                                                <div class ="clearfix"></div>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="col-md-12 no-padding" >
                                        <div class="form-group" >
                                            <div class="table-responsive ">
                                                <table class="table table-bordered" >
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>รหัสวิชา</th>
                                                            <th>ชื่อวิชา </th>
                                                            <th>หน่วยกิจ</th>
                                                            <th>จัดการ</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>

                                                        <?php


                                                        $res = Select("tbsubject_choice", "where elective != ''" );
                                                        while ($row = mysql_fetch_array($res))
                                                        {
                                                            $id = $row['id'];
                                                            $code_elective = $row['code_elective'];
                                                            $elective = $row['elective'];
                                                            $credits_elective = $row['credits_elective'];

                                                            ?>
                                                            <form action="?Act=UpdateSubChoice&id=<?=$id;?>" method ="post" role="form" enctype="multipart/form-data">
                                                                <tr>
                                                                    <td><?php echo $id; ?></td>
                                                                    <td><input type="text" class="form-control one" name="code_elective" id="code_elective"
                                                                        value="<?php echo $code_elective; ?>"></td>
                                                                    <td><input type="text" class="form-control two" name="elective" id="elective"
                                                                        value="<?php echo $elective; ?>"></td>
                                                                    <td><input type="text" class="form-control three" name="credits_elective" id="credits_elective"
                                                                        value="<?php echo $credits_elective; ?>"></td>
                                                                    <td>
                                                                        <div class="" align="center">
                                                                            <div class="col-md-6 col-xs-6 no-padding">
                                                                                <a href="JavaScript:if(confirm('Confirm Delete?')==true){window.location='?Act=DelSubChoice&id=<?= $id;?>';}" class="btn btn-danger" name="btnDelete">D</a>
                                                                            </div><!-- /col-md-6 -->

                                                                            <div class="col-md-6 col-xs-6 no-padding">
                                                                                <button type="submit" class="btn btn-info" name="submitUpdateSubChoice" >U</button>
                                                                            </div><!-- /col-md-6 -->
                                                                        </div><!-- /row -->
                                                                    </td>
                                                                </tr>
                                                            </form>
                                                        <?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div><!-- form-group -->
                                    </div><!-- /col-md-12 -->
                                    <div class="clearfix"> </div>
                                </div><!-- /well -->
                            </div><!--scrollspy-example-->
                        </div><!-- /row -->
                    </div><!-- /col-md-6 -->
                </div><!--End panel-body-->
            </div><!--End panel-default-->
        </div>


        <!--Tab3-->
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Tab3
                </div>

                <div class="panel-body">
                    <?php
                    $res = Select("tbcourse", "where id = 1" );
                    while ($row = mysql_fetch_array($res))
                    {
                        $id = $row['id'];
                        $tab3_title = $row['tab3_title'];
                        $tab3_text = $row['tab3_text'];

                        ?>
                        <form action="?Act=UpdateCourseTab3&id=<?=$id;?>" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
                            <div class="col-md-11">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">ชื่อเรื่อง</label>

                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="tab3_title" id="tab3_title"
                                        value="<?php echo $tab3_title;?>">
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">เนื้อหา</label>
                                    <div class="col-md-10">
                                        <textarea class="form-control" rows="5"  name="tab3_text" id="tab3_text" placeholder="Entry Text" style="min-height:500px;">
                                        <?php echo $tab3_text; ?>
                                        </textarea>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-md-2 control-label"></label>
                                    <div class="col-md-10">
                                         <button type="submit" class="btn btn-primary" name="sumitCourseUpdateTab3"onclick="return CheckValue();">Update</button>
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
    </div>
</div>






<script src="../js/DropdownHover.js"></script>
<script src="../js/app.js"></script>

</body>
<?php } ?>
</html>
