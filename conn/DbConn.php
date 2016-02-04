<?php
	//数据库封装类
	class DbConn
	{
		private $conn = NULL;//连接对象
		private $rs = NULL;//结果集对象
		
		//连接数据库
		public function __construct()
		{
			$this->conn = mysql_connect("localhost","root","111111");
			mysql_query("set names utf8");
			mysql_select_db("news");
		}
		//执行insert、update、delete语句，返回受影响的行数
		public function executeUpdate($sql)
		{
			mysql_query($sql);
			$row = mysql_affected_rows($this->conn);
			return $row;
		}
		//执行select语句，返回二维数组(所有的查询结果)
		public function executeQuery($sql)
		{
			$result = array();//存储所有记录
			$this->rs = mysql_query($sql);
			while($row = mysql_fetch_array($this->rs))
			{
				$result[] = $row;
			}
			return $result;
		}
		//释放结果集
		public function freeResult()
		{
			mysql_free_result($this->rs);
		}
		//关闭数据库
		public function close()
		{
			mysql_close($this->conn);
		}
	}
?>