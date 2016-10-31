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
	$mysql_table2 = "chapter";
    $con = mysql_connect($mysql_host.':'.$mysql_port, $mysql_user, $mysql_password, true);
    
    if (!$con){
        die('Could not connect: ' . mysql_error());
    }
	mysql_query("SET NAMES 'UTF8'");
    mysql_select_db($mysql_database, $con);

	$Result = mysql_query("SELECT * FROM ".$mysql_table." WHERE id='".$id."'");
    $row = mysql_fetch_array($Result);
	$msg="欢迎".$row["username"];

	$Result2 = mysql_query("SELECT * FROM ".$mysql_table2." WHERE chapter=(select max(chapter) from ".$mysql_table2.")");
	$row2 = mysql_fetch_array($Result2);
	$output='<center>';
	if ($row){
		if ($row2){
            $max = $row2["chapter"];
            $i = 0;
            for (;$i<=$max;$i++){
                if ($i == 7)
                 	$output.='<div style="margin:0 0 -10;"><a href="chapterdetail.php?chap='.$i.'"><button class="div_button_middle">两学一做</button></a></div>';
             //   else
               // 	$output.='<div style="margin:0 0 -10;"><a href="chapterdetail.php?chap='.$i.'"><button class="div_button_middle">&nbsp第&nbsp'.$i.'&nbsp章&nbsp&nbsp</button></a></div>';
            }
        }
        else
            $output.='<div class="div_none_decoration font_note_details_dark" style="text-align:center;">章节信息还未上传，请耐心等待</div>';
        $output.='</center>';
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
<title>题库系统-选择章节</title>
</head>
<body>
    <DIV class="font_head">东华大学</DIV>
    <DIV class="font_subhead">题库系统</DIV>
    <div class="div_none_decoration font_note_details_dark" style="text-align:center;margin:-30 0 0;"><?php echo $msg;?></div>
    <?php echo $output;?>
    <center><div><a href="index.php"><button class="div_button_middle">&nbsp&nbsp返&nbsp&nbsp&nbsp回&nbsp&nbsp</button></a></div></center>
</body>
</html>