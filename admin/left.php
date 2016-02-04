<script type="text/javascript" src="js/dtree.js"></script>
<script type="text/javascript">
  function hello()
  {
	  d = new dTree('d');
      d.add(0,-1,'后台管理','');

      d.add(1,0,'重新登陆','javascript:logout()');

      d.add(2,0,'新闻管理','');
      d.add(21,2,'添加新闻','addnews.php');
      d.add(22,2,'修改新闻','modnews.php');

      d.add(3,0,'分类管理','');
      d.add(31,3,'添加分类','addtype.php');
      d.add(32,3,'修改分类','modtype.php');

      d.add(4,0,'用户管理','');
      d.add(41,4,'添加用户','adduser.php');

      d.add(5,0,'返回首页','index.php');

      document.write(d);
  }

  hello();
</script>










