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
	<title>Course</title>

	<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
    <script type="text/javascript" src="./js/jquery.js"></script>
    <script type="text/javascript" src="./js/bootstrap.min.js"></script>

    <!-- custom -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/vendors.css">

    <link rel="stylesheet" href="fonts/font-awesome/font-awesome-4.6.2/css/font-awesome.min.css">



</head>
<body >
    <?php
      //header nav
        include ('header.php');
    ?>

    <header class="main-header">
        <div class="container">
            <h1 class="page-title">ปริญญาตรีภาคปกติ</h1>

            <ol class="breadcrumb pull-right">
                <li><a href="#">หลักสูตร</a></li>
                <li class="active">ปริญญาตรีภาคปกติ</li>
            </ol>
        </div>
    </header>


    <div class="container margin-bottom" style="margin-top: 20px;">
        <div class="row">
            <div class=" col-md-9  " >
                <div class="bg-content">
                    <div class="text-course">
                        <?php
                        $res = Select("tbcourse", "where id=1" );
                        while ($row = mysql_fetch_array($res))
                        {
                            $course_img= $row['course_img'];
                        }
                        ?>

                        <div class="cotent-info">
                            <img src="images/course/<?php echo $course_img;?>" alt="">
                        </div>
                        <br>

                    <!-- รายวิชาทั้งหมด -->
                    <aside class="sidebar">
                        <ul id="myTab2" class="nav nav-tabs nav-tabs-ar">
                            <li class="active"><a data-toggle="tab" href="#text"><i class="fa fa-star"></i>&nbsp; ข้อมูลสาขา</a></li>
                            <li><a data-toggle="tab" href="#categoriesff"><i class="fa fa-folder-open"></i>&nbsp; โครงสร้างหลักสูตร</a></li>
                            <!-- <li><a data-toggle="tab" href="#fav"><i class="fa fa-folder-open"></i>&nbsp; หมวดวิชาศึกษาทั่วไป</a></li> -->
                        </ul>

                        <div class="tab-content">

                            <!-- tab1 -->
                            <div id="text" class="tab-pane active">

                                <?php
                                $res = Select("tbcourse", "where id=1" );
                                while ($row = mysql_fetch_array($res))
                                {
                                    $id= $row['id'];
                                    $course_title= $row['course_title'];
                                    $course_text= $row['course_text'];
                                    ?>
                                    <h3 class="post-title no-margin-top"><?php echo $course_title;?></h3>
                                    <div class="text-info">
                                        <?php
                                        echo $course_text;
                                        ?>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>

                            <!-- tab2 -->
                            <div id="categoriesff" class="tab-pane">

                                <?php
                                $res = Select("tbcourse", "where id=2" );
                                while ($row = mysql_fetch_array($res))
                                {
                                    $course_title= $row['course_title'];
                                }
                                ?>
                                <h3 class="post-title no-margin-top"><?php echo $course_title;?></h3>

                                <!--รายวิชาทั้งหมด  -->
                                <div class="table-responsive">
                                    <table class="table table-bordered">

                                    <!-- หมวดวิชาศึกษาทั่วไป     -->
                                        <thead>
                                            <?php
                                            $res = Select("tbsubject_group", "where subject_normal != ''" );
                                            while ($row = mysql_fetch_array($res))
                                            {
                                                $credits_normal= $row['credits_normal'];
                                                $typecourse= $row['typecourse'];
                                                $normal_credits += $credits_normal;

                                            }
                                            ?>

                                            <?php
                                            $res = Select("tbsubject_group", "where id = 1" );
                                            while ($row = mysql_fetch_array($res))
                                            {
                                                $typecourse= $row['typecourse'];
                                            }
                                            ?>

                                            <tr>
                                                <th><a href="#normal"><?php echo $typecourse;?></a></th>
                                                <th><?php echo $normal_credits;?></th>
                                                <th>หน่วยกิต</th>
                                            </tr>
                                        </thead>
                                         <tbody>
                                            <?php
                                            $res = Select("tbsubject_group", "where subject_normal != ''" );
                                            while ($row = mysql_fetch_array($res))
                                            {
                                                        # code...
                                                $id = $row['id'];
                                                $subject_normal = $row['subject_normal'];
                                                $credits_normal = $row['credits_normal'];

                                                ?>
                                                <tr>
                                                    <td><?php echo $subject_normal;?> </td>
                                                    <td><?php echo $credits_normal;?> </td>
                                                    <td>หน่วยกิต </td>
                                                </tr>

                                                <?php
                                            }
                                            ?>
                                        </tbody>

                                    <!-- หมวดวิชาเฉพาะ  -->
                                        <thead>
                                            <?php
                                            $res = Select("tbsubject_group", "where subject_speci != ''" );
                                            while ($row = mysql_fetch_array($res))
                                            {
                                                $credits_speci= $row['credits_speci'];
                                                $speci_credits += $credits_speci;
                                            }
                                            ?>

                                            <?php
                                            $res = Select("tbsubject_group", "where id = 2" );
                                            while ($row = mysql_fetch_array($res))
                                            {
                                                $typecourse= $row['typecourse'];
                                            }
                                            ?>

                                            <tr>
                                                <th><a href="#speci"><?php echo $typecourse;?></a></th>
                                                <th><?php echo $speci_credits;?></th>
                                                <th>หน่วยกิต</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $res = Select("tbsubject_group", "where subject_speci != ''" );
                                            while ($row = mysql_fetch_array($res))
                                            {
                                                        # code...
                                                $id = $row['id'];


                                                $subject_speci = $row['subject_speci'];
                                                $credits_speci= $row['credits_speci'];

                                                ?>
                                                <tr>
                                                    <td> <?php echo $subject_speci;?> </td>
                                                    <td><?php echo $credits_speci;?></td>
                                                    <td>หน่วยกิต</td>
                                                </tr>

                                                <?php
                                            }
                                            ?>
                                        </tbody>

                                    <!-- หมวดวิชาเลือกเสรี   -->
                                        <thead>
                                            <?php
                                            $res = Select("tbsubject_group", "where subject_choice != ''" );
                                            while ($row = mysql_fetch_array($res))
                                            {
                                                $credits_choice= $row['credits_choice'];
                                                $choice_credits += $credits_choice;
                                            }
                                            ?>

                                            <?php
                                            $res = Select("tbsubject_group", "where id = 2" );
                                            while ($row = mysql_fetch_array($res))
                                            {
                                                $typecourse= $row['typecourse'];
                                            }
                                            ?>

                                            <tr>
                                                <th><a href="#speci"><?php echo $typecourse;?></a></th>
                                                <th><?php echo $choice_credits;?></th>
                                                <th>หน่วยกิต</th>
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
                                                <tr >
                                                    <td> <?php echo $subject_choice;?> </td>
                                                    <td> <?php echo $credits_choice;?></td>
                                                    <td>หน่วยกิต</td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                                <tr>
                                                    <th> <strong>รวม</strong> </th>
                                                    <th> <?php echo $normal_credits+$speci_credits+$choice_credits;?></th>
                                                    <th>หน่วยกิต</th>
                                                </tr>
                                        </tbody>
                                    </table>
                                </div><!-- end table -->

                                <div aria-multiselectable="true" role="tablist" id="accordion" class="panel-group">

                                    <!-- ย่อย1 -->
                                    <div class="panel panel-success" id="normal">
                                        <div class="panel-heading panel-heading-link">
                                            <a href="#collapseOne1" data-parent="#accordion" data-toggle="collapse">
                                                <i class="fa fa-android" aria-hidden="true"></i>หมวดวิชาศึกษาทั่วไป
                                            </a>
                                        </div>
                                        <div class="panel-collapse collapse" id="collapseOne1">
                                            <div class="panel-body">

                                            <div class="table-responsive ">
                                                <!-- กลุ่มวิชามนุษยศาสตร์     -->
                                                <h4>กลุ่มวิชามนุษยศาสตร์</h4><br>
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>รหัสวิชา</th>
                                                            <th>ชื่อวิชา</th>
                                                            <th>หน่วยกิต</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                     <?php
                                                        $res = Select("tbsubject_normal", "where humanities != ''" );
                                                        while ($row = mysql_fetch_array($res))
                                                        {
                                                                # code...
                                                                $id = $row['id'];

                                                                $humanities = $row['humanities'];
                                                                $code_human = $row['code_human'];
                                                                $credits_human = $row['credits_human'];


                                                            ?>
                                                                <tr>
                                                                    <td><?php echo $code_human;?></td>
                                                                    <td> <?php echo $humanities;?> </td>
                                                                    <td><?php echo $credits_human;?></td>
                                                                </tr>
                                                            <?php
                                                        }
                                                    ?>
                                                    </tbody>
                                                </table>


                                                <!-- กลุ่มวิชาสังคมศาสตร์    -->
                                                <h4>กลุ่มวิชาสังคมศาสตร์</h4><br>
                                               <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>รหัสวิชา</th>
                                                            <th>ชื่อวิชา</th>
                                                            <th>หน่วยกิต</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>

                                                    <?php
                                                        $res = Select("tbsubject_normal", "where social != ''" );
                                                        while ($row = mysql_fetch_array($res))
                                                        {
                                                                # code...
                                                                $id = $row['id'];

                                                                $social = $row['social'];
                                                                $code_social = $row['code_social'];
                                                                $credits_social = $row['credits_social'];
                                                            ?>
                                                                <tr>
                                                                    <td><?php echo $code_social;?></td>
                                                                    <td> <?php echo $social;?> </td>
                                                                    <td><?php echo $credits_social;?></td>
                                                                </tr>

                                                            <?php
                                                        }
                                                    ?>
                                                    </tbody>
                                                </table>


                                                <!-- กลุ่มวิชาภาษา  -->
                                                <h4>กลุ่มวิชาภาษา</h4><br>
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>รหัสวิชา</th>
                                                            <th>ชื่อวิชา</th>
                                                            <th>หน่วยกิต</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>

                                                    <?php
                                                        $res = Select("tbsubject_normal", "where language != ''" );
                                                        while ($row = mysql_fetch_array($res))
                                                        {
                                                                # code...
                                                                $id = $row['id'];

                                                                $language = $row['language'];
                                                                $code_language = $row['code_language'];
                                                                $credits_language = $row['credits_language'];
                                                            ?>
                                                                <tr>
                                                                    <td> <?php echo $code_language;?></td>
                                                                    <td> <?php echo $language;?> </td>
                                                                    <td> <?php echo $credits_language;?></td>
                                                                </tr>

                                                            <?php
                                                        }
                                                    ?>
                                                    </tbody>
                                                </table>


                                                <!-- กลุ่มวิชาวิทยาศาสตร์และคณิตศาสตร์  -->
                                                <h4>กลุ่มวิชาวิทยาศาสตร์และคณิตศาสตร์</h4><br>
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>รหัสวิชา</th>
                                                            <th>ชื่อวิชา</th>
                                                            <th>หน่วยกิต</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>

                                                    <?php
                                                        $res = Select("tbsubject_normal", "where science != ''" );
                                                        while ($row = mysql_fetch_array($res))
                                                        {
                                                                # code...
                                                                $id = $row['id'];
                                                                $science = $row['science'];
                                                                $code_science = $row['code_science'];
                                                                $credits_science = $row['credits_science'];
                                                            ?>
                                                                <tr>
                                                                    <td><?php echo $code_science;?></td>
                                                                    <td> <?php echo $science;?> </td>
                                                                    <td><?php echo $credits_science;?></td>
                                                                </tr>

                                                            <?php
                                                        }
                                                    ?>
                                                    </tbody>
                                                </table>


                                                <!-- กลุ่มวิชาพลศึกษาและนันทนาการ   -->
                                                <h4>กลุ่มวิชาพลศึกษาและนันทนาการ</h4><br>
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>รหัสวิชา</th>
                                                            <th>ชื่อวิชา</th>
                                                            <th>หน่วยกิต</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>

                                                    <?php
                                                        $res = Select("tbsubject_normal", "where physical != ''" );
                                                        while ($row = mysql_fetch_array($res))
                                                        {
                                                                # code...
                                                                $id = $row['id'];

                                                                $physical = $row['physical'];
                                                                $code_physical = $row['code_physical'];
                                                                $credits_physical = $row['credits_physical'];


                                                            ?>
                                                                <tr>
                                                                    <td><?php echo $code_physical;?></td>
                                                                    <td> <?php echo $physical;?> </td>
                                                                    <td><?php echo $credits_physical;?></td>
                                                                </tr>

                                                            <?php
                                                        }
                                                    ?>

                                                    </tbody>
                                                </table>
                                            </div>
                                            </div>
                                        </div>
                                    </div><!-- End panel Normal -->


                                    <!-- ย่อย 2 -->
                                    <div class="panel panel-success">
                                        <div class="panel-heading panel-heading-link" id="speci">
                                            <a href="#collapseOne2" data-parent="#accordion" data-toggle="collapse">
                                                <i class="fa fa-android" aria-hidden="true"></i>หมวดวิชาเฉพาะ
                                            </a>
                                        </div>
                                        <div class="panel-collapse collapse" id="collapseOne2">
                                            <div class="panel-body">
                                            <div class="table-responsive">
                                                <!-- วิชาพื้นฐานทางวิชาชีพ   -->
                                                <h4>วิชาพื้นฐานทางวิชาชีพ</h4><br>
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr >
                                                            <th>รหัสวิชา</th>
                                                            <th>ชื่อวิชา</th>
                                                            <th>หน่วยกิต</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <?php
                                                        $res = Select("tbsubject_speci", "where basic1 != '' " );
                                                        while ($row = mysql_fetch_array($res))
                                                        {
                                                            $id = $row['id'];
                                                            $basic1 = $row['basic1'];
                                                            $code_basic1 = $row['code_basic1'];
                                                            $credits_basic1 = $row['credits_basic1'];
                                                            ?>
                                                            <tr>
                                                                <td> <?php echo $code_basic1;?> </td>
                                                                <td><?php echo $basic1;?></td>
                                                                <td><?php echo $credits_basic1;?></td>
                                                            </tr>

                                                            <?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>

                                                <!-- วิชาเอกบังคับ   -->
                                                <h4>วิชาเอกบังคับ</h4><br>
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>รหัสวิชา</th>
                                                            <th>ชื่อวิชา</th>
                                                            <th>หน่วยกิต</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <?php
                                                        $res = Select("tbsubject_speci", "where major != '' " );
                                                        while ($row = mysql_fetch_array($res))
                                                        {
                                                                    # code...
                                                            $id = $row['id'];

                                                            $major = $row['major'];
                                                            $code_basic = $row['code_basic'];
                                                            $credits_major = $row['credits_major'];


                                                            ?>
                                                            <tr>
                                                                <td> <?php echo $code_basic;?> </td>
                                                                <td><?php echo $major;?></td>
                                                                <td><?php echo $credits_major;?></td>
                                                            </tr>

                                                            <?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>

                                                <!-- วิชาเอกเลือก   -->
                                                <h4>วิชาเอกเลือก</h4><br>
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>รหัสวิชา</th>
                                                            <th>ชื่อวิชา</th>
                                                            <th>หน่วยกิต</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <?php
                                                        $res = Select("tbsubject_speci", "where elective != '' " );
                                                        while ($row = mysql_fetch_array($res))
                                                        {
                                                                    # code...
                                                            $id = $row['id'];

                                                            $elective = $row['elective'];
                                                            $code_elective = $row['code_elective'];
                                                            $credits_elective = $row['credits_elective'];


                                                            ?>
                                                            <tr>
                                                                <td> <?php echo $code_elective;?> </td>
                                                                <td><?php echo $elective;?></td>
                                                                <td><?php echo $credits_elective;?></td>
                                                            </tr>

                                                            <?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            </div>
                                        </div>
                                    </div><!-- End panel Special -->

                                    <!-- ย่อย3 -->
                                    <div class="panel panel-success">
                                        <div class="panel-heading panel-heading-link" id="free">
                                            <a href="#collapseOne3" data-parent="#accordion" data-toggle="collapse">
                                                <i class="fa fa-android" aria-hidden="true"></i>หมวดวิชาเลือกเสรี
                                            </a>
                                        </div>
                                        <div class="panel-collapse collapse" id="collapseOne3">
                                            <div class="panel-body">

                                                <div class="table-responsive">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>รหัสวิชา</th>
                                                                <th>ชื่อวิชา</th>
                                                                <th>หน่วยกิต</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            <?php

                                                            $res = Select("tbsubject_choice", "where elective != ''" );
                                                            while ($row = mysql_fetch_array($res))
                                                            {
                                                            # code...
                                                                $id = $row['id'];

                                                                $elective = $row['elective'];
                                                                $code_elective = $row['code_elective'];
                                                                $credits_elective = $row['credits_elective'];
                                                                ?>
                                                                <tr>
                                                                    <td> <?php echo $code_elective;?> </td>
                                                                    <td><?php echo $elective;?></td>
                                                                    <td><?php echo $credits_elective;?></td>
                                                                </tr>
                                                                <?php
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- End panel Choice -->

                                </div><!-- End panel group  -->
                            </div>

                            <!-- tab3 -->
                            <div id="fav" class="tab-pane ">
                            <?php
                                $res = Select("tbcourse", "where id=1" );
                                while ($row = mysql_fetch_array($res))
                                {
                                    $id= $row['id'];
                                    $tab3_title= $row['tab3_title'];
                                    $tab3_text= $row['tab3_text'];
                                    ?>
                                    <h3 class="post-title no-margin-top"><?php echo $tab3_title;?></h3>
                                    <div class="text-info">
                                        <?php
                                        echo $tab3_text;
                                        ?>
                                        <i class="fa fa-header"></i><a href="#">testtesttesdasdasdt pdf1<  <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
</a><br>
                                        <i class="fa fa-header"></i><a href="#">testtesttesasdast pdf1  <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
</a><br>
                                        <i class="fa fa-header"></i><a href="#">testtesttedasdasdst pdf1  <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
</a><br>
                                        <i class="fa fa-header"></i><a href="#">testtesttedasdasdst pdf1  <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
</a><br>
                                        <i class="fa fa-header"></i><a href="#">testtesttedasdasdst pdf1  <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
</a><br>
                                      <i class="fa fa-header"></i>  <a href="#">testtesttedasdasdst pdf1  <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
</a><br>
                                      <i class="fa fa-header"></i>  <a href="#">testtesttedasdasdst pdf1  <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
</a><br>
                                      <i class="fa fa-header"></i>  <a href="#">testtesttedasdasdst pdf1  <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
</a><br>
                                      <i class="fa fa-header"></i>  <a href="#">testtestteasdasst pdf1 <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
</a>
                                    </div>
                                    <?php
                                }
                                ?>

                            </div>
                            <!-- End panel group  -->


                        </div> <!-- tab-content -->

                    </aside> <!-- Sidebar -->


                    </div> <!--end text-course-->
                </div><!--end text-bg-content-->
            </div><!--end text col-md-8 -->


            <!-- right Menu -->
            <?php
                include ('rightmenu.php');
            ?>

        </div><!--END ROW-->
    </div><!---END CONTAINER -->

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
