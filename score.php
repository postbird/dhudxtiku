<?php
//之前系统的修改
    //引入sql配置
    include "commen.php";

	if(isset($_COOKIE["id"]))
        ;
	else{
        echo "<script language='javascript'>window.location.replace('login.php');</script>";
        return;
	}
	$id=$_COOKIE["id"];
	// $mysql_host = SAE_MYSQL_HOST_M;
 //    $mysql_host_s = SAE_MYSQL_HOST_S;
 //    $mysql_port = SAE_MYSQL_PORT;
 //    $mysql_user = SAE_MYSQL_USER;
 //    $mysql_password = SAE_MYSQL_PASS;
 //    $mysql_database = SAE_MYSQL_DB;

	$mysql_table = "user";
	$mysql_table3 = "test";
    $con = mysql_connect($mysql_host.':'.$mysql_port, $mysql_user, $mysql_password, true);
    
    if (!$con){
        die('Could not connect: ' . mysql_error());
    }
	mysql_query("SET NAMES 'UTF8'");
    mysql_select_db($mysql_database, $con);

	$Result = mysql_query("SELECT * FROM ".$mysql_table." WHERE id='".$id."'");
    $row = mysql_fetch_array($Result);
	$msg = "欢迎".$row["username"];

	$Result3 = mysql_query("SELECT * FROM ".$mysql_table3." WHERE id='".$id."'");
	$row3 = mysql_fetch_array($Result3);
	
	if ($row){
		if ($row3){
            $score = $row3["score"];
            $output = '<center><div class="div_none_decoration font_text" style="text-align:center;margin:5;">您此次测试的成绩为'.$score.'</div></center>';
        	if ($score < 80)
                $output.= '<center><div class="div_none_decoration font_text" style="text-align:center;margin:5;color:red;">对不起，您没能通过测试，请再接再厉！</div></center>';
        	else
                $output.= '<center><div class="div_none_decoration font_text" style="text-align:center;margin:5;color:green;">恭喜您通过测试！</div></center>';
        	
        }
        else{
            echo "<script>alert('您还未参加考试');</script>";
            echo '<script language=\'javascript\'>window.location.replace(\'starttest.php\');</script>';
            return;
        }
    }
	else{
         echo '<script language=\'javascript\'>window.location.replace(\'login.php?msg=\');</script>';
         return;
    }      
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="css/index.css">
<link rel="stylesheet" href="css/index_upload.css">
<link rel="stylesheet" href="css/lightbox.css" media="screen"/>
<script src="//cdn.bootcss.com/jquery/2.0.3/jquery.min.js"></script>
<script src="js/lightbox-2.6.min.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0, user-scalable=no" />
<title>题库系统-成绩</title>
</head>
<body>
    <DIV class="font_head">东华大学</DIV>
    <DIV class="font_subhead">题库系统</DIV>
    <div class="div_none_decoration font_note_details_dark" style="text-align:center;margin:-30 0 0;"><?php echo $msg;?></div>
    <?php echo $output;?>
    <center><div style="width:90%;"><a href="index.php"><button class="div_button_middle">&nbsp返&nbsp&nbsp&nbsp&nbsp回&nbsp</button></a></div></center>
</body>
</html> 