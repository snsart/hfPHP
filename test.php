<html>
	<head>
		<meta charset="UTF-8">
		<title>例一</title>
	</head>
	<body>
		<h2>你报告了一个劫持事件</h2>
		
	<?php
		$when_it_happend=$_POST['whenithappened'];
		$how_long=$_POST['howlong'];
		$alien_description=$_POST['aliendescription'];
		$fang_spotted=$_POST['fangspotted'];
		$email=$_POST['email'];
		
		echo '感谢你提交这个表单.<br/>';
		echo '你被劫持在'.$when_it_happend;
	?>
	</body>
</html>

