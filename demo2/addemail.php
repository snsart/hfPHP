<html>
	<head>
		<meta charset="UTF-8">
		<title>例一</title>
	</head>
	<body>
	<?php
	$name=$_POST['name'];
	$email=$_POST['email'];
	$dbc=mysqli_connect('www.hfPHP.com','root','root','elvis_store') or die('数据库链接失败');
	$query="insert into email_list(name,email)".
		"values('$name','$email')";
	mysqli_query($dbc,$query) or die('数据添加失败');
	mysqli_close($dbc);
	echo '添加成功';
	?>
</body>
</html>