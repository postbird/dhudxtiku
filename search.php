<?php
//之前系统的修改
    //引入sql配置
    include "commen.php";

	// $mysql_host = SAE_MYSQL_HOST_M;
 //    $mysql_host_s = SAE_MYSQL_HOST_S;
 //    $mysql_port = SAE_MYSQL_PORT;
 //    $mysql_user = SAE_MYSQL_USER;
 //    $mysql_password = SAE_MYSQL_PASS;
 //    $mysql_database = SAE_MYSQL_DB;

	$mysql_table = "user";
    $con = mysql_connect($mysql_host.':'.$mysql_port, $mysql_user, $mysql_password, true);
    
    if (!$con){
        die('Could not connect: ' . mysql_error());
    }
    mysql_query("SET NAMES 'UTF8'");
    mysql_select_db($mysql_database, $con);

	$id = mysql_real_escape_string($_POST['Id']);
	$password = mysql_real_escape_string($_POST['Password']);
    $cookie_is_not=0;
    if(isset($_POST['cookie'])){
      $cookie_is_not = $_POST['cookie'];
    }

	$Result = mysql_query("SELECT * FROM ".$mysql_table." WHERE id=".$id."");
    
    $row = mysql_fetch_array($Result);
    if($row){
        if($row["password"]==$password){
        	if($cookie_is_not) setcookie("id",$row["id"],time()+3600*24*7);
        	else setcookie("id",$row["id"]);
        	echo '<script language=\'javascript\'>window.location.replace(\'index.php\');</script>';
        	return;
        }
        else{
            echo '<script language=\'javascript\'>window.location.replace(\'login.php?msg=2\');</script>';
        	return;
        }     
    }
    else{
         echo '<script language=\'javascript\'>window.location.replace(\'login.php?msg=1\');</script>';
         return;
    }
    
?>