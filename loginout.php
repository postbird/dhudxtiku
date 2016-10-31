<?php
    if(isset($_COOKIE["id"])){
        setcookie("id",$_COOKIE["id"],time()-1);
    }
	else{
        echo "<script language='javascript'>window.location.replace('login.php');</script>";
        return;
    }
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<LINK rel=stylesheet type=text/css href="./css/new_style2.css">
<link rel="stylesheet" href="css/lightbox.css" media="screen"/>
<script src="//cdn.bootcss.com/jquery/2.0.3/jquery.min.js"></script>
<script src="js/lightbox-2.6.min.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0, user-scalable=no" />
<title>题库系统-退出</title>
</head>
<body>
<script language="javascript">setTimeout("window.location.replace('login.php')",3000);</script>
<DIV class="font_head">东华大学</DIV>
<DIV class="font_subhead">用户注销</DIV>
<center><div><lable class="font_note">注销成功,3秒后返回登录页</lable></div></center>
</body>
</html>