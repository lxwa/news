<?php
	if(file_exists('../conn/DbConn.php'))
	{
		include_once '../conn/DbConn.php';
	}
	else 
	{
		include_once 'conn/DbConn.php';
	}
	
	//reviews表的操作类
	class Reviews
	{
		//删除一个评论
		public static function delReviewById($id)
		{
			$sql = "delete from reviews where id={$id}";
			$conn = new DbConn();
			$result = $conn->executeUpdate($sql);
			$conn->close();
			return $result;
		}
		//获得某新闻的所有评论
		public static function getReviews($articleId)
		{
			$sql = "select * from reviews where articleId={$articleId}";
			$conn = new DbConn();
			$result = $conn->executeQuery($sql);
			$conn->freeResult();
			$conn->close();
			return $result;
		}
		//添加评论
		public static function addReviews($articleId,$userName,$body,$face)
		{
			$sql = "insert into reviews(articleId,userName,body,face)values({$articleId},'{$userName}','{$body}','{$face}')";
			$conn = new DbConn();
			$row = $conn->executeUpdate($sql);
			$conn->close();
			return $row;
		}
	}
?>






