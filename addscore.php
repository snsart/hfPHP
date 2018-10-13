<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>添加你的得分</title>
		<link rel="stylesheet" href="style.css" type="text/css"/>
	</head>
	<body>
		<h2>Guitar-wars-Add Your Scores</h2>
		
		<?php 
			
			require_once('appvars.php');
			require_once('connectvars.php');
			
			if(isset($_POST['submit'])){
				$name=$_POST['name'];
				$score=$_POST['score'];
				$screenshot=$_FILES['screenshot']['name'];
				$screenshot_type=$_FILES['screenshot']['type'];
				$screenshot_size=$_FILES['screenshot']['size'];
				
				if(!empty($name)&&!empty($score)&&!empty($screenshot)){
					if(($screenshot_type=='image/gif'||$screenshot_type=='image/jpeg'||$screenshot_type=='image/pjpeg'||$screenshot_type=='image/png')&&
					($screenshot_size>0&&$screenshot_size<=GW_MAXFILESIZE)){
						if($_FILES['screenshot']['error']==0){
							$target=GW_UPLOADPATH.$screenshot;
							echo $target;
							if(move_uploaded_file($_FILES['screenshot']['tmp_name'],$target)){
								$dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
								$query="insert into guitarwars values(0,now(),'$name','$score','$screenshot')";
								mysqli_query($dbc,$query);
								
								echo '<p>感谢你提供你的得分</p>';
								echo '<strong>name:</strong>'.$name.'<br/>';
								echo '<strong>score:</strong>'.$score.'<br/>';
								echo '<img src="'.GW_UPLOADPATH.$screenshot.'" alt="score image"/><br/>';
								echo '<p> <a href="index.php">查看得分页</a></p>';
								$name="";
								$score="";
								mysqli_close($dbc);
							}
							
						}else{
							echo '<p class="error">上传出错</p>';
						}
						
					}else{
						echo '<p class="error">截屏必须使用gif、jpeg、png图像格式，并且小于32kb</p>';
					}
					@unlink($_FILES['screenshot']['tmp_name']);
					
				}else{
					echo '<p class="error">请输入所有信息</p>';
				}
			}
		?>
		
		<hr />
		<form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<input type="hidden" name="MAX_FILE_SIZE" value="3276800" />
			<label for="name">名字：</label>
			<input type="text" id="name" name="name" value="<?php if(!empty($name)) echo $name; ?>"/><br/>
			<label for="score">得分：</label>
			<input type="text" id="score" name="score" value="<?php if(!empty($score)) echo $score; ?>"/><br/>
			<label for="screenshot">截屏：</label>
			<input type="file" id="screenshot" name="screenshot"/><br/>
			<hr/>
			<input type="submit" value="add" name="submit" />
		</form>
		
	</body>
</html>
