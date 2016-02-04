<?php 
	header("content-type:text/html;charset=utf-8");
	session_start();
	
	$act = $_GET["act"];//操作类型
	$rst = $_GET["rst"];//操作结果
	$message = "";//提示信息
	$jumpUrl = "";//跳转地址
	
	if($act == "logout")//退出后台管理
	{
		unset($_SESSION["userMsg"]);
		$message = "退出后台管理系统成功！";
		$jumpUrl = "../index.php";
	}
	elseif($act == "nologin" || $act == NULL)//没有登陆
	{
		$message = "您还没有登陆，无权访问该页面！";
		$jumpUrl = "../index.php";
	}
	elseif($act == "addnews")//添加新闻
	{
		if($rst > 0)
		{
			$message = "添加新闻成功！";
			$jumpUrl = "addnews.php";
		}
		else
		{
			$message = "添加新闻失败！";
			$jumpUrl = "addnews.php";
		}
	}
	elseif($act == "delNews")//删除新闻
	{
		if($rst > 0)
		{
			$message = "删除新闻成功！";
			$jumpUrl = "modnews.php";
		}
		else
		{
			$message = "删除新闻失败！";
			$jumpUrl = "modnews.php";
		}
	}
	elseif($act == "delReviews")//删除评论
	{
		$articleId = $_GET["articleId"];
		if($rst > 0)
		{
			$message = "删除评论成功！";
			$jumpUrl = "delreviews.php?articleId={$articleId}";
		}
		else
		{
			$message = "删除评论失败！";
			$jumpUrl = "delreviews.php?articleId={$articleId}";
		}
	}
	elseif($act == "updateNews")//修改新闻
	{
		$articleId = $_GET["articleId"];
		if($rst > 0)
		{
			$message = "修改新闻成功！";
			$jumpUrl = "updatenews.php?articleId={$articleId}";
		}
		else
		{
			$message = "修改新闻失败！";
			$jumpUrl = "updatenews.php?articleId={$articleId}";
		}
	}
	elseif($act == "addtype")//添加分类
	{
		if($rst > 0)
		{
			$message = "添加分类成功！";
			$jumpUrl = "addtype.php";
		}
		else
		{
			$message = "添加分类失败！";
			$jumpUrl = "addtype.php";
		}
	}
	elseif($act == "modtype")//修改分类
	{
		if($rst > 0)
		{
			$message = "修改分类成功！";
			$jumpUrl = "modtype.php";
		}
		else
		{
			$message = "修改分类失败！";
			$jumpUrl = "modtype.php";
		}
	}
	
?>
<html>
  <head>
    <title>系统提示信息</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <link href="../css/admin.css" type="text/css" rel="stylesheet" />
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
    <div class="sysmsgDiv">
      <div class="sysmsgDiv1">系统提示信息</div>
      <div class="sysmsgDiv2">
        <br><?php echo $message?>页面将在 <span id="timeSpan">5</span> 秒钟内自动跳转！
        <br><br>如果没有自动跳转，<a href="<?php echo $jumpUrl?>">请点击这里</a>。<br><br>
      </div>
    </div>
  </body>
</html>








