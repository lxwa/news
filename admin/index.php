<?php 
	header("content-type:text/html;charset=utf-8");
	include_once 'nologin.php';
?>
<html>
  <head>
    <title>后台管理网站</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <link href="../css/admin.css" type="text/css" rel="stylesheet" />
    <script type="text/javascript" src="../jquery/jquery-1.4.js"></script>
  </head>
  <body>
    <!-- 页面头 -->
    <?php include_once 'header.php';?>
    <!-- 当前位置 -->
    <div class="locationDiv">：后台管理：管理首页</div>
    <!-- 正文内容 -->
    <div class="contentDiv clear">
      <!-- 左侧的div -->
      <div class="leftDiv"><?php include_once 'left.php';?></div>
      <!-- 右侧的div -->
      <div class="rightDiv">
        <div class="welcomeDiv">欢迎登陆天天网管理系统</div>
        <div class="roleDiv">您的权限是：您是<?php echo $_SESSION["userMsg"]["userType"]?></div>
      </div>
    </div>
  </body>
</html>








