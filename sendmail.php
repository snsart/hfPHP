<html>
	<head>
		<meta charset="UTF-8">
		<title>例一</title>
	</head>
	<body>
	<?php
	$from='snsart@163.com';
	$subject=$_POST['subject'];
	$elvismail=$_POST['elvismail'];
	
	$dbc=mysqli_connect('www.hfPHP.com','root','root','elvis_store') or die('数据库链接失败');
	$query="select * from email_list";
	$result=mysqli_query($dbc,$query) or die('数据获取失败');
	while($row=mysqli_fetch_array($result)){
		echo $row['name'].':'.$row['email'].'<br/>';
	};
	mysqli_close($dbc);
	/*
	  这本书首先引入了一个模型——德雷福斯模型，介绍了从小工到专家的五个阶段：新手，超级新手、胜任者、精通和专家，
	*/
	?>
</body>
</html>