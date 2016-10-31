<?php
//之前系统的修改
    //引入sql配置
    include "commen.php";

	header("Content-Type: text/html; charset=utf-8");
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

	$mail = mysql_real_escape_string($_POST['Mail']);

	$Result = mysql_query("SELECT * FROM ".$mysql_table." WHERE mail='".$mail."'");
    $row = mysql_fetch_array($Result);
    if($row){
    	$smail = new SaeMail();
        $ret = $smail->quickSend( $mail,'密码',$row["password"],'jsjdj2012@163.com','jsjdj2012sj');
        echo "<script>alert('邮件已发送，请查收');</script>";
        echo '<script language=\'javascript\'>window.location.replace(\'login.php\');</script>';
    }
    else{
        echo "<script>alert('您未绑定邮箱或者邮箱输入错误');</script>";
        echo '<script language=\'javascript\'>window.location.replace(\'mail.php\');</script>';
        return;
    }
    
?>