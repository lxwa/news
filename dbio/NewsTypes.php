<?php
	if(file_exists('../conn/DbConn.php'))
	{
		include_once '../conn/DbConn.php';
	}
	else 
	{
		include_once 'conn/DbConn.php';
	}
	
	//newsTypes表的操作类
	class NewsTypes
	{
		//修改分类
		public static function updateType($typeId,$typeName,$articleNums)
		{
			$sql = "update newsTypes set typeName='{$typeName}',articleNums={$articleNums} where typeId={$typeId}";
			$conn = new DbConn();
			$result = $conn->executeUpdate($sql);
			$conn->close();
			return $result;
		}
		//添加分类
		public static function addType($typeName)
		{
			$sql = "insert into newsTypes(typeName)values('{$typeName}')";
			$conn = new DbConn();
			$result = $conn->executeUpdate($sql);
			$conn->close();
			return $result;
		}
		//通过typeId，获得该分类的详细信息
		public static function getTypeByTypeId($typeId)
		{
			$sql = "select * from newsTypes where typeId={$typeId}";
			$conn = new DbConn();
			$result = $conn->executeQuery($sql);
			$conn->freeResult();
			$conn->close();
			return $result[0];
		}
		//查询所有分类
		public static function getNewsTypes()
		{
			$sql = "select * from newsTypes";
			$conn = new DbConn();
			$result = $conn->executeQuery($sql);
			$conn->freeResult();
			$conn->close();
			return $result;
		}
	}
?>