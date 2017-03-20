<?php  
    // error_reporting(0); 
    // session_start(); 
    include ('module/connectDB.php');
    include ('module/function.php');
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width = device-width, initial-scale=1">
    <title>การติดตั้ง Bootstrap 3</title>

    <link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
    <script type="text/javascript" src="./js/jquery.js"></script>
    <script type="text/javascript" src="./js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style2.css">

    <!-- custom -->
    <link rel="stylesheet" href="css/style-blue.css">
    <link rel="stylesheet" href="css/vendors.css">

    <link rel="stylesheet" href="fonts/font-awesome/font-awesome-4.6.2/css/font-awesome.min.css">



</head>
<body>
    <?php
      //header nav 
        include ('header.php');
    ?>


        <div class="container-fluid" style="min-height: 1000px;">
            <div class="container" style="background-color: #ddd; margin-top: 20px;">

                <?php 
        $NewsPage = $_GET['NewsPage'];

                                        $res = Select("tbnews", "where id = $NewsPage" );
                                        while ($row = mysql_fetch_array($res)) 
                                        {
                                            # code... 
                                            $news_id = $row['id'];

                                            $news_title = $row['news_title'];
                                            $news_text = $row['news_text'];
                                        
                                        ?> <div class="col-md-4 news-item">
                                            <h2 class="title"><a href="news-single.html"><?php echo $news_text; ?></a></h2>
                                           
                                            </div><!--//news-item-->
                                        <?php
                                        }
                                    ?>

                        <h1>สาขาวิทยาการคอมพิวเตอร์</h1>
                        <hr>
                        <img src="images/ssss.jpg" class="img-responsive" alt="Image">
                        <h2>หลักสูตร วิทยาศาสตรบัณฑิต (วท.บ) Bachelor of Science Program in Computer Science</h2>

                        <br>

                        <h3>  ชื่อหลักสูตร</h3>
                        <p>วิทยาศาสตรบัณฑิต สาขาวิชาวิทยาการคอมพิวเตอร์<br>
                        Bachelor of Science Program in Computer Science</p>

                        <h3>  ชื่อปริญญาและสาขาวิชา</h3>
                        <p>1. ชื่อเต็ม:  วิทยาศาสตรบัณฑิต (วิทยาการคอมพิวเตอร์) : Bachelor of Science (Computer Science) <br>
                        2. ชื่อย่อ :  วท.บ. (วิทยาการคอมพิวเตอร์) : B.Sc. (Computer Science)</p>


                        <h3>    วัตถุประสงค์ของหลักสูตร</h3>
                        <p>
                            1. เพื่อผลิตบัณฑิตที่มีความรู้ความสามารถด้านวิทยาการคอมพิวเตอร์ สามารถนำความรู้ไปประยุกต์ในการปฏิบัติงานได้ 
ทั้งในภาครัฐบาล และภาคธุรกิจเอกชน<br>
        2. เพื่อส่งเสริมการพัฒนาทรัพยากรบุคคลที่มีคุณธรรม จริยธรรม สามารถประกอบอาชีพดำรงชีวิต และปฏิบัติงาน
ในสังคมส่วนรวมได้อย่างมีความสุข<br>
        3. เพื่อส่งเสริม และสนับสนุน การวิจัยและพัฒนาด้านวิทยาการคอมพิวเตอร์ หรือสาขาที่เกี่ยวข้อง เพื่อการพัฒนาสังคม และประเทศชาติ
                        </p>

                <div class="row">
                <div role="tabpanel">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#home" aria-controls="home" role="tab" data-toggle="tab">home</a>
                        </li>
                        <li role="presentation" class="active">
                            <a href="#home" aria-controls="home" role="tab" data-toggle="tab">home</a>
                        </li>
                        <li role="presentation" class="active">
                            <a href="#home" aria-controls="home" role="tab" data-toggle="tab">home</a>
                        </li>
                        <li role="presentation" class="active">
                            <a href="#home" aria-controls="home" role="tab" data-toggle="tab">home</a>
                        </li>
                        <li role="presentation" class="active">
                            <a href="#home" aria-controls="home" role="tab" data-toggle="tab">home</a>
                        </li>
                        <li role="presentation">
                            <a href="#tab" aria-controls="tab" role="tab" data-toggle="tab">tab</a>
                        </li>

                    </ul>
                
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="home">
                            <div class = "row">
                <div class="table-responsive">
                    <!-- Table Basic -->
                    <table class="table table-bordered">
                        <thead>
                            <tr >
                                <th> # </th>
                                <th> Name </th>
                                <th> Last Name</th>
                                <th> E-mail</th>
                                <th> Tel no. </th>
                                <th> Option </th>
                                <th> Checkbox </th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="success">
                                <td>1</td>
                                <td>success</td>
                                <td>Table </td>
                                <td>table 01</td>
                                <td>098-687-xxxx</td>
                                <td>Option</td>
                                <td>Checkbox</td>

                            </tr>
                            
                            <tr class="active">
                                <td>1</td>
                                <td>active</td>
                                <td>Table </td>
                                <td>table 01</td>
                                <td>098-687-xxxx</td>
                                <td>Option</td>
                                <td>Checkbox</td>
                            </tr>
            
                        </tbody>
                    </table>
                </div>
            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="tab">...</div>
                    </div>
                </div>
            </div>
            </div>

            
        </div>

<script src="js/DropdownHover.js"></script>
<!-- <script src="js/styleswitcher.js"></script> -->






</body>
</html>

