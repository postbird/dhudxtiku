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
<link rel="stylesheet" href="css/index_upload.css">
<link rel="stylesheet" href="css/index.css">
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
        margin:10px
    }
    .form{
        width:90%;
    }
</style>
<title>题库系统-邮箱绑定</title>
<script>
    function Check(){
        var myreg = /(\S)+[@]{1}(\S)+[.]{1}(\w)+/;
        if (form1.Mail.value!="")
        {
            if (!myreg.test(form1.Mail.value))
            {
                alert("请输入有效的Email!");
                return false;
            }
            return true;
        }
        else
        {
            alert("请输入有效的Email!");
            return false;
        }
    }
</script>
</head>
<body>
    <DIV class="font_head">东华大学</DIV>
    <DIV class="font_subhead">题库系统</DIV>
    <div class="div_none_decoration font_note_details_dark" style="text-align:center;margin:-30 0 10;"><?php echo $msg;?></div>
    <center><form action="doaddmail.php" method="POST" class="form" name="form" id="form1">
        <div><lable class="font_note">邮箱</lable><input type="text" id="input" class="input" name="Mail" /></div>
        <button class="div_button_middle2" onclick="return Check()">绑定</button>
        </form>
        <a href="manage.php"><button class="div_button_middle3">返回</button></a>
    </center>
</body>
</html>