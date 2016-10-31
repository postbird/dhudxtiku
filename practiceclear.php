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

	$Result3 = mysql_query("SELECT * FROM ".$mysql_table3." WHERE id='".$id."' && chapter='".$chap."'");
	$row3 = mysql_fetch_array($Result3);
	
	if ($row){
		if ($row3){
            $sql = "UPDATE ".$mysql_table3." SET now=1 WHERE id='".$id."' && chapter='".$chap."'";
            if (!mysql_query($sql,$con))
            	die('Error: ' . mysql_error());
            echo '<script language=\'javascript\'>window.location.replace(\'practice.php?chap='.$chap.'\');</script>';
        }
        else{
            echo '<script language=\'javascript\'>window.location.replace(\'charpterdetail.php?chap='.$chap.'\');</script>';
        }
    }
	else{
         echo '<script language=\'javascript\'>window.location.replace(\'login.php?msg=\');</script>';
         return;
    }      
?>
