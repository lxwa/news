<script type="text/javascript">
  $(document).ready(function(){
	  $("#menuDiv1,#menuDiv2,#menuDiv3,#menuDiv4,#menuDiv5").hover(function(){
		  $(this).css("background-color","#D4D0C8");
		  $(this).find("div").show();
      },
      function(){
    	  $(this).css("background-color","#E4E9EC");
    	  $(this).find("div").hide();
      });
  });
  //管理员退出后台管理系统
  function logout()
  {
	  if(confirm("是否退出后台管理系统？"))
	  {
		  window.location = "success.php?act=logout";
	  }
  }
</script>
<div class="headDiv">
  <div class="headDiv1">www.ttnewS.com</div>
  <div class="headDiv2"><img src="../images/image6.gif"></div>
</div>
<div class="headDiv3">&nbsp;</div>
<!-- 菜单栏 -->
<div class="menuDiv">
  <div id="menuDiv1"><a href="#" onclick="logout()">重新登陆</a></div>
  <div id="menuDiv2">
    <a href="#">新闻管理</a><br>
    <div class="menus">
      <a href="addnews.php">添加新闻</a><br>
      <a href="modnews.php">修改新闻</a><br>
    </div>
  </div>
  <div id="menuDiv3">
    <a href="#">分类管理</a><br>
    <div class="menus">
      <a href="addtype.php">添加分类</a><br>
      <a href="modtype.php">修改分类</a><br>
    </div>
  </div>
  <div id="menuDiv4">
    <a href="#">用户管理</a><br>
    <div class="menus">
      <a href="addtype.php">添加用户</a><br>
    </div>
  </div>
  <div id="menuDiv5"><a href="index.php">返回首页</a></div>
</div>






