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
	$mysql_table3 = "question";
	$mysql_table4 = "test";
    $con = mysql_connect($mysql_host.':'.$mysql_port, $mysql_user, $mysql_password, true);

	session_start(); 
    
    if (!$con){
        die('Could not connect: ' . mysql_error());
    }
	mysql_query("SET NAMES 'UTF8'");
    mysql_select_db($mysql_database, $con);

	$Result = mysql_query("SELECT * FROM ".$mysql_table." WHERE id='".$id."'");
    $row = mysql_fetch_array($Result);
	$msg = "欢迎".$row["username"];

	$Result2 = mysql_query("SELECT * FROM ".$mysql_table2." WHERE chapter=-1");
	$row2 = mysql_fetch_array($Result2);
	$radio = $row2["radio"];
	$multiple = $row2["multiple"];
	$all = $radio + $multiple;

	$Result4 = mysql_query("SELECT * FROM ".$mysql_table4." WHERE id='".$id."'");
	$row4 = mysql_fetch_array($Result4);
	
	if ($row){
		if ($row4){
            $total = $row4["total"];
            $correct = $row4["correct"];
            $t = $row4["now"];
            $ques = $_SESSION['t'.$t];
            
            $Result3 = mysql_query("SELECT * FROM ".$mysql_table3." WHERE id='".$ques."'");
            $row3 = mysql_fetch_array($Result3);
            
            if ($row3){
                $answer = $row3["answer"];
                $type = $row3["choicetype"];
                if ($type == 1){
                    $TiOption = mysql_real_escape_string($_POST['TiOption']);
                    if ($TiOption == ""){
                        echo '<script language=\'javascript\'>window.location.replace(\'test.php\');</script>';
                        return;
                    }
                }
                else if ($type == 2){
                    $TiOption = "";
                    if(isset($_REQUEST["TiOption"]))
                        foreach($_POST['TiOption'] as $Op)
                            $TiOption.=$Op;
                    if ($TiOption == ""){
                        echo '<script language=\'javascript\'>window.location.replace(\'test.php\');</script>';
                        return;
                    }
                }
                if ($TiOption == $answer){
                    $correct++;
                    $score = 100 * $correct / $total;
                    $sql = "UPDATE ".$mysql_table4." SET correct='".$correct."',score='".$score."' WHERE id='".$id."'";
                    if (!mysql_query($sql,$con))
        	    		die('Error: ' . mysql_error());
                }
                $t++;
                $sql = "UPDATE ".$mysql_table4." SET now='".$t."' WHERE id='".$id."'";
				if (!mysql_query($sql,$con))
        	    	die('Error: ' . mysql_error());
                if ($t <= $total)
                	echo '<script language=\'javascript\'>window.location.replace(\'test.php\');</script>';
                else
                    echo '<script language=\'javascript\'>window.location.replace(\'score.php\');</script>';
            }
            else{
                echo "<script>alert('获取题目失败，请重试开始测试');</script>";
            	echo '<script language=\'javascript\'>window.location.replace(\'index.php\');</script>';
            	return;
            }
        }
        else{
            echo "<script>alert('获取题目失败，请重试开始测试');</script>";
            echo '<script language=\'javascript\'>window.location.replace(\'index.php\');</script>';
            return;
        }
    }
	else{
         echo '<script language=\'javascript\'>window.location.replace(\'login.php?msg=\');</script>';
         return;
    }      
?>