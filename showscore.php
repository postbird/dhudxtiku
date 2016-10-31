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
	$mysql_table2 = "test";
	//$mysql_table = "user_manager";
    $con = mysql_connect($mysql_host.':'.$mysql_port, $mysql_user, $mysql_password, true);
    
    if (!$con){
        die('Could not connect: ' . mysql_error());
    }
	mysql_query("SET NAMES 'UTF8'");
    mysql_select_db($mysql_database, $con);

	$Result = mysql_query("SELECT * FROM ".$mysql_table." WHERE id='".$id."'");
    $row = mysql_fetch_array($Result);
	$msg = "欢迎".$row["username"];
	$power = $row["upower"];
	
	$Result2 = mysql_query("SELECT * FROM ".$mysql_table2);

    if ($row){
        if ($power == 2){
            $output='<table border="1 #5E5E5E" class="div_none_decoration font_note_details_dark" style="text-align:center;">
                    <tr style="font-weight:blod;"><td>支部</td><td>学号</td><td>姓名</td><td>成绩</td></tr>';
            while ($row2 = mysql_fetch_array($Result2)){
                $stid = $row2["id"];
                $score = $row2["score"];
                
                $Result3 = mysql_query("SELECT * FROM ".$mysql_table." WHERE id='".$stid."'");
    			$row3 = mysql_fetch_array($Result3);
                $stname = $row3["username"];
                $stbanji = $row3["banji"];
                $output.='<tr><td>'.$stbanji.'</td><td>'.$stid.'</td><td>'.$stname.'</td><td>'.$score.'</td></tr>';
            }
            $output.='</table><br><br><div id="select" style="display:none;"></div>';
        }
        else{
            $output='<lable><a href="upload_vote.php" class="div_none_decoration font_note_details_dark" style="color:#3fb4ff;font-weight:blod; font-size:20px;">您的权限不足</a></lable>';
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
    <center><?php echo $output; ?>
        <div><a href="index.php"><button class="div_button_middle3">返回</button></a></div>
    </center>
</body>
</html>