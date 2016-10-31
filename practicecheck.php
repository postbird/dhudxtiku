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
	$nextnum = $num + 1;
	$frontnum = $num-1;

	if ($row){
        if ($row5){
            $sql = "UPDATE ".$mysql_table5." SET now='".$nextnum."' WHERE id='".$id."' && chapter='".$chap."'";
            if (!mysql_query($sql,$con))
            	die('Error: ' . mysql_error());
            
            $Result3 = mysql_query("SELECT * FROM ".$mysql_table3." WHERE chapter='".$chap."' && idinchapter='".$num."'");
            $row3 = mysql_fetch_array($Result3);
            $question = $row3["question"];
            $answer = $row3["answer"];
            $qid = $row3["id"];
            $type = $row3["choicetype"];
            
            $Result4 = mysql_query("SELECT * FROM ".$mysql_table4." WHERE id='".$qid."' order by tioption asc");
            // var_dump("SELECT * FROM ".$mysql_table4." WHERE id='".$qid."' order by tioption asc");
            $output='<center style="margin:10;">';
            if ($row3){
                $i = 1;
                $output.='<div class="div_none_decoration font_text" style="text-align:left;margin:0 5;">'.$num.'.'.$question.'</div>';
                $output.='<form action="practicecheck.php?chap='.$chap.'" method="POST" class="form" name="form" id="form1">';
                if ($type == 1){
                    $TiOption = mysql_real_escape_string($_POST['TiOption']);
                    if ($TiOption == ""){
                        echo '<script language=\'javascript\'>window.location.replace(\'practice.php?chap='.$chap.'\');</script>';
                        return;
                    }
                    while ($row4 = mysql_fetch_array($Result4)){
                    	$output.='<div class="div_none_decoration font_text2" style="text-align:left;margin:0 15;"><input type="radio" name="TiOption" value="'.$row4["tioption"].'" id="ch_'.$i.'"/>'.$row4["tioption"].'.'.$row4["detail"].'</div>';
                        $i++;
                    }
                }
                else if ($type == 2){
                    $TiOption = "";
                    if(isset($_REQUEST["TiOption"]))
                        foreach($_POST['TiOption'] as $Op)
                            $TiOption.=$Op;
                    if ($TiOption == ""){
                        echo '<script language=\'javascript\'>window.location.replace(\'practice.php?chap='.$chap.'\');</script>';
                        return;
                    }
					while ($row4 = mysql_fetch_array($Result4)){
                    	$output.='<div class="div_none_decoration font_text2" style="text-align:left;margin:0 15;"><input type="checkbox" name="TiOption[]" value="'.$row4["tioption"].'" id="ch_'.$i.'"/>'.$row4["tioption"].'.'.$row4["detail"].'</div>';
                        $i++;
                    }                    
                }
                if ($TiOption == $answer)
                    $output.='<div class="div_none_decoration font_note_details_dark" style="text-align:center;">答案正确</div>';
                else
                    $output.='<div class="div_none_decoration font_note_details_dark" style="text-align:center;color:red;">正确答案为'.$answer.'</div>';
                if ($num > 1)
                	$output.='</form><div style="width:90%;margin:-20 0 10;"><a href="practicejump.php?chap='.$chap.'"><button class="div_button_middle" onclick="return Check()">&nbsp上一题&nbsp</button></a></div>';
                if ($num < $all)
                	$output.='</form><div style="width:90%;margin:-20 0 10;"><a href="practice.php?chap='.$chap.'"><button class="div_button_middle" onclick="return Check2()">&nbsp下一题&nbsp</button></a></div>';
            }
            else if ($num == 0)
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
</head>
<body>
    <DIV class="font_head">东华大学</DIV>
    <DIV class="font_subhead">题库系统</DIV>
    <div class="div_none_decoration font_note_details_dark" style="text-align:center;margin:-30 0 0;"><?php echo $msg;?></div>
    <?php echo $output;?>
    <center style="margin:-20 0 0;"><div style="width:90%;"><a href="chapter.php"><button class="div_button_middle">&nbsp返&nbsp&nbsp&nbsp&nbsp回&nbsp</button></a></div></center>
</body>
</html>