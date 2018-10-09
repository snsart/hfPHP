<html>
	<head>
		<meta charset="UTF-8">
		<title>例一</title>
	</head>
	<body>
		<h2>你报告了一个劫持事件</h2>
		
	<?php
		$name=$_POST['name'];
		$when_it_happened=$_POST['whenithappened'];
		$how_long=$_POST['howlong'];
		$alien_description=$_POST['aliendescription'];
		$fang_spotted=$_POST['fangspotted'];
		$email=$_POST['email'];
		$what_they_did=$_POST['whattheydid'];
		$other=$_POST['other'];
		
		$to='snsart@163.com';
		$subject='外星人劫持事件报告';		
		
		$msg="$name 在 when_it_happend 被劫持了,并且已经过去了$how_long.\n".
			"简单的描述：$alien_description\n".
			"它们做了什么：$what_they_did\n".
			"看见fang了吗：$fang_spotted\n".
			"其他要补充的：$other";
			
		/*mail($to,$subject,$msg,'From:'.$email);*/
		
		$dbc=mysqli_connect('www.hfPHP.com','root','root','aliendatabase')or die('Errot connecting to MYSQL server.');
		$query="INSERT INTO aliens_abduction(name,when_it_happened,how_long,alien_description,fang_spotted,email,what_they_did,other)".
		"VALUES('$name','$when_it_happened','$how_long','$alien_description','$fang_spotted','$email','$what_they_did','$other')";
		$result=mysqli_query($dbc,$query)or die('Error querying database.');
		mysqli_close($dbc);
		
		
		echo '感谢你提交这个表单.<br/>';
		echo '你被劫持在'.$when_it_happened.'<br/>';
		/*echo '测试'.$how_longss;*/
	?>
	</body>
</html>

