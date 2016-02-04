<?php 
	header("content-type:text/html;charset=utf-8");
	include_once 'nologin.php';
	include_once '../dbio/NewsArticles.php';
	
	$currentPage = $_POST["currentPage"];//当前页
	$currentPage = $currentPage==NULL?1:$currentPage;
	//获得表单提交的数据
	$keyword = $_POST["keyword"];
	$searchType = $_POST["searchType"];
	$articleId = $_GET["articleId"];
	
	//删除新闻
	if($articleId != NULL)
	{
		$result = NewsArticles::delNews($articleId);
		header("location:success.php?act=delNews&rst={$result}");
	}
	
	$result = NewsArticles::getAllNews($currentPage,$keyword,$searchType);
	$newsInfo = $result[0];//记录
	$totalPage = $result[1];//总页数
?>
<html>
  <head>
    <title>修改新闻</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <link href="../css/admin.css" type="text/css" rel="stylesheet" />
    <script type="text/javascript" src="../jquery/jquery-1.4.js"></script>
    <script type="text/javascript">
      function checkSearch()
      {
          if(document.frm.keyword.value == "")
          {
              alert("请输入搜索关键字！");
              document.frm.keyword.focus();
              return false;
          }
      }
      function setForm()
      {
          document.frm.keyword.value = "<?php echo $keyword?>";
          document.frm.searchType.value = "<?php echo $searchType?>";
      }
      function setPage(currentPage)
      {
          document.frm.currentPage.value = currentPage;
          document.frm.submit();
      }
      function delNews(articleId)
      {
          if(confirm("是否删除该新闻及新闻的所有评论？"))
          {
              window.location = "modnews.php?articleId="+articleId;
          }
      }
    </script>
  </head>
  <body onload="setForm()">
    <!-- 页面头 -->
    <?php include_once 'header.php';?>
    <!-- 当前位置 -->
    <div class="locationDiv">：新闻管理：修改新闻</div>
    <!-- 正文内容 -->
    <div class="contentDiv clear">
      <!-- 左侧的div -->
      <div class="leftDiv"><?php include_once 'left.php';?></div>
      <!-- 右侧的div -->
      <div class="rightDiv">
        <br>
        <form name="frm" method="post" action="modnews.php" onsubmit="return checkSearch()">
        <input type="hidden" name="currentPage" value="1">
        <table border="0" align="center">
          <tr>
            <td align="center">
              &nbsp;新闻搜索：
              <input type="text" name="keyword" size="30">
              <select name="searchType">
                <option value="title">标题</option>
                <option value="content">内容</option>
              </select>
              <input type="image" src="../images/search_over.gif">
            </td>
          </tr>
        </table>
        </form>
        <table border="1" align="center">
          <tr>
            <td>编号</td>
            <td>新闻分类</td>
            <td>发表时间</td>
            <td>新闻标题</td>
            <td>评论</td>
            <td>&nbsp;</td>
          </tr>
<?php 
	foreach ($newsInfo as $v)
	{
		echo "<tr>";
		echo "  <td>{$v["articleId"]}</td>";
		echo "  <td>{$v["typeName"]}</td>";
		echo "  <td>{$v["dateandtime"]}</td>";
		echo "  <td><a href='updatenews.php?articleId={$v["articleId"]}'>{$v["title"]}</a></td>";
		echo "  <td><a href='delreviews.php?articleId={$v["articleId"]}'>查看评论</a></td>";
		echo "  <td><a href='#' onclick='delNews({$v["articleId"]})'>删除</a></td>";
		echo "</tr>";
	}
?>
          <tr>
            <td colspan="6" align="left">
<?php 
	for($i=1;$i<=$totalPage;$i++)
	{
		if($i == $currentPage)
		{
			echo "[{$i}]&nbsp;&nbsp;&nbsp;";
		}
		else 
		{
			echo "<a href='#' onclick='setPage({$i})'>[{$i}]</a>&nbsp;&nbsp;&nbsp;";
		}
	}
?>
            </td>
          </tr>
        </table>
        <br><br>
      </div>
    </div>
  </body>
</html>








