<html>
	<head>
		<meta charset="UTF-8">
		<title>例一</title>
	</head>
	<body>
		<h2>你报告了一个劫持事件</h2>
		
	<?php
		$name=$_POST['name'];
		$when_it_happend=$_POST['whenithappened'];
		$how_long=$_POST['howlong'];
		$alien_description=$_POST['aliendescription'];
		$fang_spotted=$_POST['fangspotted'];
		$email=$_POST['email'];
		$what_they_did=$_POST['whattheydid'];
		$fang_spotted=$_POST['fangspotted'];
		$other=$_POST['other'];
		
		$to='snsart@163.com';
		$subject='外星人劫持事件报告';		
		
		$msg="$name 在 when_it_happend 被劫持了,并且已经过去了$how_long.\n".
			"简单的描述：$alien_description\n".
			"它们做了什么：$what_they_did\n".
			"看见fang了吗：$fang_spotted\n".
			"其他要补充的：$other";
			
		mail($to,$subject,$msg,'From:'.$email);
		
		echo '感谢你提交这个表单.<br/>';
		echo '你被劫持在'.$when_it_happend.'<br/>';
		/*echo '测试'.$how_longss;*/
	?>
	</body>
</html>

