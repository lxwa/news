<?php 
	header("content-type:text/html;charset=utf-8");
	include_once 'dbio/NewsTypes.php';
	include_once 'dbio/NewsArticles.php';
	
	$typeId = $_GET["typeId"];//当前显示的分类的分类id
	
	$newsType = NewsTypes::getTypeByTypeId($typeId);//该分类的详细信息
	$newsInfo = NewsArticles::getNewsByTypeId($typeId);//该分类下所有新闻
	$newsTypes = NewsTypes::getNewsTypes();//所有分类
?>
<html>
  <head>
    <title>天天新闻网</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <link href="css/news.css" type="text/css" rel="stylesheet" />
  </head>
  <body>
    <!-- 网站头 -->
    <?php include_once 'header.php';?>
	
	<!-- 正文内容 -->
	<div class="mainDiv clear">
	  <div class="newsTypeDiv">
	    <div class="newsTypeDiv1">&nbsp;<a href="index.php" class="a">新闻主页</a> &raquo; <?php echo $newsType["typeName"]?></div>
	    <div class="newsTypeDiv2">本类共有 <?php echo $newsType["articleNums"]?> 条新闻</div>
	  </div>
<?php 
	foreach ($newsInfo as $v)
	{
?>
	  <div class="newsTypeDiv3">
	    <img src="images/makealltop.gif"><a href="news.php?articleId=<?php echo $v["articleId"]?>"><?php echo $v["title"]?></a>
	  </div>
<?php 
	}
?>
	  
	  
	  <div class="newsTypeDiv3">&nbsp;</div>
	</div>
    
    
    <!-- 网页脚 -->
    <?php include_once 'footer.php';?>
  </body>
</html>




