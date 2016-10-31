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
	//$mysql_table = "user_manager";
    $con = mysql_connect($mysql_host.':'.$mysql_port, $mysql_user, $mysql_password, true);
    
    if (!$con){
        die('Could not connect: ' . mysql_error());
    }
	mysql_query("SET NAMES 'UTF8'");
    mysql_select_db($mysql_database, $con);

	$Result = mysql_query("SELECT * FROM ".$mysql_table." WHERE id='".$id."'");
    $row = mysql_fetch_array($Result);
	
    if ($row){
        $msg = "欢迎".$row["username"];
        $power = $row["upower"];
        if ($power == 2){
            $output = '<a href="showscore.php"><button class="div_button_middle">成绩管理</button></a>';
        }else{
            $output = '';
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
<title>题库系统-首页</title>
</head>
<body>
    <DIV class="font_head">东华大学</DIV>
    <DIV class="font_subhead2">题库系统</DIV>
    <div class="div_none_decoration font_note_details_dark" style="text-align:center;text-align:center;margin:-10 0 0;"><?php echo $msg;?></div>
    <center><div><a href="chapter.php"><button  class="div_button_middle">章节练习</button></a></div>
        <div><a href="starttest.php"><button class="div_button_middle">&nbsp&nbsp测&nbsp&nbsp&nbsp试&nbsp&nbsp</button></a></div>
        <div><?php echo $output;?></div>
        <div><a href="manage.php"><button class="div_button_middle">账户管理</button></a></div>
        <div><a href="loginout.php"><button class="div_button_middle">&nbsp&nbsp退&nbsp&nbsp&nbsp出&nbsp&nbsp</button></a></div>
    </center>
</body>
</html>