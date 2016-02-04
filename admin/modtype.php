<?php 
	header("content-type:text/html;charset=utf-8");
	include_once 'nologin.php';
	include_once '../dbio/NewsTypes.php';
	
	//获得表单提交的数据
	$typeId = $_GET["typeId"];
	$typeName = $_POST["typeName"];
	$articleNums = $_POST["articleNums"];
	//表单提交(修改分类)
	if($typeName != NULL)
	{
		$result = NewsTypes::updateType($typeId, $typeName, $articleNums);
		header("location:success.php?act=modtype&rst={$result}");
	}
	
	$newsTypes = NewsTypes::getNewsTypes();
?>
<html>
  <head>
    <title>修改分类</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <link href="../css/admin.css" type="text/css" rel="stylesheet" />
    <script type="text/javascript" src="../jquery/jquery-1.4.js"></script>
    <script type="text/javascript">
      var oldTypeId;
      var oldTypeName;
      var oldArticleNums;
      var oldLinks;
      //显示文本框
      function showText(typeId)
      {
          hideText();
          oldTypeId = typeId;
          oldTypeName = $("#td"+typeId+"1").html();
          oldArticleNums = $("#td"+typeId+"2").html();
          oldLinks = $("#td"+typeId+"3").html();
          $("#td"+typeId+"1").html("<input type='text' name='typeName' size='20' value='"+oldTypeName+"'>");
          $("#td"+typeId+"2").html("<input type='text' name='articleNums' size='20' value='"+oldArticleNums+"'>");
          $("#td"+typeId+"3").html("<a href='#' onclick='submitForm()'>更新</a>  <a href='#' onclick='hideText()'>取消</a>");
      }
      //隐藏文本框
      function hideText()
      {
          $("#td"+oldTypeId+"1").html(oldTypeName);
          $("#td"+oldTypeId+"2").html(oldArticleNums);
          $("#td"+oldTypeId+"3").html(oldLinks);
      }
      //更新的超链接，提交表单
      function submitForm()
      {
          if(document.frm.typeName.value == "")
          {
              alert("请输入分类名称！");
              document.frm.typeName.focus();
          }
          else if(document.frm.articleNums.value == "")
          {
              alert("请输入分类数量！");
              document.frm.articleNums.focus();
          }
          else
          {
              document.frm.action = "modtype.php?typeId="+oldTypeId;
              document.frm.submit();
          }
      }
    </script>
  </head>
  <body>
    <!-- 页面头 -->
    <?php include_once 'header.php';?>
    <!-- 当前位置 -->
    <div class="locationDiv">：分类管理：修改分类</div>
    <!-- 正文内容 -->
    <div class="contentDiv clear">
      <!-- 左侧的div -->
      <div class="leftDiv"><?php include_once 'left.php';?></div>
      <!-- 右侧的div -->
      <div class="rightDiv">
        <br><br>
        <form name="frm" method="post">
        <table border="1" align="center" width="500">
          <tr>
            <td width="200">分类名称</td>
            <td width="200">新闻数量</td>
            <td width="100">&nbsp;</td>
          </tr>
<?php 
	foreach($newsTypes as $v)
	{
		echo "<tr>";
		echo "  <td id='td{$v["typeId"]}1'>{$v["typeName"]}</td>";
		echo "  <td id='td{$v["typeId"]}2'>{$v["articleNums"]}</td>";
		echo "  <td id='td{$v["typeId"]}3'>";
		echo "    <a href='#' onclick='showText({$v["typeId"]})'>编辑</a>";
		echo "    <a href=''>删除</a>";
		echo "  </td>";
		echo "</tr>";
	}
?>
        </table>
        </form>
      </div>
    </div>
  </body>
</html>








