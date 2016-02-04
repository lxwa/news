<?php 
	header("content-type:text/html;charset=utf-8");
	include_once 'nologin.php';
	include_once '../dbio/Reviews.php';
	
	$articleId = $_GET["articleId"];
	$id = $_GET["id"];
	//删除一个评论
	if($id != NULL)
	{
		$result = Reviews::delReviewById($id);
		header("location:success.php?act=delReviews&rst={$result}&articleId={$articleId}");
	}
	
	$reviews = Reviews::getReviews($articleId);
?>
<html>
  <head>
    <title>查看评论</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <link href="../css/admin.css" type="text/css" rel="stylesheet" />
    <script type="text/javascript" src="../jquery/jquery-1.4.js"></script>
    <script type="text/javascript">
      function delReviews(id)
      {
          if(confirm("是否删除该评论？"))
          {
              window.location = "delreviews.php?articleId=<?php echo $articleId?>&id="+id;
          }
      }
    </script>
  </head>
  <body>
    <!-- 页面头 -->
    <?php include_once 'header.php';?>
    <!-- 当前位置 -->
    <div class="locationDiv">：新闻管理：查看评论</div>
    <!-- 正文内容 -->
    <div class="contentDiv clear">
      <!-- 左侧的div -->
      <div class="leftDiv"><?php include_once 'left.php';?></div>
      <!-- 右侧的div -->
      <div class="rightDiv">
        <br>
        <table border="1" align="center" width="700">
          <tr>
            <td>编号</td>
            <td>内容</td>
            <td>评论人</td>
            <td>评论时间</td>
            <td>&nbsp;</td>
          </tr>
<?php 
	foreach($reviews as $v)
	{
		echo "<tr>";
		echo "  <td>{$v["id"]}</td>";
		echo "  <td>{$v["body"]}</td>";
		echo "  <td>{$v["userName"]}</td>";
		echo "  <td>{$v["dateandtime"]}</td>";
		echo "  <td><a href='#' onclick='delReviews({$v["id"]})'>删除</a></td>";
		echo "</tr>";
	}
?>
        </table>
        <br><br>
      </div>
    </div>
  </body>
</html>








