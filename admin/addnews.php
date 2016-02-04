<?php 
	header("content-type:text/html;charset=utf-8");
	include_once 'nologin.php';
	include_once '../dbio/NewsTypes.php';
	include_once '../dbio/NewsArticles.php';
	
	//获得表单提交的数据
	$title = $_POST["title"];
	$typeId = $_POST["typeId"];
	$myFile = $_FILES["myFile"];
	$writer = $_POST["writer"];
	$source = $_POST["source"];
	$content = $_POST["content"];
	$userName = $_SESSION["userMsg"]["userName"];
	//表单提交(添加新闻)
	if($content != NULL)
	{
		$savePath = NULL;//图片保存路径
		if($myFile["name"] != NULL)//有图片，上传
		{
			//xxx.xx.jpg
			$fileName = $myFile["name"];//原文件名
			$arr = explode(".",$fileName);
			$ext = $arr[count($arr)-1];//扩展名
			$saveName = md5(time().rand(0,9).rand(0,9).rand(0,9)).".".$ext;
			$savePath = "newspicture/{$saveName}";
			move_uploaded_file($myFile["tmp_name"],"../{$savePath}");
		}
		//添加数据库
		$result = NewsArticles::addNews($content, $title, $typeId, $userName, $writer, $source, $savePath);
		header("location:success.php?act=addnews&rst={$result}");
	}
	
	
	
	$newsTypes = NewsTypes::getNewsTypes();//所有分类
?>
<html>
  <head>
    <title>添加新闻</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <link href="../css/admin.css" type="text/css" rel="stylesheet" />
    <script type="text/javascript" src="../jquery/jquery-1.4.js"></script>
    <script type="text/javascript" src="../kindeditor/kindeditor.js"></script>
    <script type="text/javascript">
      var editor;
      KindEditor.ready(function(e){
          editor = e.create("[name=content]",{
              width:"700px",
              height:"300px"
          });
      });
      function clearForm()
      {
          document.frm.reset();//表单重置
          editor.html("");
      }
      function submitForm()
      {
          if(document.frm.title.value == "")
          {
              alert("请输入新闻标题！");
              document.frm.title.focus();
              return false;
          }
          else if(editor.html() == "")
          {
              alert("请输入新闻内容！");
              editor.focus();
              return false;
          }
          else
          {
              document.frm.content.value = editor.html();
              document.frm.submit();
          }
      }
    </script>
  </head>
  <body>
    <!-- 页面头 -->
    <?php include_once 'header.php';?>
    <!-- 当前位置 -->
    <div class="locationDiv">：新闻管理：添加新闻</div>
    <!-- 正文内容 -->
    <div class="contentDiv clear">
      <!-- 左侧的div -->
      <div class="leftDiv"><?php include_once 'left.php';?></div>
      <!-- 右侧的div -->
      <div class="rightDiv">
        <br><br>
        <form name="frm" method="post" action="addnews.php" enctype="multipart/form-data">
        <table border="0" align="center" bgcolor="#DCDCDC">
          <tr>
            <td width="150">新闻标题：</td>
            <td><input type="text" name="title" size="50"></td>
          </tr>
          <tr>
            <td>新闻类型：</td>
            <td>
              <select name="typeId">
<?php 
	foreach($newsTypes as $v)
	{
		echo "<option value='{$v["typeId"]}'>{$v["typeName"]}</option>";
	}
?>
              </select>
            </td>
          </tr>
          <tr>
            <td>新闻图片：</td>
            <td><input type="file" name="myFile" size="30"></td>
          </tr>
          <tr>
            <td>新闻作者：</td>
            <td><input type="text" name="writer" size="50"></td>
          </tr>
          <tr>
            <td>新闻来源：</td>
            <td><input type="text" name="source" size="50"></td>
          </tr>
          <tr>
            <td colspan="2"><textarea name="content"></textarea></td>
          </tr>
          <tr>
            <td colspan="2" align="center">
              <a href="#" onclick="submitForm()">添加</a>
              &nbsp;&nbsp;&nbsp;
              <a href="#" onclick="clearForm()">取消</a>
            </td>
          </tr>
        </table>
        </form>
        <br><br>
      </div>
    </div>
  </body>
</html>








