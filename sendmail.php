<html>
	<head>
		<meta charset="UTF-8">
		<title>例一</title>
	</head>
	<body>
	<?php
		$subject="";
		$elvismail="";
		if(isset($_POST['submit'])){
			$from='snsart@163.com';
			$subject=$_POST['subject'];
			$elvismail=$_POST['elvismail'];
			$output_form=false;
			
			if(empty($subject)&&empty($elvismail)){
				echo '你忘了填写邮件名和邮件内容</br>';
				$output_form=true;
			}
			
			if(empty($subject)&&!empty($elvismail)){
				echo '你忘了填写邮件名</br>';
				$output_form=true;
			}
			
			if(!empty($subject)&&empty($elvismail)){
				echo '你忘了填写邮件内容</br>';
				$output_form=true;
			}
			
			if(!empty($subject)&&!empty($elvismail)){
				$dbc=mysqli_connect('www.hfPHP.com','root','root','elvis_store') or die('数据库链接失败');
				$query="select * from email_list";
				$result=mysqli_query($dbc,$query) or die('数据获取失败');
				while($row=mysqli_fetch_array($result)){
					echo $row['name'].':'.$row['email'].'<br/>';
				};
				mysqli_close($dbc);
			}
		}else{
			$output_form=true;
		}
		
		if($output_form){
	?>
	
		<form method="post" action=<?php echo $_SERVER['PHP_SELF']; ?>
			<label for="subject">主题</label><br/>
			<input type="text" id="subject" name="subject" size='60' value="<?php echo $subject; ?>"/><br/>
			<label for="elvismail">邮件内容</label><br/>
			<textarea id="elvismail" name="elvismail" rows="8" cols="60" /><?php echo $elvismail; ?></textarea><br/>
			<input type="submit" value="提交" name="submit"/>
		</form>
		
	<?php
		}
	?>
</body>
</html>