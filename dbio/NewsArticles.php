<?php
	if(file_exists('../conn/DbConn.php'))
	{
		include_once '../conn/DbConn.php';
	}
	else 
	{
		include_once 'conn/DbConn.php';
	}
	
	//newsArticles表的操作类
	class NewsArticles
	{
		//修改新闻
		public static function updateNews($articleId,$title,$content,$writer,$source,$typeId)
		{
			$sql = "update newsArticles set title='{$title}',content='{$content}',writer='{$writer}',source='{$source}',typeId={$typeId} where articleId={$articleId}";
			$conn = new DbConn();
			$result = $conn->executeUpdate($sql);
			$conn->close();
			return $result;
		}
		//删除一条新闻
		public static function delNews($articleId)
		{
			$sql1 = "delete from reviews where articleId={$articleId}";
			$sql2 = "delete from newsArticles where articleId={$articleId}";
			$conn = new DbConn();
			$result = $conn->executeUpdate("update newsTypes set articleNums=articleNums-1 where typeId=(select typeId from newsArticles where articleId={$articleId})");
			$result = $conn->executeUpdate($sql1);
			$result = $conn->executeUpdate($sql2);
			$conn->close();
			return $result;
		}
		//查询所有新闻
		public static function getAllNews($currentPage,$keyword=NULL,$searchType=NULL)
		{
			$pageSize = 6;//每页的记录数
			$totalRow = 0;//总记录数
			$totalPage = 0;//总页数
			$start = ($currentPage-1)*$pageSize;//每页记录的起始值
			
			$sql1 = "select * from newsArticles a inner join newsTypes b on a.typeId=b.typeId order by articleId limit {$start},{$pageSize}";
			$sql2 = "select count(*) from newsArticles a inner join newsTypes b on a.typeId=b.typeId";
			if($keyword != NULL)//搜索新闻
			{
				$sql1 = "select * from newsArticles a inner join newsTypes b on a.typeId=b.typeId and {$searchType} like '%{$keyword}%' order by articleId limit {$start},{$pageSize}";
				$sql2 = "select count(*) from newsArticles a inner join newsTypes b on a.typeId=b.typeId and {$searchType} like '%{$keyword}%'";
			}
			
			$conn = new DbConn();
			//查询总记录数、总页数
			$result = $conn->executeQuery($sql2);
			$totalRow = $result[0][0];//总记录
			$totalPage = ceil($totalRow/$pageSize);//总页数
			
			$result = $conn->executeQuery($sql1);
			$conn->freeResult();
			$conn->close();
			
			return array($result,$totalPage);
		}
		//添加新闻
		public static function addNews($content,$title,$typeId,$userName,$writer,$source,$imagepath)
		{
			$sql = "insert into newsArticles(content,title,typeId,userName,writer,source,imagepath)values('{$content}','{$title}',{$typeId},'{$userName}','{$writer}','{$source}','{$imagepath}')";
			$conn = new DbConn();
			$result = $conn->executeUpdate("update newsTypes set articleNums=articleNums+1 where typeId={$typeId}");
			$result = $conn->executeUpdate($sql);
			$conn->close();
			return $result;
		}
		//通过articleId获得一条新闻
		public static function getNewsById($articleId)
		{
			$sql = "select * from newsArticles a inner join newsTypes b on a.typeId=b.typeId and articleId={$articleId}";
			$conn = new DbConn();
			$result = $conn->executeQuery($sql);
			$conn->freeResult();
			$conn->close();
			return $result[0];
		}
		//搜索新闻
		public static function searchNews($searchType,$keyword)
		{
			$sql = "select * from newsArticles where {$searchType} like '%{$keyword}%'";
			$conn = new DbConn();
			$result = $conn->executeQuery($sql);
			$conn->freeResult();
			$conn->close();
			return $result;
		}
		//通过typeId获得该分类下所有新闻
		public static function getNewsByTypeId($typeId)
		{
			$sql = "select * from newsArticles where typeId={$typeId}";
			$conn = new DbConn();
			$result = $conn->executeQuery($sql);
			$conn->freeResult();
			$conn->close();
			return $result;
		}
		//新闻总数
		public static function getNewsCount()
		{
			$sql = "select count(*) from newsArticles";
			$conn = new DbConn();
			$result = $conn->executeQuery($sql);
			$conn->freeResult();
			$conn->close();
			return $result[0][0];
		}
		//热点要闻
		public static function getHotNews()
		{
			$sql = "select * from newsArticles a inner join newsTypes b on a.typeId=b.typeId order by hints desc limit 0,6";
			$conn = new DbConn();
			$result = $conn->executeQuery($sql);
			$conn->freeResult();
			$conn->close();
			return $result;
		}
		//获得某分类下的两条新闻
		public static function getNewsTwo($typeId)
		{
			$sql = "select * from newsArticles where typeId={$typeId} order by dateandtime desc limit 0,2";
			$conn = new DbConn();
			$result = $conn->executeQuery($sql);
			$conn->freeResult();
			$conn->close();
			return $result;
		}
	}
?>