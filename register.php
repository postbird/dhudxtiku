<?php
$msg="";
    if(isset($_GET["msg"])){
        $msg=$_GET["msg"];
          if($msg==1)
             $msg="此学号已注册";
    }
	
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!--script language="javascript" type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.js"></script-->
<!--LINK rel=stylesheet type=text/css href="http://dhuyouth.sinaapp.com/normal_css/new_css.css"-->
<link rel="stylesheet" href="css/lightbox.css" media="screen"/>
<script src="//cdn.bootcss.com/jquery/2.0.3/jquery.min.js"></script>
<!--script src="js/lightbox-2.6.min.js"></script-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=0.5, maximum-scale=2.0, user-scalable=no" />
<title>题库系统-注册</title>
<style>
    body{
    	background-color:#f1f1f1;
    }
	.div_none_decoration{
        text-decoration:none;
    }
    .div_none_decoration a:link{
        text-decoration:none;
    }
    .div_none_decoration a:visted{
        text-decoration:none;
    }
    .div_none_decoration a:hover{
        text-decoration:none;
    }
	#div_nav_top{
        width:100%;
        height:25px;
        background-color:#FFF;
        color:#007aff;
        position:fixed;
        left:0;
        top:0;
    }
    #div_nav_bottom{
        width:100%;
        height:50px;
        background-color:#000;
        color:#FFF;
        position:fixed;
        left:0;
        bottom:0;
        padding:10 0;
    }
	.div_details_text{
        background-color:#f7f7f7;
        padding:10px;
        width:80%;
        margin:10 0;
    }
	.div_lang_bar_bg{
        width:100%;
        height:40px;
        background-color:#FFF;
        overflow:hidden;
        -webkit-border-radius:5px;
    }
    .div_forhead_bar_blue{
        width:10px;
        height:40px;
        background-color:#7ecef4;
        float:left;
    }
    .div_forhead_bar_pink{
        width:10px;
        height:40px;
        background-color:#ef72a7;
        float:left;
    }
    .div_forhead_bar_green{
        width:10px;
        height:40px;
        background-color:#38c600;
        float:left;
    }
    .div_pic{
        width:80%;
        height:200px;
        padding:10;
        background:#FFF;
        margin:10;
    }
    .div_pic_overhide{
    	overflow:hidden;
        width:75%;
        height:190px;
    }
	.div_button{
        background-color:#0099FF;
        color:#FFF;
        box-shadow: 0px 0px 5px #FFF;
        font-size:25px;
        height:30px;
        -webkit-border-radius:0px;
    }
    .div_button_small{
        background-color:#0099FF;
        color:#FFF;
        font-size:20px;
        font-family:华文细黑;
        margin:0 5 0 0;
        padding:5 3;
        border:0;
    }
    .div_button_large{
        background-color:#0099FF;
        color:#FFF;
        font-size:20px;
        font-family:华文细黑;
        margin:20;
        padding:5 30;
        border:0;
        width:40%;
    }
	.div_bottom_desk{
        padding:10 10 0;
        background:#FFF;
    }
    .div_bottom_desk_second{
        background:#00a8ff;
    }
	.div_index_numofpeople{
        text-align:left;
        margin:5 0;
        float:left;
    }
    .div_index_department{
        text-align:right;
        margin:5 0;
    }
    .div_right{
        text-align:right;
    }
    .div_left{
        text-align:left;
    }
	#nav_top_left_button{
        font-size:20px;
        font-family:华文细黑;
        text-decoration:none;
        text-align:left;
        float:left;
    }
    #nav_top_right_button{
        font-size:20px;
        font-family:华文细黑;
        text-decoration:none;
        text-align:right;
    }
    
    .font_title{
        font-size:22px;
        font-family:华文细黑;
        text-align:center;
        color:#5b5b5b;
    }
    .font_note{
        font-size:16px;
        font-family:华文细黑;
        text-align:center;
        color:#5b5b5b;
    }
    .font_note_nav{
        font-size:17px;
        font-family:华文细黑;
        text-align:center;
        color:#ffffff;
        width:40%;
        float:left;
        line-height:20px;
    }
    .font_text{
        font-size:16px;
        font-family:华文细黑;
        text-align:left;
        color:#5b5b5b;
    }
    .font_bar{
        font-size:20px;
        line-height:40px;
        font-family:华文细黑;
        text-align:left;
        color:#5b5b5b;
    }
    
    .font_red_mark{
        color:red;
    }
	.font_head{
        font-size:35px;
        font-family:华文细黑;
        text-align:center;
        color:#3fb4ff;
        font-weight:bold;
        margin:45 0 0 0;
    }
    .font_subhead{
        font-size:20px;
        font-family:华文细黑;
        text-align:center;
        color:#848484;
        margin:0 0 45;
    }
    
    .font_vote_title{
        font-size:22px;
        font-family:华文细黑;
        text-align:left;
        color:#FFF;
        margin:10 20 5;
    }
	.font_note_details_light{
        font-size:14px;
        font-family:华文细黑;
        text-align:left;
        color:#e1e1e1;
        margin:10px 20px;
    }
    .font_note_details_dark{
        font-size:14px;
        font-family:华文细黑;
        color:#565656;
    }
    .font_style_center{
        text-align:center;
    }
	.pic_index_eachpic{
        margin:10 10;
        width:120px;
        height:100px;
        float:right;
        background:#FFF;
        padding:10 10 10;
    }
    .pic_over_hide{
        overflow:hidden;
        width:110px;
        height:90px;
    }
    .table_style1{
        border:0;
    }
    #checkbox{
        width:20px;
        height:20px;
        background:#FFF;
        color:#0099FF;
    }
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
<script>
    function Check(){
        if(form1.Id.value==""){
            alert("学号不能为空");
            return false;
        }
        else if(form1.Banji.value==""){
            alert("支部不能为空");
        	return false;
        }
        else if(form1.UserName.value==""){
            alert("用户名不能为空");
            return false;
        }
        else if(form1.Password.value==""){
            alert("密码不能为空");
        	return false;
        }
        else if(form1.Password.value!=form1.Password2.value){
        	alert("确认密码错误");
            return false;
        }
        else return true;
    }
</script>
</head>
<body>
    <DIV class="font_head">东华大学</DIV>
    <DIV class="font_subhead">题库系统注册</DIV>
    <div class="font_note" style="text-align:center;margin:-20 0 0;"><?php echo $msg;?></div>
    <center><form action="check.php" method="POST" class="form" name="form" id="form1">
        <div><lable class="font_note">&nbsp学　号&nbsp</lable><input type="text" id="input" class="input" name="Id" required="true" /></div>
        <div><lable class="font_note">&nbsp支　部&nbsp</lable><input type="banji" id="input" class="input" name="Banji" required="true"  /></div>
        <div><lable class="font_note">&nbsp姓  名&nbsp</lable><input type="text" id="input" class="input" name="UserName"  required="true" /></div>
        <div><lable class="font_note">&nbsp密　码&nbsp</lable><input type="password" id="input" class="input" name="Password"  required="true" /></div>
        <div><lable class="font_note">确认密码</lable><input type="password" id="input2" class="input" name="Password2"  required="true" /></div>
        <button class="div_button_large" onclick="return Check()">注册</button>
        </form>
        <div style="width:90%;margin:-40 0 -20;"><a href="login.php?msg="><button class="div_button_large">返回</button></a></div>
    </center>
    
</body>
<!--script language="javascript" type="text/javascript" src="http://dhuyouth.sinaapp.com/normal_js/hideOptionMenu.js"></script-->
</html>