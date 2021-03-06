<?php

date_default_timezone_set("Etc/GMT-8");

function input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

include './file/conn.php';

$nicknameErr=$qqErr=$mailErr=$messageErr="";
$face=$nickname=$qq=$mail=$message="";
$belong=null;
$flag=1;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	$face=$_POST['face'];
	
  if (empty($_POST['nickname'])) {
    $nicknameErr = "昵称是必填的哟！";
	$flag=0;
  } else {
    $nickname=input($_POST['nickname']);
  }
  
  if (empty($_POST["qq"])) {
    $qq = "";
  } else {
    	$qq = input($_POST["qq"]);
		if(strlen($qq) < 5 || strlen($qq) > 10){
			$qqErr = "QQ号格式错误";
		}
  }

  if (empty($_POST["email"])) {
    $mail = "";
  } else {
		$email = input($_POST["email"]);
		if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)) {
			$mailErr = "无效的 email 格式！";
		}
  }

  if (empty($_POST['message-content'])) {
	  $flag=0;
    $messageErr = "内容都不输你留什么言呢？";
  } else {
    $message = input($_POST['message-content']);
  }
   


$date=date('Y-n-j H:i:s');
$sql="INSERT INTO message (face, nickname, qq, mail, message, datetime, belong)VALUES ('".$face."','".$nickname."','".$qq."','".$mail."','".$message."','".$date."','".$belong."');";
if($flag){
	if (!mysql_query($sql,$con))
  	{
  	die('Error: ' . mysql_error());
  	}
	$flag=0;
	echo "<script>alert('亲爱的".$nickname."，您的留言我已收到！');</script>";
}
}
?>


<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome!</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="./js/html5shiv.min.js"></script>
        <script src="./js/respond.min.js"></script>
    <![endif]-->
</head>
<body>
	<a name="top"></a>
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation"><!--导航栏-->
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                    <span class="sr-only">切换导航</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">李志青的个人网站</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="index.html">主 页</a></li>
                    <li><a href="studio.html">工作室</a></li>
                    <li><a href="article.html">文 章</a></li>
                    <li  class="active"><a href="message.html">留 言</a></li>

                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">关 于 <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#" data-toggle="modal" data-target="#contact-author">联系作者</a></li>
                            <li><a href="#" data-toggle="modal" data-target="#about-website">关于本站</a></li>
                        </ul>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
    



    <div class="container-fluid top-tag"><!--导航栏下面的提示部分-->
        <div class="container top-tag-content">
            <h1>留言板</h1>
            <p>欢迎大家给我留言</p>
        </div>
    </div>


    <div class="container" id="body"><!--主体部分开始-->


        <ol class="breadcrumb">
            <li><a href="index.html">主页</a></li>
            <li class="active">留言</li>
        </ol>


        <form name="message" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" class="form-horizontal" role="form">
            <div class="form-group">
                <label for="face" class="col-sm-2 control-label">头像:</label>
                <div class="col-sm-10">
                    <label class="radio-inline">
                        <input type="radio" name="face" id="face" value="1" checked>
                        <img class="img-thumbnail message-face" src="img/face/face1.png">
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="face" id="face2" value="2">
                        <img class="img-thumbnail message-face" src="img/face/face2.png">
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="face" id="face3" value="3">
                        <img class="img-thumbnail message-face" src="img/face/face3.png">
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="face" id="face4" value="4">
                        <img class="img-thumbnail message-face" src="img/face/face4.png">
                    </label>
                </div>
            </div>
            <div class="form-group">
                <label for="nickname" class="col-sm-2 control-label">昵称:</label>
                <div class="col-sm-10">
                    <input type="text" name="nickname" class="form-control" id="nickname" placeholder="Nickname">
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">邮箱:</label>
                <div class="col-sm-10">
                    <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                </div>
            </div>
            <div class="form-group">
                <label for="qq" class="col-sm-2 control-label">QQ:</label>
                <div class="col-sm-10">
                    <input type="text" name="qq" class="form-control" id="qq" placeholder="QQ">
                </div>
            </div>
            <div class="form-group">
                <label for="content" class="col-sm-2 control-label">内容:</label>
                <div class="col-sm-10">
                    <textarea class="form-control" rows="3" name="message-content" id="content" placeholder="Content"></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">提交</button>
                </div>
            </div>
        </form>


        <hr class="divider" />



        <!--<div class="row message-row">留言内容模板
            <dl class="dl-horizontal">
                <dt class="text-center">
                    <img src="img/face.jpg" alt="" class="img-thumbnail message-face"><br />
                    <span class="message-nickname">aaa</span>
                </dt>
                <dd>
                    <span class="message-date">2014-12-24 20:30</span><br />
                    <blockquote>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                    </blockquote>
                </dd>
            </dl>
        </div>-->

		<?php
			
			$result = mysql_query("SELECT face,nickname,message,datetime FROM message WHERE belong=null or belong=0 ORDER BY datetime DESC;");
			
			while($row = mysql_fetch_array($result))
			  {
				echo '<div class="row message-row">
            		<dl class="dl-horizontal">
                	<dt class="text-center">
                    <img src="img/face/face'.$row['face'].'.png" alt="" class="img-thumbnail message-face"><br />
                    <span class="message-nickname">'.$row['nickname'].'</span></dt>';
				echo '<dd>
                    <span class="message-date">'.$row['datetime'].'</span><br />
                    <blockquote>
                        <p>'.$row['message'].'</p>
                    </blockquote>
                	</dd>
           		 	</dl>
        			</div>';
			  }
			
			?>





        <hr class="divider footer-divider" /><!--底部开始-->
        <footer>
            <span class="pull-right"><a href="#top">回到顶部</a></span>
            <span>CopyRight &copy; 2014 <a href="http://muzi.pw">Muzi.pw</a> </span>

        </footer>


    </div>



    <!--提示框部分-->
    <div class="modal fade" id="contact-author" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">联系作者</h4>
                </div>
                <div class="modal-body">
                    <p>
                        姓名：李志青<br />
                        E-Mail: <a href="mailto:lizhiqing1996@gmail.com">lizhiqing1996@gmail.com</a> <br />
                        QQ: 1425154902
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">知道了</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="about-website" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">关于本站</h4>
                </div>
                <div class="modal-body">
                    <p>
                        本站是由李志青开发的个人主页，纯属娱乐爱好。<br />
                        如有雷同，纯属巧合。
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">知道了</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="message" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="message-title">留言成功</h4>
                </div>
                <div class="modal-body">
                    <p class="text-success">
                        你的留言已经提交成功,谢谢!
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">知道了</button>
                </div>
            </div>
        </div>
    </div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="./js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="./js/bootstrap.min.js"></script>
</body>
</html>