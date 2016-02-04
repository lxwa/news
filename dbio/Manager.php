<?php
	if(file_exists('../conn/DbConn.php'))
	{
		include_once '../conn/DbConn.php';
	}
	else 
	{
		include_once 'conn/DbConn.php';
	}
	
	//manager表的操作类
	class Manager
	{
		//登陆验证
		public static function checkLogin($userName,$password)
		{
			$sql = "select * from manager where userName='{$userName}' and password='{$password}'";
			$conn = new DbConn();
			$result = $conn->executeQuery($sql);
			$conn->close();
			return $result[0];
		}
	}
?>










