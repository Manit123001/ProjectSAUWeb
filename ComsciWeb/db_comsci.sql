-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2017 at 07:41 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_comsci`
--
CREATE DATABASE IF NOT EXISTS `db_comsci` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `db_comsci`;

-- --------------------------------------------------------

--
-- Table structure for table `member_login`
--

CREATE TABLE `member_login` (
  `id` int(11) NOT NULL,
  `login_username` varchar(100) NOT NULL,
  `login_password` varchar(100) NOT NULL,
  `login_fname` varchar(100) NOT NULL,
  `login_lname` varchar(100) CHARACTER SET utf8 COLLATE utf8_danish_ci NOT NULL,
  `login_tel` varchar(10) NOT NULL,
  `login_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `member_login`
--

INSERT INTO `member_login` (`id`, `login_username`, `login_password`, `login_fname`, `login_lname`, `login_tel`, `login_type`) VALUES
(1, 'admin', 's5652410018', 'มานิต', 'ฉลภิญโญ', '0852931467', 'admin'),
(2, '22', '22', 'Chanintorn ', 'Chalermsuk', '22', 'admin'),
(3, '123', '123', '123dddddddd', '123dddddddddd', '123', ''),
(4, '', '2222', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbabout`
--

CREATE TABLE `tbabout` (
  `id` int(11) NOT NULL,
  `about_img` varchar(100) NOT NULL,
  `about_title` varchar(100) NOT NULL,
  `about_text` varchar(300) NOT NULL,
  `animation` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbabout`
--

INSERT INTO `tbabout` (`id`, `about_img`, `about_title`, `about_text`, `animation`) VALUES
(1, '34548.jpg', 'เรียนจริง', '\r\nการเรียนเน้นการปฎิบัติ ศึกษาเทคโนโลยีใหม่ ฝึกการเชิงตรรกะ ฝึกอัลกอริทึม ของภาษาต่างๆ รู้โครงสร้าง เน้นการ การเขียนโปรแกรมเชิงวัติถุ', 'animation-delay-10'),
(2, 'a2.jpg', 'เล่นจริง', 'กิจกรรม ของมหาวิทยาลัยเราเล่น และกิจกรรมของคณะ และสาขา สร้างสรรค์ฝึกความมีวินัย ความสามัคคี มีปติสัมพันกับผู้อื่น ได้ร่วมกิจกรรมกับสาขาอื่นสนุกแน่นอน', 'animation-delay-16'),
(3, 'a3.jpg', 'ฮาจริง', 'อันนี้แน่นอน วิทย์คอมเรา ทำอะไรเต็มที่ ผมออกมาก็เฮฮาปาตี่ สนิทสนมกันทุกชั้นปี ทุกกิจกรรม จะมีแต่เสียงหัวเราะ แห่งความสุข ^_^', 'animation-delay-14'),
(12, 'a1.jpg', 'น่ารักจริง', 'น่ารัก ที่นิสัย เด็กวิทย์คอม รักทุกคน นาจาาาา', 'animation-delay-12');

-- --------------------------------------------------------

--
-- Table structure for table `tbadmission`
--

CREATE TABLE `tbadmission` (
  `id` int(11) NOT NULL,
  `admis_title` varchar(100) NOT NULL,
  `admis_text` text NOT NULL,
  `admis_webRegis` varchar(300) NOT NULL,
  `admis_img` varchar(100) NOT NULL,
  `admis_viedo` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbadmission`
--

INSERT INTO `tbadmission` (`id`, `admis_title`, `admis_text`, `admis_webRegis`, `admis_img`, `admis_viedo`) VALUES
(1, 'เปิดรับสมัครนักศึกษาใหม่', 'กำหนดการรับสมัครนักศึกษาใหม่ ระดับปริญญาตรี ภาคปกติ 4 ปี ภาคเรียนที่ 1 ปีการศึกษา 2559 สาขาวิทยาการคอมพิวเตอร์ ยินดีตอนรับนักศึกษาทุกคน สามารถสมัครได้ด้วยตนเองที่มหาลัยหรือสมัครผ่านระบบ ออนไลน์ทางเว็บไซต์ โดยไม่เสียค่าใช้จ่ายในการสมัคร เริ่มตั้งแต่ ณ บัดนนี้', 'http://xeon.sau.ac.th/Entonline/RegisterOn.aspx', 'about3.jpg', ''),
(6, 'เรามาเป็นพี่น้องกันเถอะ ^_^', 'วิทยาการคอมพิวเตอร์ สาขาเด่นสาขาดัง เรียนเป็นหลัก กิจกรรมสันทนาการเป็นเลิศ สามัคคีเป็นหนึ่งเดียว', '', 'about1.jpg', 'https://www.youtube.com/embed/5gMi3rSjHoM'),
(7, 'มาก่อนเป็นพี่มาหลังเป็นน้องมาพร้อมเป็นเพื่อน', 'รักใคร่กลมเกลี่ยว กิจกรรมมากมายร่วมสนุกกับรุ่นพี่  สนุกนาจาาา ', '', 'about2.jpg', 'https://www.youtube.com/embed/5gMi3rSjHoM'),
(12, 'เรียนเป็นเรียน เล่นเป็นเล่น ', 'สาขานนี้เรียนจริง เล่นจริง ฮาจริงนะ แล้วยังรักจริงอีกนะ', '', 'about3.jpg', 'https://www.youtube.com/embed/5gMi3rSjHoM');

-- --------------------------------------------------------

--
-- Table structure for table `tbadmission2`
--

CREATE TABLE `tbadmission2` (
  `id` int(11) NOT NULL,
  `admis_viedo` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbadmission2`
--

INSERT INTO `tbadmission2` (`id`, `admis_viedo`) VALUES
(1, 'https://www.youtube.com/embed/5gMi3rSjHoM'),
(4, 'https://www.youtube.com/embed/-59jGD4WrmE?list=FLHEhh7DXbE5FRRLgRnTQr4A');

-- --------------------------------------------------------

--
-- Table structure for table `tbcontact`
--

CREATE TABLE `tbcontact` (
  `id` int(11) NOT NULL,
  `message_name` varchar(50) NOT NULL,
  `message_email` varchar(50) NOT NULL,
  `message_text` text NOT NULL,
  `message_ip` varchar(20) NOT NULL,
  `message_date` varchar(20) NOT NULL,
  `message_read` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbcontact`
--

INSERT INTO `tbcontact` (`id`, `message_name`, `message_email`, `message_text`, `message_ip`, `message_date`, `message_read`) VALUES
(1, 'มานิต ฉลภิญโญ', 'newnew@gmail.com', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '192.56.25.1', '25/07/2016', 'checked'),
(2, '123', '123@2', '23', '::1', '25/07/2016', ''),
(3, '123', '123@21', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '::1', '25/07/2016', ''),
(4, 'ๅ/-', '123@sf', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '::1', '25/07/2016', ''),
(5, '123', '123@123', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '::1', '25/07/2016', 'checked'),
(6, '123', '1@2', '@3', '::1', '25/07/2016', 'checked'),
(7, '123', '2@2', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '192.56.25.1	', '25/07/2016', 'checked'),
(8, '123', '123123@2354234234', '2121212121212121212121212121212121', '192.56.25.1	', '2016/07/25', 'checked'),
(9, 'asd', 'asd@wqeqe', 'asd', '::1', '2016/07/25', 'checked'),
(10, 'qwe', 'qw@qwe', 'qwe', '192.56.25.1	', '25/07/2016', 'checked');

-- --------------------------------------------------------

--
-- Table structure for table `tbcourse`
--

CREATE TABLE `tbcourse` (
  `id` int(20) NOT NULL,
  `course_title` varchar(100) NOT NULL,
  `course_text` text NOT NULL,
  `course_img` varchar(100) NOT NULL,
  `tab3_title` varchar(20) NOT NULL,
  `tab3_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbcourse`
--

INSERT INTO `tbcourse` (`id`, `course_title`, `course_text`, `course_img`, `tab3_title`, `tab3_text`) VALUES
(1, 'รายละเอียดต่างๆ', '\r\n                                        \r\n       <h2>หลักสูตร วิทยาศาสตรบัณฑิต (วท.บ) Bachelor of Science Program in Computer Science</h2>\r\n        <h3>  สาขา​วิชา​วิทยาการ​คอมพิวเตอร์</h3>\r\n        <p> ปัจจุบันเทคโนโลยีเข้ามามีบทบาทอย่างมากในการดำเนินชีวิต โดยเฉพาะเทคโนโลยีด้านคอมพิวเตอร์ที่มีความก้าวหน้าและเปลี่ยนแปลงไปอย่างรวดเร็วมาก ดังนั้น สาขาวิชาวิทยาการคอมพิวเตอร์ได้มีเป้าหมายอย่างชัดเจนที่จะพัฒนาหลักสูตรให้ทันสมัยต่อการเปลี่ยนแปลง ในขณะเดียวกันบัณฑิตที่ผลิตออกไปจะต้องมีความรู้ความสามารถด้านการเขียนโปรแกรมระบบฐานข้อมูล ระบบเครือข่ายการสื่อสารคอมพิวเตอร์ การวิเคราะห์ การพัฒนาซอฟแวร์ที่ทันสมัย ให้ตรงกับความต้องการของผู้ที่จะนำไปใช้ในองค์กรให้มากที่สุด เพื่อเกิดความสอดคล้องกับตลาดแรงงาน\r\n        </p>\r\n        <h3>  ชื่อหลักสูตร</h3>\r\n        <p>วิทยาศาสตรบัณฑิต สาขาวิชาวิทยาการคอมพิวเตอร์<br>\r\n        Bachelor of Science Program in Computer Science</p>\r\n\r\n        <h3>  ชื่อปริญญาและสาขาวิชา</h3>\r\n\r\n        <h4><strong>ภาษาไทย</strong></h4> \r\n        <p> \r\n           ชื่อเต็ม :  วิทยาศาสตรบัณฑิต (วิทยาการคอมพิวเตอร์) <br>\r\n           ชื่อย่อ :  วท.บ. (วิทยาการคอมพิวเตอร์)\r\n        </p>\r\n        <h4><strong>ภาษาอังกฤษ</strong></h4> \r\n        <p> \r\n           ชื่อเต็ม :  Bachelor of Science (Computer Science) <br>\r\n           ชื่อย่อ :  B.Sc. (Computer Science)</p>\r\n\r\n\r\n        <h3>    วัตถุประสงค์ของหลักสูตร</h3>\r\n        <p>\r\n            1. เพื่อผลิตบัณฑิตที่มีความรู้ความสามารถด้านวิทยาการคอมพิวเตอร์ สามารถนำความรู้ไปประยุกต์ในการปฏิบัติงานได้ \r\n        ทั้งในภาครัฐบาล และภาคธุรกิจเอกชน<br>\r\n                2. เพื่อส่งเสริมการพัฒนาทรัพยากรบุคคลที่มีคุณธรรม จริยธรรม สามารถประกอบอาชีพดำรงชีวิต และปฏิบัติงาน\r\n        ในสังคมส่วนรวมได้อย่างมีความสุข<br>\r\n            3. เพื่อส่งเสริม และสนับสนุน การวิจัยและพัฒนาด้านวิทยาการคอมพิวเตอร์ หรือสาขาที่เกี่ยวข้อง เพื่อการพัฒนาสังคม และประเทศชาติ\r\n        </p>\r\n                                        ', '12640473_1697116820566201_5353048577377740831_o.jpg', 'โอกาสทางวิชาชีพ', '                                                                                                                         \r\n<p>นักวิชาการคอมพิวเตอร์นักออกแบบเว็บไซต์ นักออกแบบกราฟิก นักออกแบบมัลติมีเดีย วิศวกรเครือข่าย นักออกแบบระบบเครือข่าย นักบริหารฐานข้อมูลของภาครัฐและเอกชน นักพัฒนาเว็บไซต์ นักวิจัยคอมพิวเตอร์ และประกอบอาชีพเป็นผู้บริหารศูนย์คอมพิวเตอร์ </p>                                                                                                                        '),
(2, 'รายวิชาทั้งหมด', '', '', '', ''),
(3, '', '', '', '', ''),
(4, '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbdetailimg`
--

CREATE TABLE `tbdetailimg` (
  `id` int(11) NOT NULL,
  `detail_title` varchar(100) NOT NULL,
  `detail_text` text NOT NULL,
  `detail_group` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbdetailimg`
--

INSERT INTO `tbdetailimg` (`id`, `detail_title`, `detail_text`, `detail_group`) VALUES
(12, 'Project EXPO 2016', 'งานโปรเจตค ่วิทคอม ดิจิตอล บัสคอม งานแสดงผลงานโปรเจคจบของนักศึกษา ม เอเชีย', '1002'),
(13, '', '', '1003'),
(14, 'คืนสู่เหย้า ปีการศึกษา 2558', 'รวม cs ทุกรุ่น', '1004'),
(15, 'ทัศนศึกษา', '', '1005'),
(16, '', '', '1006'),
(17, 'บริการวิชาการ', '', '1007');

-- --------------------------------------------------------

--
-- Table structure for table `tbfaculty`
--

CREATE TABLE `tbfaculty` (
  `id` int(11) NOT NULL,
  `fac_headtitle` varchar(100) NOT NULL,
  `fac_title` varchar(100) NOT NULL,
  `fac_text` varchar(500) NOT NULL,
  `fac_title1` varchar(100) NOT NULL,
  `fac_detail_title1` varchar(500) NOT NULL,
  `fac_title2` varchar(100) NOT NULL,
  `fac_detail_title2` varchar(500) NOT NULL,
  `fac_title3` varchar(100) NOT NULL,
  `fac_detail_title3` varchar(500) NOT NULL,
  `fac_link` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbfaculty`
--

INSERT INTO `tbfaculty` (`id`, `fac_headtitle`, `fac_title`, `fac_text`, `fac_title1`, `fac_detail_title1`, `fac_title2`, `fac_detail_title2`, `fac_title3`, `fac_detail_title3`, `fac_link`) VALUES
(1, 'คณะศิลปศาสตร์และวิทยาศาสตร์ (Faculty of Arts and Sciences)', 'สาขาวิชาวิทยาการคอมพิวเตอร์', 'ปัจจุบันเทคโนโลยีเข้ามามีบทบาทอย่างมากในการดำเนินชีวิต โดยเฉพาะเทคโนโลยีด้านคอมพิวเตอร์ที่มีความก้าวหน้าและเปลี่ยนแปลงไปอย่างรวดเร็วมาก ดังนั้น สาขาวิชาวิทยาการคอมพิวเตอร์ได้มีเป้าหมายอย่างชัดเจนที่จะพัฒนาหลักสูตรให้ทันสมัยต่อการเปลี่ยนแปลง ในขณะเดียวกันบัณฑิตที่ผลิตออกไปจะต้องมีความรู้ความสามารถด้านการเขียนโปรแกรมระบบฐานข้อมูล ระบบเครือข่ายการสื่อสารคอมพิวเตอร์ การวิเคราะห์ การพัฒนาซอฟแวร์ที่ทันสมัย ให้ตรงกับความต้องการของผู้ที่จะนำไปใช้ในองค์กรให้มากที่สุด เพื่อเกิดความสอดคล้องกับตลาดแรงงาน', 'โอกาสทางวิชาชีพ', 'นักวิชาการคอมพิวเตอร์นักออกแบบเว็บไซต์ นักออกแบบกราฟิก นักออกแบบมัลติมีเดีย วิศวกรเครือข่าย นักออกแบบระบบเครือข่าย นักบริหารฐานข้อมูลของภาครัฐและเอกชน นักพัฒนาเว็บไซต์ นักวิจัยคอมพิวเตอร์ และประกอบอาชีพเป็นผู้บริหารศูนย์คอมพิวเตอร์ ฯลฯ', 'กองทุนเพื่อการศึกษา', 'กองทุนเงินให้กู้ยืมเพื่อการศึกษา (กยศ.) และ กองทุนเงินกู้ยืมเพื่อการศึกษาที่ผูกกับรายได้ในอนาคต (กรอ.) สามารถกู้เรียนได้ จนจบหลักสูตร', 'คุณภาพ', 'การเรียนการสอน อย่างมืออาชีพฝึกให้ลงมือทำจริง โดยบุคลากรที่มีคุณภาพ ด้วยการสอนที่ทรงคุณภาพ และทันต่อเทคโนโลยีใหม่ๆ ตอนรับ AEC', 'http://www.sau.ac.th/scholarship.html');

-- --------------------------------------------------------

--
-- Table structure for table `tbfreshy`
--

CREATE TABLE `tbfreshy` (
  `id` int(11) NOT NULL,
  `freshy_title` varchar(100) NOT NULL,
  `freshy_text` text NOT NULL,
  `freshy_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbfreshy`
--

INSERT INTO `tbfreshy` (`id`, `freshy_title`, `freshy_text`, `freshy_type`) VALUES
(1, 'วิทยากาคอมพิวเตอร์เรียนอะไรบ้าง', ' การเรียนการสอนของ สาขาวิทยาการคอมพิวเตร์นี้ เรียนเกี่ยวกับซอร์ฟแวร์เป็นหลัก โดยจะเป็นการเรียนเขียนโปรแกรมอัลกอริทึม เช่น ภาษาซี จาวา หรือ database ระบบฐานข้อมูลเป็นการสอน แล้วรวมไปทึกวิชาสามัญ วิทยาศาสตร์ คณิตศาสตร์ ที่จำเป็นต้องเรียน สาขาวิทยาการคอมพิวเตอร์ หลักสูตร 4 ปี ด้วยอาจารย์ผู้สอนที่ มีประสบการณ์ยาวนาน ในสาขาวิชาจะเน้นให้ได้ฝึกปฏิบัติงานจริง และเปิดกว้างสำหรับความสนใจของน้องๆ ทุกคน จะมีอาจารย์ให้คำปรึกษา เพื่อพัมนาความสามารถตามความสนใจของตัวเราเอง และสร้างอนาคตให้กับนักศึกษาทุกคน', ''),
(2, 'จบแล้วทำงานอะไร', 'การเรียนการสอนของ สาขาวิทยาการคอมพิวเตร์นี้ เรียนเกี่ยวกับซอร์ฟแวร์เป็นหลัก โดยจะเป็นการเรียนเขียนโปรแกรมอัลกอริทึม เช่น ภาษาซี จาวา หรือ database ระบบฐานข้อมูลเป็นการสอน แล้วรวมไปทึกวิชาสามัญ วิทยาศาสตร์ คณิตศาสตร์ ที่จำเป็นต้องเรียน สาขาวิทยาการคอมพิวเตอร์ หลักสูตร 4 ปี ด้วยอาจารย์ผู้สอนที่ มีประสบการณ์ยาวนาน ในสาขาวิชาจะเน้นให้ได้ฝึกปฏิบัติงานจริง และเปิดกว้างสำหรับความสนใจของน้องๆ ทุกคน จะมีอาจารย์ให้คำปรึกษา เพื่อพัมนาความสามารถตามความสนใจของตัวเราเอง และสร้างอนาคตให้กับนักศึกษาทุกคน', ''),
(3, 'ค่าใช้จ่าย', '<span style="color:red;">อัตราค่าเล่าเรียนของนักศึกษาใหม่</span><br>\r\n                                    ภาคปกติ หลักสูตร 4 ปี ค่าใช้จ่ายประมาณ 20,640 - 24,800 บาท/เทอม<br>', ''),
(4, 'ทุนการศึกษา', 'ทุนเรียนดี ทุกภาค การศึกษา', ''),
(5, 'การกู้ยิม', 'การเรียนการสอนของ สาขาวิทยาการคอมพิวเตร์นี้ เรียนเกี่ยวกับซอร์ฟแวร์เป็นหลัก โดยจะเป็นการเรียนเขียนโปรแกรมอัลกอริทึม เช่น ภาษาซี จาวา หรือ database ระบบฐานข้อมูลเป็นการสอน แล้วรวมไปทึกวิชาสามัญ วิทยาศาสตร์ คณิตศาสตร์ ที่จำเป็นต้องเรียน สาขาวิทยาการคอมพิวเตอร์ หลักสูตร 4 ปี ด้วยอาจารย์ผู้สอนที่ มีประสบการณ์ยาวนาน ในสาขาวิชาจะเน้นให้ได้ฝึกปฏิบัติงานจริง และเปิดกว้างสำหรับความสนใจของน้องๆ ทุกคน จะมีอาจารย์ให้คำปรึกษา เพื่อพัมนาความสามารถตามความสนใจของตัวเราเอง และสร้างอนาคตให้กับนักศึกษาทุกคน', ''),
(6, 'เปิดเรียนเมื่อไหร่', 'การเรียนการสอนของ สาขาวิทยาการคอมพิวเตร์นี้ เรียนเกี่ยวกับซอร์ฟแวร์เป็นหลัก โดยจะเป็นการเรียนเขียนโปรแกรมอัลกอริทึม เช่น ภาษาซี จาวา หรือ database ระบบฐานข้อมูลเป็นการสอน แล้วรวมไปทึกวิชาสามัญ วิทยาศาสตร์ คณิตศาสตร์ ที่จำเป็นต้องเรียน สาขาวิทยาการคอมพิวเตอร์ หลักสูตร 4 ปี ด้วยอาจารย์ผู้สอนที่ มีประสบการณ์ยาวนาน ในสาขาวิชาจะเน้นให้ได้ฝึกปฏิบัติงานจริง และเปิดกว้างสำหรับความสนใจของน้องๆ ทุกคน จะมีอาจารย์ให้คำปรึกษา เพื่อพัมนาความสามารถตามความสนใจของตัวเราเอง และสร้างอนาคตให้กับนักศึกษาทุกคน', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbgallery`
--

CREATE TABLE `tbgallery` (
  `id` int(11) NOT NULL,
  `gallery_img` varchar(100) NOT NULL,
  `gallery_title` varchar(50) NOT NULL,
  `gallery_text` varchar(200) NOT NULL,
  `gallery_group` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbgallery`
--

INSERT INTO `tbgallery` (`id`, `gallery_img`, `gallery_title`, `gallery_text`, `gallery_group`) VALUES
(30, 'T71_3632.jpg', 'Project Expo ปีการศึกษา 2558', 'งานแสดงโปรเจค นักศึกษา ปี 4', '1002'),
(31, 'Brochure.jpg', 'แข่งขันคอมพิวเตอร์แห่งประเทศไทย NSC2016', '', '1003'),
(32, 'DSCF4897.jpg', 'คืนสู่เหย้า ปีการศึกษา 2558', 'งานรวมรุ่นทุกรุ่น มาพูดคุยกัน', '1004'),
(33, '1462852746855.jpg', 'ทัศนศึกษา ปีการศึกษา 2558', 'ดูงาน ปี 58', '1005'),
(34, 'DSCF4450.jpg', 'ทำบุญสาขาวิชา ปีการศึกษา 2558', 'กิจกรรม ทำบุญประจำปี สาขาวิทกยาการคอมพิวเตอร์', '1006'),
(35, 'IMG_6120.jpg', 'บริการวิชาการ ปีการศึกษา 2558', 'กิจกรรม บำเพ็ญประโยชน์ บางขันแตก', '1007'),
(36, 'DSCF4444.jpg', 'ศิลปศาสตร์และวิทยาศาสตร์ ปีการศึกษา 2558', 'งานกีฬาวิทคอม', '1008');

-- --------------------------------------------------------

--
-- Table structure for table `tbgalleryalbum`
--

CREATE TABLE `tbgalleryalbum` (
  `id` int(11) NOT NULL,
  `ga_img` varchar(50) NOT NULL,
  `ga_group` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbgalleryalbum`
--

INSERT INTO `tbgalleryalbum` (`id`, `ga_img`, `ga_group`) VALUES
(108, 'DSC03754.jpg', '1002'),
(109, 'DSC03755.jpg', '1002'),
(110, 'DSC03756.jpg', '1002'),
(111, 'DSC03757.jpg', '1002'),
(112, 'DSC03759.jpg', '1002'),
(113, 'DSC03760.jpg', '1002'),
(114, 'DSC03762.jpg', '1002'),
(115, 'DSC03765.jpg', '1002'),
(116, 'DSC03766.jpg', '1002'),
(117, 'DSC03767.jpg', '1002'),
(118, 'DSC03810.jpg', '1002'),
(119, 'DSC03840.jpg', '1002'),
(120, 'DSC03843.jpg', '1002'),
(121, 'DSC03845.jpg', '1002'),
(122, 'T71_3442.jpg', '1002'),
(123, 'T71_3444.jpg', '1002'),
(124, 'T71_3445.jpg', '1002'),
(125, 'T71_3446.jpg', '1002'),
(126, 'T71_3451.jpg', '1002'),
(128, 'T71_3461.jpg', '1002'),
(129, 'T71_3522.jpg', '1002'),
(130, 'T71_3523.jpg', '1002'),
(131, 'T71_3557.jpg', '1002'),
(132, 'T71_3566.jpg', '1002'),
(133, 'T71_3567.jpg', '1002'),
(134, 'T71_3632.jpg', '1002'),
(135, 'T71_3633.jpg', '1002'),
(136, 'T71_3642.jpg', '1002'),
(137, 'T71_3643.jpg', '1002'),
(138, 'T71_3644.jpg', '1002'),
(139, 'T71_3648.jpg', '1002'),
(140, 'T71_3649.jpg', '1002'),
(141, 'T71_3657.jpg', '1002'),
(142, 'T71_3662.jpg', '1002'),
(143, 'T71_3665.jpg', '1002'),
(144, '12443878_10205608607881678_1262234036_o.jpg', '1003'),
(145, '12516746_10205608608641697_86693938_o.jpg', '1003'),
(146, '12544704_10205396395816509_437691783_o.jpg', '1003'),
(147, '12745822_10205606100098985_85559754933854253_n.jpg', '1003'),
(148, '12751709_10205608608881703_2086190738_o.jpg', '1003'),
(149, '12755260_10205608610641747_1405767750_o.jpg', '1003'),
(150, 'Brochure.jpg', '1003'),
(151, 'DSCF4823.jpg', '1004'),
(152, 'DSCF4829.jpg', '1004'),
(153, 'DSCF4830.jpg', '1004'),
(154, 'DSCF4835.jpg', '1004'),
(155, 'DSCF4837.jpg', '1004'),
(156, 'DSCF4840.jpg', '1004'),
(157, 'DSCF4841.jpg', '1004'),
(158, 'DSCF4844.jpg', '1004'),
(159, 'DSCF4846.jpg', '1004'),
(160, 'DSCF4850.jpg', '1004'),
(161, 'DSCF4853.jpg', '1004'),
(162, 'DSCF4854.jpg', '1004'),
(163, 'DSCF4866.jpg', '1004'),
(164, 'DSCF4868.jpg', '1004'),
(165, 'DSCF4871.jpg', '1004'),
(166, 'DSCF4873.jpg', '1004'),
(167, 'DSCF4874.jpg', '1004'),
(168, 'DSCF4877.jpg', '1004'),
(169, 'DSCF4887.jpg', '1004'),
(170, 'DSCF4888.jpg', '1004'),
(171, 'DSCF4890.jpg', '1004'),
(172, 'DSCF4895.jpg', '1004'),
(173, 'DSCF4897.jpg', '1004'),
(174, 'DSCF4901.jpg', '1004'),
(175, 'DSCF4906.jpg', '1004'),
(176, 'DSCF4908.jpg', '1004'),
(177, 'DSCF4910.jpg', '1004'),
(178, 'DSCF4912.jpg', '1004'),
(179, 'DSCF4915.jpg', '1004'),
(180, 'DSCF4920.jpg', '1004'),
(181, 'DSCF4921.jpg', '1004'),
(182, 'DSCF4922.jpg', '1004'),
(183, 'DSCF4927.jpg', '1004'),
(184, 'DSCF4929.jpg', '1004'),
(185, 'DSCF4930.jpg', '1004'),
(186, 'DSCF4936.jpg', '1004'),
(187, 'DSCF4942.jpg', '1004'),
(188, 'DSCF4945.jpg', '1004'),
(189, 'DSCF4952.jpg', '1004'),
(190, 'DSCF4954.jpg', '1004'),
(191, 'DSCF4955.jpg', '1004'),
(192, 'DSCF4956.jpg', '1004'),
(193, 'DSCF4958.jpg', '1004'),
(194, 'DSCF4959.jpg', '1004'),
(195, 'DSCF4961.jpg', '1004'),
(196, 'DSCF4962.jpg', '1004'),
(197, 'DSCF4965.jpg', '1004'),
(198, 'DSCF4966.jpg', '1004'),
(199, 'DSCF4969.jpg', '1004'),
(200, 'DSCF4970.jpg', '1004'),
(201, 'DSCF4973.jpg', '1004'),
(202, 'DSCF4976.jpg', '1004'),
(203, 'DSCF4977.jpg', '1004'),
(204, 'DSCF4979.jpg', '1004'),
(205, 'DSCF4985.jpg', '1004'),
(206, 'DSCF4986.jpg', '1004'),
(207, 'DSCF4987.jpg', '1004'),
(208, 'DSCF4994.jpg', '1004'),
(209, 'DSCF4996.jpg', '1004'),
(210, 'DSCF4999.jpg', '1004'),
(211, '20160316_132738.jpg', '1005'),
(212, '20160316_132802.jpg', '1005'),
(213, '20160316_132828.jpg', '1005'),
(214, '20160316_133611.jpg', '1005'),
(215, '20160316_133612.jpg', '1005'),
(216, '20160316_133613.jpg', '1005'),
(217, '20160316_133614.jpg', '1005'),
(218, '20160316_133615.jpg', '1005'),
(219, '20160316_133616.jpg', '1005'),
(220, '1462852713873.jpg', '1005'),
(221, '1462852716124.jpg', '1005'),
(222, '1462852717544.jpg', '1005'),
(223, '1462852719614.jpg', '1005'),
(224, '1462852721057.jpg', '1005'),
(225, '1462852722463.jpg', '1005'),
(226, '1462852724579.jpg', '1005'),
(227, '1462852725896.jpg', '1005'),
(228, '1462852727221.jpg', '1005'),
(229, '1462852729421.jpg', '1005'),
(230, '1462852731447.jpg', '1005'),
(231, '1462852733043.jpg', '1005'),
(232, '1462852734517.jpg', '1005'),
(233, '1462852735839.jpg', '1005'),
(234, '1462852737930.jpg', '1005'),
(235, '1462852739607.jpg', '1005'),
(236, '1462852741091.jpg', '1005'),
(237, '1462852743490.jpg', '1005'),
(238, '1462852745284.jpg', '1005'),
(239, '1462852746855.jpg', '1005'),
(240, '1462852748514.jpg', '1005'),
(241, 'DSCF4450.jpg', '1006'),
(242, 'DSCF4451.jpg', '1006'),
(243, 'DSCF4452.jpg', '1006'),
(244, 'DSCF4453.jpg', '1006'),
(245, 'DSCF4454.jpg', '1006'),
(246, 'DSCF4455.jpg', '1006'),
(247, 'DSCF4456.jpg', '1006'),
(248, 'DSCF4457.jpg', '1006'),
(249, 'DSCF4458.jpg', '1006'),
(250, 'DSCF4459.jpg', '1006'),
(251, 'DSCF4460.jpg', '1006'),
(252, 'DSCF4461.jpg', '1006'),
(253, 'DSCF4462.jpg', '1006'),
(254, 'DSCF4463.jpg', '1006'),
(255, 'DSCF4464.jpg', '1006'),
(256, 'DSCF4465.jpg', '1006'),
(257, 'DSCF4466.jpg', '1006'),
(258, 'DSCF4467.jpg', '1006'),
(259, 'DSCF4468.jpg', '1006'),
(260, 'DSCF4469.jpg', '1006'),
(261, 'DSCF4470.jpg', '1006'),
(262, 'DSCF4471.jpg', '1006'),
(263, 'DSCF4472.jpg', '1006'),
(264, 'DSCF4473.jpg', '1006'),
(265, 'DSCF4474.jpg', '1006'),
(266, 'DSCF4475.jpg', '1006'),
(267, 'DSCF4476.jpg', '1006'),
(268, 'DSCF4477.jpg', '1006'),
(269, 'DSCF4478.jpg', '1006'),
(270, 'DSCF4479.jpg', '1006'),
(271, 'DSCF4480.jpg', '1006'),
(272, 'DSCF4481.jpg', '1006'),
(273, 'DSCF4482.jpg', '1006'),
(274, 'DSCF4483.jpg', '1006'),
(275, 'DSCF4484.jpg', '1006'),
(276, 'DSCF4485.jpg', '1006'),
(277, 'DSCF4486.jpg', '1006'),
(278, 'DSCF4487.jpg', '1006'),
(279, 'DSCF4488.jpg', '1006'),
(280, 'DSCF4489.jpg', '1006'),
(281, 'DSCF4490.jpg', '1006'),
(282, 'DSCF4491.jpg', '1006'),
(283, 'DSCF4492.jpg', '1006'),
(284, 'DSCF4493.jpg', '1006'),
(285, 'DSCF4494.jpg', '1006'),
(286, 'DSCF4495.jpg', '1006'),
(287, 'DSCF4496.jpg', '1006'),
(288, 'DSCF4497.jpg', '1006'),
(289, 'DSCF4498.jpg', '1006'),
(290, 'DSCF4499.jpg', '1006'),
(291, 'DSCF4500.jpg', '1006'),
(292, 'DSCF4501.jpg', '1006'),
(293, 'DSCF4502.jpg', '1006'),
(294, 'DSCF4503.jpg', '1006'),
(295, 'DSCF4504.jpg', '1006'),
(296, 'DSCF4505.jpg', '1006'),
(297, 'DSCF4506.jpg', '1006'),
(298, 'DSCF4507.jpg', '1006'),
(299, 'DSCF4508.jpg', '1006'),
(300, 'DSCF4509.jpg', '1006'),
(301, 'DSCF4510.jpg', '1006'),
(302, 'DSCF4511.jpg', '1006'),
(303, 'DSCF4512.jpg', '1006'),
(304, 'DSCF4513.jpg', '1006'),
(305, 'DSCF4514.jpg', '1006'),
(306, 'DSCF4515.jpg', '1006'),
(307, 'DSCF4516.jpg', '1006'),
(308, 'DSCF4517.jpg', '1006'),
(309, 'DSCF4518.jpg', '1006'),
(310, 'DSCF4519.jpg', '1006'),
(311, 'DSCF4520.jpg', '1006'),
(312, 'DSCF4521.jpg', '1006'),
(313, 'DSCF4628.jpg', '1006'),
(314, 'DSCF4631.jpg', '1006'),
(315, 'DSCF4632.jpg', '1006'),
(316, 'DSCF4638.jpg', '1006'),
(317, 'DSCF4657.jpg', '1006'),
(318, 'DSCF4660.jpg', '1006'),
(319, 'DSCF4663.jpg', '1006'),
(320, 'DSCF4664.jpg', '1006'),
(321, 'DSCF4667.jpg', '1006'),
(322, 'DSCF4670.jpg', '1006'),
(323, 'DSCF4675.jpg', '1006'),
(324, 'DSCF4676.jpg', '1006'),
(325, 'DSCF4680.jpg', '1006'),
(326, 'DSCF4681.jpg', '1006'),
(327, 'DSCF4685.jpg', '1006'),
(328, 'DSCF4686.jpg', '1006'),
(329, 'IMG_5922.jpg', '1007'),
(330, 'IMG_5923.jpg', '1007'),
(331, 'IMG_5926.jpg', '1007'),
(332, 'IMG_5930.jpg', '1007'),
(333, 'IMG_5940.jpg', '1007'),
(334, 'IMG_5941.jpg', '1007'),
(335, 'IMG_5945.jpg', '1007'),
(336, 'IMG_5948.jpg', '1007'),
(337, 'IMG_5957.jpg', '1007'),
(338, 'IMG_5960.jpg', '1007'),
(339, 'IMG_5961.jpg', '1007'),
(340, 'IMG_5965.jpg', '1007'),
(341, 'IMG_6012.jpg', '1007'),
(342, 'IMG_6016.jpg', '1007'),
(343, 'IMG_6023.jpg', '1007'),
(344, 'IMG_6031.jpg', '1007'),
(345, 'IMG_6033.jpg', '1007'),
(346, 'IMG_6057.jpg', '1007'),
(347, 'IMG_6062.jpg', '1007'),
(348, 'IMG_6071.jpg', '1007'),
(349, 'IMG_6077.jpg', '1007'),
(350, 'IMG_6087.jpg', '1007'),
(351, 'IMG_6120.jpg', '1007'),
(352, 'IMG_6122.jpg', '1007'),
(353, 'IMG_6123.jpg', '1007'),
(354, 'IMG_6125.jpg', '1007'),
(355, 'IMG_6126.jpg', '1007'),
(356, 'IMG_6128.jpg', '1007'),
(357, 'IMG_6129.jpg', '1007'),
(358, 'IMG_6131.jpg', '1007'),
(359, 'IMG_6132.jpg', '1007'),
(360, 'IMG_6143.jpg', '1007'),
(361, 'IMG_6146.jpg', '1007'),
(362, 'IMG_6147.jpg', '1007'),
(363, 'IMG_6148.jpg', '1007'),
(364, 'IMG_6165.jpg', '1007'),
(365, 'IMG_6167.jpg', '1007'),
(366, 'IMG_6168.jpg', '1007'),
(367, 'IMG_6169.jpg', '1007'),
(368, 'IMG_6171.jpg', '1007'),
(369, 'IMG_6178.jpg', '1007'),
(370, 'IMG_6188.jpg', '1007'),
(371, 'IMG_6189.jpg', '1007'),
(372, 'IMG_6190.jpg', '1007'),
(373, 'IMG_6191.jpg', '1007'),
(374, 'IMG_6192.jpg', '1007'),
(375, 'IMG_6193.jpg', '1007'),
(376, 'IMG_6194.jpg', '1007'),
(377, 'IMG_6195.jpg', '1007'),
(378, 'IMG_6196.jpg', '1007'),
(379, 'IMG_6197.jpg', '1007'),
(380, 'IMG_6198.jpg', '1007'),
(381, 'IMG_6199.jpg', '1007'),
(382, 'IMG_6200.jpg', '1007'),
(383, 'IMG_6201.jpg', '1007'),
(384, 'IMG_6202.jpg', '1007'),
(385, 'IMG_6203.jpg', '1007'),
(386, 'IMG_6204.jpg', '1007'),
(387, 'IMG_6205.jpg', '1007');

-- --------------------------------------------------------

--
-- Table structure for table `tbgoal`
--

CREATE TABLE `tbgoal` (
  `id` int(11) NOT NULL,
  `goal_title` varchar(100) NOT NULL,
  `goal_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbgoal`
--

INSERT INTO `tbgoal` (`id`, `goal_title`, `goal_text`) VALUES
(1, 'จุดมุ่งหมาย', '<b>ปรัชญา</b>\r\n                        <p>\r\n                            สาขาวิทยาการคอมพิวเตอร์มุ่งเน้นพัฒนา ด้านการศึกษา การทำงานเป็นทีม เคารพต่อกฎกติกา พัฒนาแนวคิดต่อยอดไปสู่ระดับสากล\r\n                        </p>\r\n                        <br>\r\n                        <b>วิสัยทัศน์</b>\r\n                        <p>\r\n                            สาขาวิทยาการคอมพิวเตอร์ มุ่งเน้นผลิกบัณฑิตที่มีความคิดสร้างสรรค์ พุ่งเน้นพัฒนาด้านการศึกษา และการบริหารงานทางด้านวิชาการ เพื่อให้บัณฑิตมีความพร้อม เข้าสู้มาตรฐานสากล\r\n                        </p>\r\n                        <br>\r\n                        <b>วัตถุประสงค์</b>\r\n                        <p>\r\n                        <ul style="padding-left:30px;">\r\n                            <li>เพื่อผลิตบัณฑิตที่มีความรู้ความสามารถด้านวิทยาการคอมพิวเตอร์ สามารถนำความรู้ไปประยุกต์ในการปฏิบัติงานได้\r\n                                ทั้งในภาครัฐบาล และภาคธุรกิจเอกชน</li>\r\n                            <li>เพื่อส่งเสริมการพัฒนาทรัพยากรบุคคลที่มีคุณธรรม จริยธรรม สามารถประกอบอาชีพดำรงชีวิต และปฏิบัติงาน\r\n                                ในสังคมส่วนรวมได้อย่างมีความสุข</li>\r\n                            <li>เพื่อส่งเสริม และสนับสนุน การวิจัยและพัฒนาด้านวิทยาการคอมพิวเตอร์ หรือสาขาที่เกี่ยวข้อง เพื่อการพัฒนาสังคม และประเทศชาติ</li>\r\n                        </ul>\r\n                        </p>');

-- --------------------------------------------------------

--
-- Table structure for table `tbguarantee`
--

CREATE TABLE `tbguarantee` (
  `id` int(11) NOT NULL,
  `guarantee_title` varchar(100) NOT NULL,
  `guarantee_text` text NOT NULL,
  `guarantee_link` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbguarantee`
--

INSERT INTO `tbguarantee` (`id`, `guarantee_title`, `guarantee_text`, `guarantee_link`) VALUES
(1, 'การประเมินคุณภาพภายใน  ปีการศึกษา 2557', '<p> ปัจจุบันเทคโนโลยีเข้ามามีบทบาทอย่างมากในการดำเนินชีวิต โดยเฉพาะเทคโนโลยีด้านคอมพิวเตอร์ที่มีความก้าวหน้าและเปลี่ยนแปลงไปอย่างรวดเร็วมาก ดังนั้น สาขาวิชาวิทยาการคอมพิวเตอร์ได้มีเป้าหมายอย่างชัดเจนที่จะพัฒนาหลักสูตรให้ทันสมัยต่อการเปลี่ยนแปลง ในขณะเดียวกันบัณฑิตที่ผลิตออกไปจะต้องมีความรู้ความสามารถด้านการเขียนโปรแกรมระบบฐานข้อมูล ระบบเครือข่ายการสื่อสารคอมพิวเตอร์ การวิเคราะห์ การพัฒนาซอฟแวร์ที่ทันสมัย ให้ตรงกับความต้องการของผู้ที่จะนำไปใช้ในองค์กรให้มากที่สุด เพื่อเกิดความสอดคล้องกับตลาดแรงงาน\r\n</p>\r\n<h3>  ชื่อหลักสูตร</h3>\r\n<p>วิทยาศาสตรบัณฑิต สาขาวิชาวิทยาการคอมพิวเตอร์<br>Bachelor of Science Program in Computer Science</p>', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbheader`
--

CREATE TABLE `tbheader` (
  `id` int(11) NOT NULL,
  `header_tel` varchar(50) NOT NULL,
  `header_email` varchar(50) NOT NULL,
  `header_logo` varchar(50) NOT NULL,
  `header_facebook` varchar(50) NOT NULL,
  `header_google` varchar(50) NOT NULL,
  `header_regis` varchar(50) NOT NULL,
  `header_icon_1` varchar(20) NOT NULL,
  `header_icon_2` varchar(20) NOT NULL,
  `header_social_link` varchar(100) NOT NULL,
  `header_icon_social` varchar(100) NOT NULL,
  `header_social_link2` varchar(100) NOT NULL,
  `header_icon_social2` varchar(100) NOT NULL,
  `header_social_link3` varchar(100) NOT NULL,
  `header_icon_social3` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbheader`
--

INSERT INTO `tbheader` (`id`, `header_tel`, `header_email`, `header_logo`, `header_facebook`, `header_google`, `header_regis`, `header_icon_1`, `header_icon_2`, `header_social_link`, `header_icon_social`, `header_social_link2`, `header_icon_social2`, `header_social_link3`, `header_icon_social3`) VALUES
(1, '02-807-4594', 'comsci@sau.ac.th', 'science.png', 'google.com', 'google.com', 'google.com', 'fa fa-phone', 'fa fa-envelope', 'https://plus.google.com/u/2/?hl=th', 'fa fa-google', 'https://www.facebook.com/saucomsci/?fref=ts', 'fa fa-facebook', 'https://www.instagram.com/comscisau/', 'fa fa-registered'),
(2, '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3, '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbhistory`
--

CREATE TABLE `tbhistory` (
  `id` int(11) NOT NULL,
  `history_title` varchar(50) NOT NULL,
  `history_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbhistory`
--

INSERT INTO `tbhistory` (`id`, `history_title`, `history_text`) VALUES
(1, 'ประวัติความเป็นมา', '<span style="margin-left:5em;"></span>  คณะศิลปศาสตร์และวิทยาศาสตร์ มหาวิทยาลัยเอเชียอาคเนย์ ได้รับอนุมัติให้จัดตั้งขึ้นเมื่อปี พ.ศ.2538 โดยยกฐานะจากภาควิชาสามัญ ที่มีหน้าที่สนับสนุนส่งเสริมการเรียนการสอนให้กับนักศึกษาระดับประกาศนียบัตรวิชาชีพชั้นสูง (ป.วส.) และหมวดวิชาศึกษาทั่วไปให้กับนักศึกษาระดับปริญญาตรีทุกสาขาวิชาที่เปิดทำการเรียนการสอนในมหาวิทยาลัยเอเชียอาคเนย์ในขณะนั้น <br> <br>\r\n\r\n                    <span style="margin-left:5em;"></span>ในปีการศึกษา 2538 คณะศิลปศาสตร์และวิทยาศาสตร์ ได้รับอนุมัติให้เปิดทำการเรียนการสอน หลักสูตร 4 ปี จำนวน 2 หลักสูตร คือ หลักสูตรศิลปศาสตรบัณฑิต สาขาวิชาภาษาอังกฤษธุรกิจและหลักสูตรวิทยาศาสตรบัณฑิต สาขาวิชาวิทยาการคอมพิวเตอร์<br><br>\r\n\r\n                   <span style="margin-left:5em;"></span> ในปี พ.ศ. 2547 ได้รับอนุมัติให้เปิดทำการเรียนการสอนเพิ่มอีกหนึ่งหลักสูตร คือ หลักสูตรรัฐประศาสนศาสตรบัณฑิต สาขาวิชารัฐประศาสนศาสตร์ คณะศิลปศาสตร์และวิทยาศาสตร์ได้รับอนุมัติให้เปิดทำการเรียนการสอนหลักสูตรรัฐประศาสนศาสตรมหาบัณฑิต เพิ่มอีก 1 หลักสูตร ได้เปิดดำเนินการเมื่อวันที่ 1 พฤษภาคม 2543 และเปิดรับนักศึกษารุ่นแรกในภาคการศึกษาที่ 2/2543<br><br>\r\n\r\n                    <span style="margin-left:5em;"></span>ปีการศึกษา 2553 คณะศิลปศาสตร์และวิทยาศาสตร์ ได้รับอนุมัติจากสภามหาวิทยาลัยเอเชียอาคเนย์ ให้จัดตั้งศูนย์บริการการศึกษานอกสถานที่ตั้ง หลักสูตรรัฐประศาสนศาสตรบัณฑิต สาขาวิชารัฐประศาสนศาสตร์ ณ วิทยาลัยเกษตรและเทคโนโลยีสุพรรณบุรี อำเภอด่านช้าง จังหวัดสุพรรณบุรี เมื่อวันที่ 1 กรกฏาคม 2553 และเปิดรับนักศึกษารุ่นแรกในภาคการศึกษาที่ 1/2553 คณะศิลปศาสตร์และวิทยาศาสตร์ เป็นคณะวิชาที่มุ่งผลิตบัณฑิตที่มีคุณภาพด้านเทคโนโลยีภาษา ความเป็นผู้นำ และจริยธรรม โดยมีพันธกิจหลัก 4 ด้าน คือ การผลิตบัณฑิต การวิจัย การบริการวิชาการและการทำนุบำรุงศิลปวัฒนธรรม นอกจากหน้าที่หลัก คือการผลิตบัณฑิต โดยการจัดการเรียนการสอน สาขาวิชาภาษาอังกฤษธุรกิจ สาขาวิชาวิทยาการคอมพิวเตอร์ และสาขาวิชารัฐประศาสนศาสตร์ ทั้งระดับปริญญาตรี และปริญญาโท แล้วคณะศิลปศาสตร์ฯ ยังมีหน้าที่ในการจัดการเรียนการสอนรายวิชาในหมวดวิชาศึกษาทั่วไป ให้แก่ สาขาวิชาที่เปิดทำการเรียนการสอนในมหาวิทยาลัยฯ อีกส่วนหนึ่งด้วย ทั้งนี้ เพื่อสนองนโยบายและวัตถุประสงค์ของสภามหาวิทยาลัยและคณะกรรมการการอุดมศึกษา ในการที่จะพัฒนานักศึกษาในสาขา วิชาชีพให้ได้เรียนรู้ถึงวิวัฒนาการและอารยธรรมของมนุษย์ที่เกี่ยวกับสังคมและประเทศชาติ ตลอดจน การปรับตัวเพื่อให้รู้จักสิทธิและหน้าที่ของตนเองในฐานะพลเมือง การอยู่ร่วมกันในสังคม แนวทางการ ใช้ชีวิตที่มีความรับผิดชอบต่อตนเอง และสังคม');

-- --------------------------------------------------------

--
-- Table structure for table `tbnews`
--

CREATE TABLE `tbnews` (
  `id` int(11) NOT NULL,
  `news_title` varchar(100) NOT NULL,
  `news_text` text NOT NULL,
  `news_img` varchar(100) NOT NULL,
  `news_date` date NOT NULL,
  `news_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbnews`
--

INSERT INTO `tbnews` (`id`, `news_title`, `news_text`, `news_img`, `news_date`, `news_type`) VALUES
(13, 'Network Game 2558', 'กิจกรรม สำหรับวิทยาการคอมพิวเตอร์ จะมีการไป แข่งกีฬาต่างมหาลัย', '11986464_1007715335939310_6533255047558080012_n.jpg', '2015-08-16', 'กิจกรรม'),
(14, 'SAU Night', 'งานกินเลี้ยงสาขาวิทยาการคอมพิวเตอร์ ประจำปี รวม วิทคอมทุกๆรุ่น มาคุยกัน มาแชร์ประสบการ พบประรุ่นน้อง ให้คำแนนำ เราจะมีกันทุกปี กิจกรรมครอบครัววิทคอม', 'DSCF4985.jpg', '2016-07-16', 'กิจกรรม'),
(15, 'ทัศนศึกษา', 'กิจกรรมทัศนศึกษาประจำปีการศึกษา 2557 โดยนำนักศึกษาสาขาวิทยาการคอมพิวเตอร์ ชั้นปีที่ 4 ทัศนศีกษา ณ บริษัทไทยเพรสซิเด้นฟู๊ด จังหวัดชลบุรี  ', '1462852737930.jpg', '2016-06-10', 'กิจกรรม'),
(16, 'กิจกรรมรับน้อง 2559', 'มหาวิทยาลัยเอเชียอาคเนย์  มีกิจกรรมรับน้องปี 2559 กิจกรรมรับน้องสาขาวิทยาการคอมพิวเตอร์ ประจำปีการศึกษา 2558 โดยกิจกรรมนี้จัดขึ้นเพื่อเสริมสร้างความสัมพันธ์ระหว่างนักศึกษาใหม่ด้วยกัน และนักศึกษารุ่นพี่  ', '3.jpg', '2016-08-17', 'กิจกรรม');

-- --------------------------------------------------------

--
-- Table structure for table `tbproject4`
--

CREATE TABLE `tbproject4` (
  `id` int(11) NOT NULL,
  `project_title` varchar(100) NOT NULL,
  `project_text` text NOT NULL,
  `project_img` varchar(100) NOT NULL,
  `project_link` varchar(100) NOT NULL,
  `project_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbproject4`
--

INSERT INTO `tbproject4` (`id`, `project_title`, `project_text`, `project_img`, `project_link`, `project_type`) VALUES
(22, 'ระบบบริการจัดการสื่อการเรียนการสอน', 'ระบบบริการจัดการสื่อการเรียนการสอนในลักษณะสังคมออนไลน์ โดยสามารถเข้าถึงระบบผ่านเว็บและโทรศัพท์มือ ระบบปฎิบัติการแอนดรอยได้ ระบบนี้พัฒนาด้วย JAVA Servlet และ JAVA for Android', '222.jpg', '', 'Web'),
(23, 'nMemo', 'แอพลิเคชั่นเพื่อตอบสนอง ต่อผุ้ใช้งาน ที่ต้องการรับระทานยา แต่อาจจะลืมทานยาด้วยเหตุผลต่าง เป็นการเตือนให้ผู้สูงอายุ หรือ ผู้ป่วยที่ต้องการรับประทานยาได้รับประทานยาถูกต้องตามเวลา หากไม่ถูกต้องตรงเวลาก็จะมีการแจ้งเตือนไปยังญาติ หรือผู้ใกล้ชิดที่ได้กำหนดไว้ได้', 'Brochure.jpg', '', 'Aplication'),
(24, 'Aduino', '', 're.jpg', '', 'Aduino');

-- --------------------------------------------------------

--
-- Table structure for table `tbproject4_type`
--

CREATE TABLE `tbproject4_type` (
  `id` int(11) NOT NULL,
  `project_type_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbproject4_type`
--

INSERT INTO `tbproject4_type` (`id`, `project_type_name`) VALUES
(1, 'All'),
(3, 'Aplication'),
(4, 'Web '),
(8, 'Aduino');

-- --------------------------------------------------------

--
-- Table structure for table `tbprojectt`
--

CREATE TABLE `tbprojectt` (
  `id` int(11) NOT NULL,
  `pt_title` varchar(100) NOT NULL,
  `pt_text` text NOT NULL,
  `pt_img` varchar(100) NOT NULL,
  `pt_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbprojectt`
--

INSERT INTO `tbprojectt` (`id`, `pt_title`, `pt_text`, `pt_img`, `pt_name`) VALUES
(2, 'การวิเคราะห์การใช้คาร์บอนคาร์บอนฟุตปรินท์ในชั้นเรียนด้วยชั้นเรียนด้วยชั้นเรียนสีเขียว', '<a href="https://drive.google.com/file/d/0Bw2D3DUodq7vTG9IYldVMFJTLWdmU3ZqNWtOYkk1b3pCNEVZ/view">ดูเพิ่มเติม</a>', 'pp.PNG', ''),
(3, 'The Review on Decision Tree Applications in Thailand', '<a href="https://drive.google.com/file/d/0Bw2D3DUodq7vNi1nN0xBNGg1d1gxMlVqY3hOY1MyQ0J6VXRV/view">ดูเพิ่มเติม</a>', 'p.PNG', ''),
(6, 'การประยกต์ใช้ Augmented Reality บนโทรศัพท์มือถือ เพื่อพัฒนานวัตกรรมการเรียนการสอน', '<a href="https://drive.google.com/file/d/0Bw2D3DUodq7vVVlGQVpFY3c4REpRMUpfNkVnMHM5clpqUmVN/view">ดูเพิ่มเติม</a>', 'a.PNG', ''),
(8, 'ระบบเตือนการรับประทานยาสำหรับผู้สูงอายุ', '<a href="https://drive.google.com/file/d/0Bw2D3DUodq7vaHNxanpEcUtadlM1Yl9SemsxcThJNEdJWUJJ/view">ดูเพิ่มเติม</a>', 'c.PNG', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbpromote`
--

CREATE TABLE `tbpromote` (
  `id` int(11) NOT NULL,
  `fancy_img` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbpromote`
--

INSERT INTO `tbpromote` (`id`, `fancy_img`) VALUES
(24, 'f1.jpg'),
(25, 'f2.jpg'),
(26, 'f3.jpg'),
(27, 'f4.jpg'),
(28, 'f5.jpg'),
(29, 'f6.jpg'),
(30, 'run.jpg'),
(31, 'BOY.jpg'),
(32, 'joy.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbrightmenu`
--

CREATE TABLE `tbrightmenu` (
  `id` int(11) NOT NULL,
  `right_link` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbrightmenu`
--

INSERT INTO `tbrightmenu` (`id`, `right_link`) VALUES
(1, '<!--Video-->                                      \r\n<div class="panel panel-primary animated fadeIn ">\r\n            <div class="panel-heading"><i class="fa fa-play-circle"></i>VDO Suggest</div>\r\n            <div class="video">\r\n                <iframe  src="https://www.youtube.com/embed/5gMi3rSjHoM" frameborder="0" allowfullscreen></iframe>\r\n            </div>\r\n</div>\r\n\r\n  <!--Text--> \r\n<!--                                     \r\n<div class="panel panel-primary animated fadeIn">\r\n        <div class="panel-heading "><i class="fa fa-align-left"></i> TEXT SHOW</div>\r\n            <div class="panel-body">\r\n                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atomus, appellat dedocendi omnes quoddam atomos. Vestra. Corrupti sensum multa dissentiet uberius displicet medeam, efficiatur quaeque saluto sollicitare arbitraretur conectitur chaere, deorum consiliisque arbitrer doctrina nasci. Odia malis, scipio, libido. Iudico graviter seditione hoc. Venustate.\r\n                 </p>\r\n           </div>\r\n</div>  -->\r\n\r\n<!--Fanpage facebook-->');

-- --------------------------------------------------------

--
-- Table structure for table `tbsection_box`
--

CREATE TABLE `tbsection_box` (
  `id` int(11) NOT NULL,
  `section_title` varchar(100) NOT NULL,
  `section_text` varchar(200) NOT NULL,
  `section_link` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbsection_box`
--

INSERT INTO `tbsection_box` (`id`, `section_title`, `section_text`, `section_link`) VALUES
(1, '<b>*Computer Science</b>  <small> วิทยาการคอมพิวเตอร์</small>', 'Southeat Asia University เปิดรับนักศึกษาปีการศึกษา 2559 ณ บัดนนี้2', 'http://xeon.sau.ac.th/Entonline/RegisterOn.aspx');

-- --------------------------------------------------------

--
-- Table structure for table `tbslideheader`
--

CREATE TABLE `tbslideheader` (
  `id` int(11) NOT NULL,
  `slideheader_title` varchar(100) NOT NULL,
  `slideheader_text` text NOT NULL,
  `slideheader_img` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbslideheader`
--

INSERT INTO `tbslideheader` (`id`, `slideheader_title`, `slideheader_text`, `slideheader_img`) VALUES
(1, 'WELCOME TO COMSCI @SAU', 'ยินดีตอนรับน้องใหม่ ปี 59 ทุกคนเข้าสู่ครอบครัววิทย์คอม', 'ssss.jpg'),
(2, 'วิทยาการคอมพิเตอร์ ', 'เน้นการปฎิบัติงานจริง เขียนจริง ทำจริง Error บ่อยจริง แก้กันมันส์', 'studio.jpg'),
(3, 'ศึกษาดูงาน', 'เพิ่มประสบการณ์ เตรียมพร้อมสู่การทำงานจริง', 'head3.jpg'),
(4, 'เรียนดีกีฬาเด่น', 'ตั้งใจเรียน จบ4 ปี  แน่นอน', 'h5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbsubject_choice`
--

CREATE TABLE `tbsubject_choice` (
  `id` int(11) NOT NULL,
  `elective` varchar(150) NOT NULL,
  `code_elective` varchar(20) NOT NULL,
  `credits_elective` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbsubject_choice`
--

INSERT INTO `tbsubject_choice` (`id`, `elective`, `code_elective`, `credits_elective`) VALUES
(1, ' นักศึกษาจะต้องเลือกวิชาใดๆ อย่างน้อย 6 หน่วยกิต จากวิชาในระดับปริญญาตรี ที่เปิดสอนใน\r\n    มหาวิทยาลัยเอเชียอาคเนย์', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbsubject_group`
--

CREATE TABLE `tbsubject_group` (
  `id` int(11) NOT NULL,
  `group_title` varchar(20) NOT NULL,
  `typecourse` varchar(100) NOT NULL,
  `credits_type` varchar(20) NOT NULL,
  `subject_normal` varchar(100) NOT NULL,
  `credits_normal` varchar(20) NOT NULL,
  `subject_speci` varchar(100) NOT NULL,
  `credits_speci` varchar(20) NOT NULL,
  `subject_choice` varchar(100) NOT NULL,
  `credits_choice` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbsubject_group`
--

INSERT INTO `tbsubject_group` (`id`, `group_title`, `typecourse`, `credits_type`, `subject_normal`, `credits_normal`, `subject_speci`, `credits_speci`, `subject_choice`, `credits_choice`) VALUES
(1, '', 'หมวดวิชาศึกษาทั่วไป', '31', 'กลุ่มวิชามนุษยศาสตร์', '6', ' วิชาพื้นฐานทางวิชาชีพ', '33', ' หมวดวิชาเลือกเสรี', '6'),
(2, '', 'หมวดวิชาเฉพาะ', '93', 'กลุ่มวิชาสังคมศาสตร์', '6', 'วิชาเอกบังคับ', '36', '', ''),
(3, '', 'หมวดวิชาเลือกเสรี', '6', 'กลุ่มวิชาภาษา', '12', 'วิชาเอกเลือก', '24', '', ''),
(4, '', '', '', 'กลุ่มวิชาวิทยาศาสตร์และคณิตศาสตร์', '6', '', '', '', ''),
(5, '', '', '', 'กลุ่มวิชาพลศึกษาและนันทนาการ', '1', '', '', '', ''),
(7, '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbsubject_normal`
--

CREATE TABLE `tbsubject_normal` (
  `id` int(11) NOT NULL,
  `humanities` varchar(110) NOT NULL,
  `code_human` varchar(20) NOT NULL,
  `credits_human` varchar(20) NOT NULL,
  `social` varchar(110) NOT NULL,
  `code_social` varchar(20) NOT NULL,
  `credits_social` varchar(20) NOT NULL,
  `language` varchar(110) NOT NULL,
  `code_language` varchar(20) NOT NULL,
  `credits_language` varchar(20) NOT NULL,
  `science` varchar(110) NOT NULL,
  `code_science` varchar(20) NOT NULL,
  `credits_science` varchar(20) NOT NULL,
  `physical` varchar(110) NOT NULL,
  `code_physical` varchar(20) NOT NULL,
  `credits_physical` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbsubject_normal`
--

INSERT INTO `tbsubject_normal` (`id`, `humanities`, `code_human`, `credits_human`, `social`, `code_social`, `credits_social`, `language`, `code_language`, `credits_language`, `science`, `code_science`, `credits_science`, `physical`, `code_physical`, `credits_physical`) VALUES
(1, 'ดนตรีกับชีวิต (Music and Life)', '500101', '3(3-0-6)', 'จิตวิทยาทั่วไป (General Psychology)', '500201 ', '3(3-0-6)', 'ภาษาอังกฤษ 1 (English 1)', '500301 ', '3(2-2-5)', 'คอมพิวเตอร์ในชีวิตประจำวัน (Computer in Daily Life)', '500401 ', '3(3-0-6)', 'กอล์ฟ (Golf)', '500501', '1(0-2-1)'),
(2, 'มนุษย์กับอารยธรรม (Man and Civilization)', '500102', '3(3-0-6)', 'มนุษย์กับสังคม (Man and Society)', '500202 ', '3(3-0-6)', 'ภาษาอังกฤษ 2 (English 2)', '500302 ', '3(2-2-5)', 'วิทยาศาสตร์และเทคโนโลยีเพื่อชีวิต (Science and Technology for Lift)', '500402', '3(3-0-6)', 'ตะกร้อ (Takraw)', '500502', '1(0-2-1)'),
(3, 'ปรัชญาและศาสนากับการดำรงชีวิต (Philosophy and Religion for Living)', '500103 ', '3(3-0-6)', 'การเสริมสร้างคุณภาพชีวิต (Quality of Life Promotion)', '500203 ', '3(3-0-6)', 'ภาษาอังกฤษ 3 (English 3)', '500303 ', '3(3-0-6)', 'ชีวิตกับสิ่งแวดล้อม (Life and Environment)', '500403', '3(3-0-6)', 'ฟุตบอล (Soccer)', '500503', '1(0-2-1)'),
(4, 'สุนทรียภาพของชีวิต (Aesthetic of life)	\n', '500104 ', '3(3-0-6)', 'มนุษย์สัมพันธ์และการพัฒนาบุคลิกภาพ (Human Relation and Personality Development)', '500204 ', '3(3-0-6)', 'ภาษาอังกฤษ 4 (English 4)', '500304 ', '3(3-0-6)', 'การจัดการสารสนเทศยุคใหม่ (Modern Information Management)', '500404', '3(3-0-6)', 'บาสเกตบอล (Basketball)', '500504', '1(0-2-1)'),
(5, 'มนูษย์กับการใช้เหตุผลและจริยธรรม (Man and Ethical and Logical Application)', '500105 ', '3(3-0-6)', 'สังคม การเมือง การปกครอง (Society, Politics and Government)', '500205', '3(3-0-6)', 'ภาษาอังกฤษเพื่อการสื่อสาร (English for Communication)', '500305 ', '3(3-0-6)', 'เทคโนโลยีสารสนเทศเพื่องานเอกสารและการนำเสนอ (Information Technology for Documentation and Presentati', '500405', '3(3-0-6)', 'เกมเบ็ดเตล็ด (Mixed Games)', '500505', '1(0-2-1)'),
(6, 'ตรรกวิทยาและการใช้ (Logic and Usage)	\r\n', '500106 ', '3(3-0-6)', 'สังคม เศรษฐกิจและการจัดการ (Society, Economy and Management)', '500206', '3(3-0-6)', 'ทักษะภาษาไทย (Thai Language Skills)', '500306 ', '3(3-0-6)', 'คณิตศาสตร์และสถิติเบื้องต้น Fundamental Mathematics and Statistics)', '500406', '3(3-0-6)', 'การเต้นสมัยใหม่ (Modern Dance)', '500506', '1(0-2-1)'),
(7, 'จริยธรรมสิ่งแวดล้อม (Environmental Ethics)	\r\n', '500107 ', '3(3-0-6)', ' พลเมืองในกระแสโลกาภิวัตน์ (Citizenship and Globalization)	', '500207', '3(3-0-6)', 'ภาษาไทยเพื่อการสื่อสาร (Thai for Communication)', '500307 ', '3(3-0-6)', 'คณิตศาสตร์พื้นฐาน (Fundamental Mathematics)', '500407', '3(3-0-6)', 'รำไทย (Thai Dance)', '500507', '1(0-2-1)'),
(8, '', '', '', 'กฎหมายในชีวิตประจำวัน (Law for Daily Life)', '500208 ', '3(3-0-6)', 'การอ่านและเขียนในชีวิตประจำวัน (Reading and Writing for Daily Life)', '500308 ', '3(3-0-6)', 'สถิติพื้นฐานเพื่อการวิเคราะห์ข้อมูลเบื้องต้น (Fundamental Statistics for Data Analysis)', '500408', '3(3-0-6)', 'ลีลาศ (Ballroom Dance)', '500508', '1(0-2-1)'),
(9, '', '', '', '', '', '', 'ภาษาญี่ปุ่นเบื้องต้น (Basic Japanese)', '500309', '3(3-0-6)', '', '', '', 'การขับร้อง (Singing)', '500509', '1(0-2-1)'),
(10, '', '', '', '', '', '', 'ภาษาจีนเบื้องต้น (Basic Chinese)', '500310 ', '3(3-0-6)', '', '', '', 'ฟุตซอล	(Futsal)', '500510', '1(0-2-1)'),
(11, '', '', '', '', '', '', 'ภาษาฝรั่งเศสเบื้องต้น (Basic French)', '500311 ', '3(3-0-6)', '', '', '', 'วอลเลย์บอล (Volley Ball)', '500511', '1(0-2-1)'),
(22, '', '', '', '', '', '', '', '', '', '', '', '', 'พลศึกษาและนันทนาการ (Physical Education and Recreation)', '500512', '1(0-2-1)'),
(26, '', '', '', '3333333333333333', '12ๅ/-', '3', '', '', '', '', '', '', '', '', ''),
(34, '', '', '', '', '', '', '', '', '', '12', 'ffffff', '12', '', '', ''),
(37, '', '', '', '', '', '', '', '', '', '', '', '', '123dddddddddd', '123', '1231');

-- --------------------------------------------------------

--
-- Table structure for table `tbsubject_speci`
--

CREATE TABLE `tbsubject_speci` (
  `id` int(20) NOT NULL,
  `basic1` varchar(110) NOT NULL,
  `code_basic1` varchar(20) NOT NULL,
  `credits_basic1` varchar(20) NOT NULL,
  `major` varchar(110) NOT NULL,
  `code_major` varchar(20) NOT NULL,
  `credits_major` varchar(20) NOT NULL,
  `elective` varchar(110) NOT NULL,
  `code_elective` varchar(20) NOT NULL,
  `credits_elective` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbsubject_speci`
--

INSERT INTO `tbsubject_speci` (`id`, `basic1`, `code_basic1`, `credits_basic1`, `major`, `code_major`, `credits_major`, `elective`, `code_elective`, `credits_elective`) VALUES
(1, 'เคมีทั่วไป(General Chemistry)', '530001', '3(3-0-2)', 'วิทยาการคอมพิวเตอร์เบื้องต้น (Introduction to Computer Science)', '532101 ', '3(3-0-6)', 'การเขียนโปรแกรมด้วยภาษาวิชวล(Visual Programming)', '532201', '3(2-2-6)'),
(2, 'ฟิสิกส์ทั่วไป(General Physics)', '530002', '3(3-0-2)', 'หลักการเขียนโปรแกรมคอมพิวเตอร์ (Principle of Computer Programming)', '532102 ', '3(2-2-6)', 'การเขียนโปรแกรมบนเว็บ(Web Programming)', '532205', '3(2-2-6)'),
(3, ' แคลคูลัส(Calculus)', '530003', '3(3-0-2)', 'โครงสร้างและสถาปัตยกรรมคอมพิวเตอร์ (Computer Organization and Architecture)', '532105 ', '3(3-0-6)', 'การโปรแกรมฐานข้อมูล(Database Programming', '532209 ', '3(2-2-6)'),
(4, 'คณิตศาสตร์แบบไม่ต่อเนื่อง(Discrete Mathematics)', '530004', '3(3-0-2)', 'ระบบปฏิบัติการ(Operating Systems)', '532106 ', '3(2-2-6)', 'การพัฒนาซอฟต์แวร์อุปกรณ์ไร้สาย (Wireless Software Development)', '532210 ', '3(2-2-6)'),
(5, 'พีชคณิตเชิงเส้น(Linear Algebra)', '530005', '3(3-0-2)', 'โครงสร้างข้อมูลและอัลกอริธึม (Data Structures and Algorithms)', '532107 ', '3(2-2-6', 'การประกันคุณภาพและการทดสอบซอฟต์แวร์ (Software Quality Assurance and Testing)', '532212 ', '3(3-0-6)'),
(6, 'การใช้เหตุผลทางคณิตศาสตร์(Mathematical Reasoning)', '530007', '3(3-0-2)', 'ระบบฐานข้อมูล(Database Systems)', '532110 ', '3(2-2-6)', 'การพัฒนาซอฟต์แวร์เชิง (Object-Oriented Software Development)\r\n', '532213 ', '3(2-2-6)'),
(7, 'กฎหมายและจรรยาบรรณทางวิชาชีพสำหรับวิทยาการคอมพิวเตอร์ (Laws and Ethics for Computer Science)', '530008', '3(3-0-2)', 'การเขียนโปรแกรมเชิงวัตถุ(Object-Oriented Programming)', '532111 ', '3(2-2-6)', 'การบริหารเครือข่ายคอมพิวเตอร์ (Computer Network Administration)', '532301 ', '3(2-2-6)'),
(8, 'ภาษาอังกฤษสำหรับวิทยาการคอมพิวเตอร์ 1 (English for Computer Science 1)', '530009', '3(3-0-2)', 'การสื่อสารข้อมูลและเครือข่ายคอมพิวเตอร์ (Data Communications and Computer Networks)', '532112 ', '3(2-2-6)', 'ความปลอดภัยของคอมพิวเตอร์และข้อมูล (Computer and Data Security)', '532306 ', '3(3-0-6)'),
(9, 'ภาษาอังกฤษสำหรับวิทยาการคอมพิวเตอร์ 2  (English for Computer Science 2)', '530010', '3(3-0-2)', 'วิศวกรรมซอฟต์แวร์(Software Engineering)', '532114 ', '3(3-0-6)', 'คอมพิวเตอร์กราฟิกส์(Computer Graphics)', '532405 ', '3(2-2-6)'),
(10, 'ความน่าจะเป็นและสถิติ(Probability and Applied Statistics)', '530011', '3(3-0-2)', 'โครงงานคอมพิวเตอร์ 1(Computer Project 1)', '532115 ', '1(0-2-6)', 'ปัญญาประดิษฐ์(Artificial Intelligence)', '532406 ', '3(3-0-6)'),
(11, 'ความน่าจะเป็นและสถิติ(Probability and Applied Statistics)', '530012', '3(3-0-2)', 'โครงงานคอมพิวเตอร์ 2(Computer Project 2)', '532116 ', '2(0-4-12)', 'หลักการคลังข้อมูลและการทำเหมืองข้อมูล  (Data Warehouse and Data Mining Principles)', '532407 ', '3(3-0-6)'),
(12, 'ชีววิทยาทั่วไป(General Biology)', '530013', '3(3-0-2)', 'การออกแบบและพัฒนาเว็บ(Web Design and Development)', '532118 ', '3(2-2-6)', 'เทคโนโลยีสื่อประสม(Multimedia Technology)', '532408 ', '3(3-0-6)'),
(13, '', '', '', 'การวิเคราะห์และออกแบบระบบ (Systems Analysis and Design)', '532119 ', '3(2-2-6)', 'ระบบสารสนเทศเพื่อการจัดการ (Management Information Systems)', '532409 ', '3(3-0-6)'),
(14, '', '', '', '', '', '', 'การพาณิชย์อิเล็กทรอนิกส์(Electronic Commerce)', '532410 ', '3(3-0-6)'),
(15, '', '', '', '', '', '', 'หัวข้อเฉพาะเกี่ยวกับวิทยาการคอมพิวเตอร์ (Special Topics in Computer Science)', '532411 ', '3(3-0-6)'),
(16, '', '', '', '', '', '', 'สหกิจศึกษา(Cooperative Training) ', '532412 ', '6(0-0-30)');

-- --------------------------------------------------------

--
-- Table structure for table `tbsuccess`
--

CREATE TABLE `tbsuccess` (
  `id` int(11) NOT NULL,
  `success_title` varchar(100) NOT NULL,
  `success_text` text NOT NULL,
  `success_img` varchar(100) NOT NULL,
  `success_side` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbsuccess`
--

INSERT INTO `tbsuccess` (`id`, `success_title`, `success_text`, `success_img`, `success_side`) VALUES
(12, 'พี่ ออฟ- ComSci 11', '<h4>ชื่อ : นาย กฤษกร  สุขุมเจริญวงศ์</h4>\r\nรหัส : 4852410020<br/>\r\nบริษัท : Feyverly Co.,Ltd.  <br/>\r\nตำแหน่ง : Web Application Developer<br/>\r\n', 'off.jpg', 'right'),
(13, 'พี่ เบส- ComSci 11', '<h4>ชื่อ : นาย สุทธิรักต์  ตาละลักษณ์</h4>\r\nรุ่น : 11 (รองประธานรุ่น)<br/>\r\nรหัส : 4852410043<br/>\r\nบริษัท : Feyverly Co.,Ltd.  <br/>\r\nตำแหน่ง : System Analyst<br/>\r\n', 'b2.jpg', 'left'),
(20, 'พี่ ป๊อป- CS#11', '<h4>ชื่อ : นาย สิทธิชัย  ยองใย</h4>\r\nรุ่น : 11 (ประธานรุ่น)<br/>\r\nรหัส : 4852410036<br/>\r\nบริษัท : Feyverly Co.,Ltd.  \r\nตำแหน่ง : System Administrator<br/>\r\n', 'p1.jpg', 'right'),
(24, 'พี่ โอม- CS#16', '<h4>ชื่อ : นาย เทวฤทธิ์  วงศ์จินา</h4>\r\nรหัส : 5352410049 <br/>\r\nทำงานที่: บริษัท ทองไทยการทอ ตำแหน่ง : C#.NET Programmer<br/>\r\nคติ : หน้าตางั้นๆแต่ไลน์สั่นไม่หยุด\r\n', 'ohm.jpg', 'left'),
(25, 'พี่ เคี้ยง- CS#16', '<h4>ชื่อ : นายธนิตศักดิ์ อรัญศักดิ์ชัย</h4>\r\nรหัส : 5352410003<br/>\r\nกำลังศึกษาต่อ : มหาวิทยาลัยเอเชียอาคเนย์ ปริญญาโท คณะบริหารธุรกิจ สาขาการตลาด<br/>\r\nทำงานที่ : บริษัท คราวน์ เทค แอดวานซ์ จำกัด (มหาชน)  ตำแหน่ง : Programmer<br/>\r\nคติ : กิจกรรมต้องดี เรียนต้องเด่น\r\n', 'keang.jpg', 'right'),
(27, 'พี่ รัน- CS#16', '<h4>ชื่อ : นาย สรัล ชมเชย </h4>\r\nรุ่น 16  (ประธานรุ่น) \r\nรหัส : 5352410014  <br/>\r\nปัจจุบันเรียนต่อ ปริญญาโท มหาวิทยาลัยพระจอมเกล้าธนบุรี (บางมด) คณะเทคโนโลยีและสารสนเทศ สาขา Business information system <br/><br/>\r\nทำงาน : อยู่ที่ บริษัท TOT จำกัดมหาชน ตำแหน่ง Network admin and Communication data  <br/>\r\nสโลแกน : เป็นคน IT อย่าหยุดค้นคว้าความรู้เกี่ยวกับ IT', 'run.jpg', 'left'),
(28, 'พี่ แจน - CS#13', '<h4>ชื่อ : ภคนันท์รัชย์.   เชื้อสกล  </h4>\r\nรหัส : 5052410015 <br/>\r\nทำงาน ที่ศูนย์การแพทย์กาญจนาภิเษก(มหาวิทยาลัย มหิดล)<br/>\r\nตำแหน่ง  นักวิชาการคอมพิวเตอร์<br/>\r\n', 'b3.jpg', 'left'),
(29, 'พี่ ฟีลด์ - CS#17', '<h4>ชื่อ : นาย ยุทธปรัชญ์  ชาญณรงค์</h4>\nรหัส : 5452410039 <br/>\nทำงานที่ บริษัท : Feyverly Co.,Ltd. <br/>\nตำแหน่ง : Web Application Developer<br/>\nคติ : ท้อได้ แต่อย่าถอย', 'field.jpg', 'right'),
(30, 'พี่ เต้ย- CS#17', '<h4>ชื่อ : นาย ฐนพล จันทกลัด</h4>\r\nรหัส : 5452410041<br/>\r\nทำงานที่ บริษัท : Anywhere 2 go Co., Ltd. <br/>\r\nตำแหน่ง : Android Developer<br/>\r\nคติ : อนาคต เราไม่รู้', 'toey.jpg', 'left');

-- --------------------------------------------------------

--
-- Table structure for table `tbteacher`
--

CREATE TABLE `tbteacher` (
  `id` int(11) NOT NULL,
  `teacher_name` varchar(50) NOT NULL,
  `teacher_position` varchar(50) NOT NULL,
  `teacher_text` text NOT NULL,
  `teacher_img` varchar(50) NOT NULL,
  `teacher_facebook` varchar(50) NOT NULL,
  `teacher_google` varchar(50) NOT NULL,
  `teacher_email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbteacher`
--

INSERT INTO `tbteacher` (`id`, `teacher_name`, `teacher_position`, `teacher_text`, `teacher_img`, `teacher_facebook`, `teacher_google`, `teacher_email`) VALUES
(1, 'อ.ชนินทร เฉลิมสุข', 'หัวหน้าสาขาวิทยาการคอมพิวเตอร์', 'มุ่งมั่นพัฒนาผลิตบัณฑิตที่มีความรู้ในสาขาวิชาชีพคอมพิวเตอร์ เทคโนโลยี เกี่ยวกับศาสตร์ทางด้าน ซอร์ฟแวร์โดยหลักสูตรการสอนมุ่งเน้นเพื่อพัฒนาบัณฑิตให้ก้าวทันเทคโนโลยีฝึกกระบวนการคิดทักษะการเรียนรู้สิ่งใหม่ด้วยตนเอง และส่งเสริมพัฒนาต่อยอดความรู้ที่ได้ศึกษาอย่างมีคุณภาพและพัฒนาไปสู่มืออาชีพที่ใฝ่ฝัน<br><br>\r\n\r\n<b> คุณวุฒิ-สาขา : </b>\r\nวท.ม. เทคโนโลยีสารสนเทศ<br>\r\nบธ.บ. คอมพิวเตอร์ธุรกิจ\r\n', 'chanintorn .JPG', 'https://www.facebook.com/chanintorn.comsci?fref=ts', 'https://plus.google.com/u/0/112475361441517401792/', 'chanintornc@sau.ac.th'),
(2, 'อ. สิทธิ์  สิตไทย', 'รองคณะบดีฝ่ายกิจการฯ', 'วท.ม. เทคโนโลยีสารสนเทศ\r\nวท.บ ศาสตร์คอมพิวเตอร์\r\n', 'sit.png', 'https://www.facebook.com/sit.sitthai?fref=ts', 'https://plus.google.com/u/0/115735159762575620168/', 'sitthai@sau.ac.th'),
(20, 'อ.ธนบดี ศรีธนนันท์', 'อาจารย์ประจำ', 'วท.ม. เทคโนโลยีสารสนเทศ\r\n\r\nวท.บ ศาสตร์คอมพิวเตอร์\r\n', '3.JPG', '', '', 'thanabadhis@sau.ac.th'),
(21, 'ดร.พรพิมล บังคมคุณ', 'อาจารย์ประจำ', 'Ph.D. Computer Science\r\nMBA. Business Computer Information Technology\r\nสต.บ. สถิติศาสตรบัณฑิต\r\n', '22.jpg', '', '', 'pornpimolb@sau.ac.th'),
(22, 'อ.อภิชาติ คำปลิว', 'อาจารย์ประจำ', 'วท.ม. เทคโนโลยีสารสนเทศ\r\n\r\nวท.บ. วิทยาการคอมพิวเตอร์\r\n', '5.png', 'https://www.facebook.com/apichart.compliu?fref=ts', '', 'apichartc@sau.ac.th'),
(23, 'อ.อรทัย เจริญสิทธิ์', 'อาจารย์ประจำ', 'สต.ม. สถิติ\r\nวท.บ. สถิติประยุกต์\r\n', '6.png', '', '', 'orataic@sau.ac.th'),
(24, 'อ.สมมาตร ปิยพงษ์เดชา', 'อาจารย์ประจำ', 'MS(CEM) คอมพิวเตอร์และวิศวกรรมการจัดการ\r\nวท.บ. สถิติและคอมพิวเตอร์\r\n', '7.jpg', '', '', 'sommartp@sau.ac.th'),
(25, 'อ.ชาญยุทธ  เกตวานนท์', 'อาจารย์ประจำ', 'วท.ม. หุ่นยนต์และระบบอัตโนมัติ\r\n\r\nวท.บ. วิทยาการคอมพิวเตอร์\r\n', '8.JPG', 'https://www.facebook.com/chanyut.ketavanan?fref=ts', '', 'chanyutk@sau.ac.th'),
(26, 'อ.บุญชัย  เตมีพัฒพงษา', 'อาจารย์ประจำ', 'วท.ม. หุ่นยนต์และระบบอัตโนมัติ\r\n\r\nวท.บ. วิทยาการคอมพิวเตอร์\r\n', '9.png', '', '', 'boonchait@sau.ac.th'),
(27, 'อ.ภาสวรรณ นะราแก้ว', 'อาจารย์ประจำ(เลขาวิทยาการคอม)', 'วท.บ. วิทยาการคอมพิวเตอร์\r\n(กำลังศึกษาต่อ ปริญญาโท)\r\n', '10.png', 'https://www.facebook.com/tonn.panupong?fref=ts', '', 'pasawann@sau.ac.th');

-- --------------------------------------------------------

--
-- Table structure for table `tbtest`
--

CREATE TABLE `tbtest` (
  `id` int(11) NOT NULL,
  `t1` varchar(13) NOT NULL,
  `t2` varchar(13) NOT NULL,
  `t3` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbtest`
--

INSERT INTO `tbtest` (`id`, `t1`, `t2`, `t3`) VALUES
(3, '222', '222', '333'),
(4, '333', '333', '444'),
(5, '', '', ''),
(8, '555', '555', '555');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `member_login`
--
ALTER TABLE `member_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbabout`
--
ALTER TABLE `tbabout`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbadmission`
--
ALTER TABLE `tbadmission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbadmission2`
--
ALTER TABLE `tbadmission2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbcontact`
--
ALTER TABLE `tbcontact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbcourse`
--
ALTER TABLE `tbcourse`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbdetailimg`
--
ALTER TABLE `tbdetailimg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbfaculty`
--
ALTER TABLE `tbfaculty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbfreshy`
--
ALTER TABLE `tbfreshy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbgallery`
--
ALTER TABLE `tbgallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbgalleryalbum`
--
ALTER TABLE `tbgalleryalbum`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbgoal`
--
ALTER TABLE `tbgoal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbguarantee`
--
ALTER TABLE `tbguarantee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbheader`
--
ALTER TABLE `tbheader`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbhistory`
--
ALTER TABLE `tbhistory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbnews`
--
ALTER TABLE `tbnews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbproject4`
--
ALTER TABLE `tbproject4`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbproject4_type`
--
ALTER TABLE `tbproject4_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbprojectt`
--
ALTER TABLE `tbprojectt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbpromote`
--
ALTER TABLE `tbpromote`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbrightmenu`
--
ALTER TABLE `tbrightmenu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbsection_box`
--
ALTER TABLE `tbsection_box`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbslideheader`
--
ALTER TABLE `tbslideheader`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbsubject_choice`
--
ALTER TABLE `tbsubject_choice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbsubject_group`
--
ALTER TABLE `tbsubject_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbsubject_normal`
--
ALTER TABLE `tbsubject_normal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbsubject_speci`
--
ALTER TABLE `tbsubject_speci`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbsuccess`
--
ALTER TABLE `tbsuccess`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbteacher`
--
ALTER TABLE `tbteacher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbtest`
--
ALTER TABLE `tbtest`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `t3` (`t3`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `member_login`
--
ALTER TABLE `member_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbabout`
--
ALTER TABLE `tbabout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tbadmission`
--
ALTER TABLE `tbadmission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `tbadmission2`
--
ALTER TABLE `tbadmission2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbcontact`
--
ALTER TABLE `tbcontact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `tbcourse`
--
ALTER TABLE `tbcourse`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbdetailimg`
--
ALTER TABLE `tbdetailimg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `tbfaculty`
--
ALTER TABLE `tbfaculty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbfreshy`
--
ALTER TABLE `tbfreshy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tbgallery`
--
ALTER TABLE `tbgallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `tbgalleryalbum`
--
ALTER TABLE `tbgalleryalbum`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=388;
--
-- AUTO_INCREMENT for table `tbgoal`
--
ALTER TABLE `tbgoal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbguarantee`
--
ALTER TABLE `tbguarantee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbheader`
--
ALTER TABLE `tbheader`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbhistory`
--
ALTER TABLE `tbhistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbnews`
--
ALTER TABLE `tbnews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `tbproject4`
--
ALTER TABLE `tbproject4`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `tbproject4_type`
--
ALTER TABLE `tbproject4_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tbprojectt`
--
ALTER TABLE `tbprojectt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tbpromote`
--
ALTER TABLE `tbpromote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `tbrightmenu`
--
ALTER TABLE `tbrightmenu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbsection_box`
--
ALTER TABLE `tbsection_box`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbslideheader`
--
ALTER TABLE `tbslideheader`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbsubject_choice`
--
ALTER TABLE `tbsubject_choice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tbsubject_group`
--
ALTER TABLE `tbsubject_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tbsubject_normal`
--
ALTER TABLE `tbsubject_normal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `tbsubject_speci`
--
ALTER TABLE `tbsubject_speci`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `tbsuccess`
--
ALTER TABLE `tbsuccess`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `tbteacher`
--
ALTER TABLE `tbteacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `tbtest`
--
ALTER TABLE `tbtest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
