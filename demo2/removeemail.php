<html>
	<head>
		<meta charset="UTF-8">
		<title>例一</title>
	</head>
	<body>
	<p>请选择你要删除的邮件</p>
	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<?php
			$dbc=mysqli_connect('www.hfphp.com', 'root','root','elvis_store') or die('数据库链接失败');
			
			if(isset($_POST['submit'])){
				foreach($_POST['todelete'] as $delete_id){
					$query="delete from email_list where id=$delete_id";
					mysqli_query($dbc,$query) or die("删除失败");
				}
			}
			
			$squery="select *  from email_list";
			$result=mysqli_query($dbc,$squery);
			
			while($row=mysqli_fetch_array($result)){
				echo '<input type="checkbox" value="'.$row['id'].'" name="todelete[]">';
				echo $row['name'];
				echo $row['email'];
				echo '<br/>';
			}
		?>
		<input type="submit" name="submit" value="remove" />
	</form>
	
</body>
</html>