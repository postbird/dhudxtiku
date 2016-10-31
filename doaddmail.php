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
	//$mysql_table = "user_manager";
    $con = mysql_connect($mysql_host.':'.$mysql_port, $mysql_user, $mysql_password, true);
    
    if (!$con){
        die('Could not connect: ' . mysql_error());
    }
	mysql_query("SET NAMES 'UTF8'");
    mysql_select_db($mysql_database, $con);

	$mail = mysql_real_escape_string($_POST['Mail']);

	$Result = mysql_query("SELECT * FROM ".$mysql_table." WHERE id='".$id."'");
    $row = mysql_fetch_array($Result);
	if ($row){
        $sql = "UPDATE ".$mysql_table." SET mail='".$mail."' WHERE id='".$id."'";
		if (!mysql_query($sql,$con))
		{
        	die('Error: ' . mysql_error());
        }
        else{
            echo "<script>alert('绑定成功');</script>";
            echo '<script language=\'javascript\'>window.location.replace(\'index.php\');</script>';
            return;
        }
    }
    else{
         echo '<script language=\'javascript\'>window.location.replace(\'login.php?msg=\');</script>';
         return;
    }
?>
