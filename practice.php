<?php
//之前系统的修改
    //引入sql配置
    include "commen.php";

    header("Content-Type: text/html; charset=utf-8");
	if(isset($_COOKIE["id"]))
        $id=$_COOKIE["id"];
	else{
        echo "<script language='javascript'>window.location.replace('login.php');</script>";
        return;
	}
	// $mysql_host = SAE_MYSQL_HOST_M;
 //    $mysql_host_s = SAE_MYSQL_HOST_S;
 //    $mysql_port = SAE_MYSQL_PORT;
 //    $mysql_user = SAE_MYSQL_USER;
 //    $mysql_password = SAE_MYSQL_PASS;
 //    $mysql_database = SAE_MYSQL_DB;

	$mysql_table = "user";
	$mysql_table2 = "chapter";
	$mysql_table3 = "question";
	$mysql_table4 = "choice";
	$mysql_table5 = "practice";

    $con = mysql_connect($mysql_host.':'.$mysql_port, $mysql_user, $mysql_password, true);
    
    if (!$con){
        die('Could not connect: ' . mysql_error());
    }
	mysql_query("SET NAMES 'UTF8'");
    mysql_select_db($mysql_database, $con);

	$chap = mysql_real_escape_string($_GET['chap']);
	define('TITLE','题库系统-第'.$chap.'章节');

	$Result = mysql_query("SELECT * FROM ".$mysql_table." WHERE id='".$id."'");
    $row = mysql_fetch_array($Result);
	$msg = "欢迎".$row["username"];

	$Result2 = mysql_query("SELECT * FROM ".$mysql_table2." WHERE chapter='".$chap."'");
	$row2 = mysql_fetch_array($Result2);
	$radio = $row2["radio"];
	$multiple = $row2["multiple"];
	$all = $radio + $multiple;
	
	$Result5 = mysql_query("SELECT * FROM ".$mysql_table5." WHERE id='".$id."' && chapter='".$chap."'");
    $row5 = mysql_fetch_array($Result5);
	$num = $row5["now"];
	
	if ($row){
        if ($row5){
            $Result3 = mysql_query("SELECT * FROM ".$mysql_table3." WHERE chapter='".$chap."' && idinchapter='".$num."'");
            $row3 = mysql_fetch_array($Result3);
            $question = $row3["question"];
            $qid = $row3["id"];
            $type = $row3["choicetype"];
            
            $Result4 = mysql_query("SELECT * FROM ".$mysql_table4." WHERE id='".$qid."' order by tioption asc");
            $output='<center style="margin:10;">';
            if ($row3){
                $i = 1;
                $output.='<div class="div_none_decoration font_text" style="text-align:left;margin:0 5;">'.$num.'.'.$question.'</div>';
                $output.='<form action="practicecheck.php?chap='.$chap.'" method="POST" class="form" name="form" id="form1">';
                if ($type == 1){
                    while ($row4 = mysql_fetch_array($Result4)){
                    	$output.='<div class="div_none_decoration font_text2" style="text-align:left;margin:0 15;"><input type="radio" name="TiOption" value="'.$row4["tioption"].'" id="ch_'.$i.'"/>'.$row4["tioption"].'.'.$row4["detail"].'</div>';
                            $i++;
                    }
                }
                else if ($type == 2){
                	while ($row4 = mysql_fetch_array($Result4)){
                    	$output.='<div class="div_none_decoration font_text2" style="text-align:left;margin:0 15;"><input type="checkbox" name="TiOption[]" value="'.$row4["tioption"].'" id="ch_'.$i.'"/>'.$row4["tioption"].'.'.$row4["detail"].'</div>';
                        $i++;
                    }
                }
                $output.='<button class="div_button_middle" onclick="return Check1()">&nbsp&nbsp确&nbsp&nbsp&nbsp定&nbsp&nbsp</button></form>';
            }
            else if ($all == 0)
                $output.='<div class="div_none_decoration font_text" style="text-align:center;margin:10 0 30;">此章节题目还未上传，请耐心等待</div>';
            else
                $output.='<div class="div_none_decoration font_text" style="text-align:center;margin:10 0 30;">此题不在题库中</div>';
            $output.='</center>';
        }
        else{
            echo "<script>alert('获取题目失败，请重试开始');</script>";
            echo "<script language=\'javascript\'>window.location.replace(\'chapterdetail.php?chap=".$chap."\');</script>";
            return;
        }
    }
	else{
         echo '<script language=\'javascript\'>window.location.replace(\'login.php?msg=\');</script>';
         return;
    }
        
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
<title><?php echo TITLE;?></title>
<script>
    function Check1(){
        var max = "<?php echo $i;?>";
        var chk = false;
		for(var i=1;i<max;i++)
			if(document.getElementById("ch_"+i).checked)
                chk=true;
        if(!chk){
            alert("没有选择");
            return false;
        }
        else return true;
    }
</script>
</head>
<body>
    <DIV class="font_head">东华大学</DIV>
    <DIV class="font_subhead">题库系统</DIV>
    <div class="div_none_decoration font_note_details_dark" style="text-align:center;margin:-30 0 0;"><?php echo $msg;?></div>
    <?php echo $output;?>
    <center style="margin:-20 0 0;"><div style="width:90%;"><a href="chapter.php"><button class="div_button_middle">&nbsp&nbsp返&nbsp&nbsp&nbsp回&nbsp&nbsp</button></a></div></center>
</body>
</html>