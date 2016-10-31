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
	$mysql_table3 = "test";
    $con = mysql_connect($mysql_host.':'.$mysql_port, $mysql_user, $mysql_password, true);

	session_unset();
	session_start();
	session_destroy();
	session_start();
    
    if (!$con){
        die('Could not connect: ' . mysql_error());
    }
	mysql_query("SET NAMES 'UTF8'");
    mysql_select_db($mysql_database, $con);

	$Result = mysql_query("SELECT * FROM ".$mysql_table." WHERE id='".$id."'");
    $row = mysql_fetch_array($Result);

	$Result2 = mysql_query("SELECT * FROM ".$mysql_table2." WHERE chapter=7");
	$row2 = mysql_fetch_array($Result2);
	$radio = $row2["radio"];
	$multiple = $row2["multiple"];
	$all = $radio + $multiple;

	if ($all < 50)
        $total = $all;
	else
        $total = 50;

	$Result3 = mysql_query("SELECT * FROM ".$mysql_table3." WHERE id='".$id."'");
	$row3 = mysql_fetch_array($Result3);
	
	if ($row){
		if ($row3){
            $sql = "UPDATE ".$mysql_table3." SET total='".$total."',now=1,correct=0,score=0 WHERE id='".$id."'";
			if (!mysql_query($sql,$con))
        	    die('Error: ' . mysql_error());
        }
        else{
            $sql = "insert into ".$mysql_table3." (id,total,now,correct,score)  values('$id','$total','1','0','0')";
			if (!mysql_query($sql,$con))
         		die('Error: ' . mysql_error());
        }
        $numbers = range (1,$all); 
    	srand ((float)microtime()*1000000); 
    	shuffle ($numbers); 
        $i = 1;
    	while (list (, $number) = each ($numbers)){ 
    		$_SESSION['t'.$i] = $number;
            $i++;
            if ($i == 51)
                break;
    	}
        echo '<script language=\'javascript\'>window.location.replace(\'test.php\');</script>';
    }
	else{
         echo '<script language=\'javascript\'>window.location.replace(\'login.php?msg=\');</script>';
         return;
    }      
?>