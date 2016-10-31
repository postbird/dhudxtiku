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
	$msg="欢迎".$row["username"];
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
<style>
    .input{
        width:70%;
        height:40px;
        border:0;
        font-size:25px;
        font-family:微软雅黑;
        margin:0px;
    }
    .form{
        width:90%;
    }
</style>
<title>题库系统-密码修改</title>
<script>
    function Check(){
        if(form1.Password.value==""){
            alert("原始密码不能为空");
            return false;
        }
        else if(form1.Password1.value==""){
            alert("新密码不能为空");
            return false;
        }
        else if(form1.Password1.value!=form1.Password2.value){
        	alert("确认密码错误");
            return false;
        }
        else return true;
    }
</script>
</head>
<body>
    <DIV class="font_head">东华大学</DIV>
    <DIV class="font_subhead">题库系统</DIV>
    <div class="div_none_decoration font_note_details_dark" style="text-align:center;margin:-30 0 10;"><?php echo $msg;?></div>
    <center><form action="dochange.php" method="POST" class="form" name="form" id="form1">
        <div><lable class="font_note">原始密码</lable><input type="password" id="input" class="input" name="Password" /></div><br/>
        <div><lable class="font_note">&nbsp新 密 码</lable><input type="password" id="input1" class="input" name="Password1" /></div><br/>
        <div><lable class="font_note">确认密码</lable><input type="password" id="input2" class="input" name="Password2" /></div>
        <button class="div_button_middle2" onclick="return Check()">更改</button>
        </form>
        <a href="manage.php"><button class="div_button_middle3">返回</button></a>
    </center>
</body>
</html>