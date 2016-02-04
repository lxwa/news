<?php 
	header("content-type:text/html;charset=utf-8");
	include_once 'nologin.php';
	include_once '../dbio/NewsTypes.php';
	
	$typeName = $_POST["typeName"];
	//表单提交(添加分类)
	if($typeName != NULL)
	{
		$result = NewsTypes::addType($typeName);
		header("location:success.php?act=addtype&rst={$result}");
	}
?>
<html>
  <head>
    <title>添加分类</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <link href="../css/admin.css" type="text/css" rel="stylesheet" />
    <script type="text/javascript" src="../jquery/jquery-1.4.js"></script>
    <script type="text/javascript">
      function checkAdd()
      {
          if(document.frm.typeName.value == "")
          {
              alert("请输入分类名称！");
              document.frm.typeName.focus();
              return false;
          }
      }
    </script>
  </head>
  <body>
    <!-- 页面头 -->
    <?php include_once 'header.php';?>
    <!-- 当前位置 -->
    <div class="locationDiv">：分类管理：添加分类</div>
    <!-- 正文内容 -->
    <div class="contentDiv clear">
      <!-- 左侧的div -->
      <div class="leftDiv"><?php include_once 'left.php';?></div>
      <!-- 右侧的div -->
      <div class="rightDiv">
        <br><br><br>
        <form name="frm" method="post" action="addtype.php" onsubmit="return checkAdd()">
        <div class="addTypeDiv1">添加分类名</div>
        <div class="addTypeDiv2">分类名：<input type="text" name="typeName" size="30"></div>
        <br><br>
        <div class="addTypeDiv3"><input type="submit" value="添加"></div>
        </form>
      </div>
    </div>
  </body>
</html>








