<?php
//之前系统的修改
    //引入sql配置
    include "commen.php";

header("Content-Type: text/html; charset=utf-8");
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
	$mysql_table3 = "practice";

    $con = mysql_connect($mysql_host.':'.$mysql_port, $mysql_user, $mysql_password, true);
    
    if (!$con){
        die('Could not connect: ' . mysql_error());
    }
	mysql_query("SET NAMES 'UTF8'");
    mysql_select_db($mysql_database, $con);

	$chap = mysql_real_escape_string($_GET['chap']);

	$Result = mysql_query("SELECT * FROM ".$mysql_table." WHERE id='".$id."'");
    $row = mysql_fetch_array($Result);
	$msg = "欢迎".$row["username"];

	$Result2 = mysql_query("SELECT * FROM ".$mysql_table2." WHERE chapter='".$chap."'");
	$row2 = mysql_fetch_array($Result2);
	$radio = $row2["radio"];
	$multiple = $row2["multiple"];
	$all = $radio + $multiple;
	
	$Result3 = mysql_query("SELECT * FROM ".$mysql_table3." WHERE id='".$id."' && chapter='".$chap."'");
    $row3 = mysql_fetch_array($Result3);
	$num = $row3["now"];
	$frontnum = $num-2;

	if ($row){
        if ($row3){
            $sql = "UPDATE ".$mysql_table3." SET now='".$frontnum."' WHERE id='".$id."' && chapter='".$chap."'";
            if (!mysql_query($sql,$con))
                die('Error: ' . mysql_error());
            echo '<script language=\'javascript\'>window.location.replace(\'practice.php?chap='.$chap.'\');</script>';
    	}
        else{
            echo "<script>alert('获取题目失败，请重试开始');</script>";
            echo "<script language=\'javascript\'>window.location.replace(\'chapterdetail.php?chap=".$chap."\');</script>";
            return;
        }
    }
	else{
         echo '<script language=\'javascript\'>window.location.replace(\'login.php?msg=\');</script>';
         return;
    }
        
?>