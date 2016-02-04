<?php 
	header("content-type:text/html;charset=utf-8");
	include_once 'dbio/NewsTypes.php';
	
	$act = $_GET["act"];//操作类型
	$rst = $_GET["rst"];//操作结果
	$message = "";//提示信息
	$jumpUrl = "";//跳转的地址
	
	if($act == "addreviews")//发表评论
	{
		$articleId = $_GET["articleId"];
		if($rst > 0)
		{
			$message = "发表评论成功！";
			$jumpUrl = "news.php?articleId={$articleId}";
		}
		else
		{
			$message = "发表评论失败！";
			$jumpUrl = "news.php?articleId={$articleId}";
		}
	}
	elseif($act == "login")//管理员
	{
		if($rst == 0)
		{
			$message = "验证码输入有误！";
			$jumpUrl = "index.php";
		}
		elseif($rst == 1)
		{
			$message = "用户名或密码错误！";
			$jumpUrl = "index.php";
		}
		elseif($rst == 2)
		{
			$message = "正在进入后台管理...！";
			$jumpUrl = "admin/index.php";
		}
	}
	
	
	$newsTypes = NewsTypes::getNewsTypes();//所有分类
?>
<html>
  <head>
    <title>系统提示信息</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <link href="css/news.css" type="text/css" rel="stylesheet" />
    <script type="text/javascript">
      var index = 5;//时间
      function changeTime()
      {
          document.getElementById("timeSpan").innerHTML = index;
          index--;
          if(index < 0)
          {
              window.location = "<?php echo $jumpUrl?>";
          }
          else
          {
              window.setTimeout("changeTime()",1000);
          }
      }
	</script>
  </head>
  <body onload="changeTime()">
    <!-- 网站头 -->
    <?php include_once 'header.php';?>
	
	<!-- 正文内容 -->
	<div class="mainDiv clear">
	  <!-- 提示信息 -->
	  <br>
	  <div class="newsTypeDiv" style="border:1px solid #990100;">
	    <div class="newsTypeDiv1">&nbsp;系统提示信息</div>
	    <div class="newsTypeDiv2">&nbsp;</div>
	  </div>
	  <div class="searchDiv" style="height:110px">
	    <br><?php echo $message?>页面将在 <span id="timeSpan">5</span> 秒钟内自动跳转！
	    <br><br>如果没有自动跳转，<a href="<?php echo $jumpUrl?>">请点击这里</a>。
	    <br><br>
	  </div>
	  
	  <div class="newsTypeDiv3">&nbsp;</div>
	</div>
    
    
    <!-- 网页脚 -->
    <?php include_once 'footer.php';?>
  </body>
</html>




