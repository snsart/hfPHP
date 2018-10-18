<?php
	require_once('startsession.php');
	if(!isset($_SESSION['user_id'])){
		require_once('login.php');
		exit();
	}else{
		$user_username=$_SESSION['username'];
	}
	
	$page_title='edit profile';
	require_once('header.php');
	
	require_once('appvars.php');
	require_once('connectvars.php');
	
	require_once('navmenu.php');
	
		if(isset($_POST['submit'])){
		$name=$_POST['name'];
		$gender=$_POST['gender'];
		$birthdate=$_POST['birthdate'];
		$city=$_POST['city'];
		$picture=$_FILES['picture']['name'];
		$picture_type=$_FILES['picture']['type'];
		$picture_size=$_FILES['picture']['size'];
		
		if(!empty($name)){
			if(!empty($picture)){
				if(($picture_type=='image/gif'||$picture_type=='image/jpeg'||$picture_type=='image/pjpeg'||$picture_type=='image/png')&&
				($picture_size>0&&$picture_size<=GW_MAXFILESIZE)){
					if($_FILES['picture']['error']==0){
						$target=GW_UPLOADPATH.$picture;
						move_uploaded_file($_FILES['picture']['tmp_name'],$target);
						
					}else{
						echo '<p class="error">上传出错</p>';
					}
					
				}else{
					echo '<p class="error">截屏必须使用gif、jpeg、png图像格式，并且小于32kb</p>';
				}
				@unlink($_FILES['picture']['tmp_name']);
			}
			
			$dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
			$query="update mismatch_user set name='$name',gender='$gender',birthdate='$birthdate',city='$city' where username='$user_username'";
			mysqli_query($dbc,$query) or die("数据更新失败");
			
			if(!empty($picture)){
				$query="update mismatch_user set picture='$picture' where username='$user_username'";
				mysqli_query($dbc,$query) or die("数据更新失败");
			}
							
			echo '<p>更新成功</p>';
			echo '<p> <a href="viewprofile.php">查看你的主页</a></p>';
			mysqli_close($dbc);
			
		}else{
			echo '<p class="error">请输入名字</p>';
		}
	}else{
		$dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die("数据库链接失败");
	
		$query="select * from mismatch_user where username='$user_username'";
		$data=mysqli_query($dbc,$query) or die("数据库查询失败");
		
		if(mysqli_num_rows($data)==1){
			$row=mysqli_fetch_array($data);
			$name=$row['name'];
			$gender=$row['gender'];
			$birthdate=$row['birthdate'];
			$city=$row['city'];
		}
		
		mysqli_close($dbc);
	}
?>
		
<hr />
<form enctype="multipart/form-data" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	<input type="hidden" name="MAX_FILE_SIZE" value="3276800" />
	<label for="name">名字：</label>
	<input type="text" id="name" name="name" value="<?php if(!empty($name)) echo $name; ?>"/><br/>
	<label for="gender">性别：</label>
	<input type="text" id="gender" name="gender" value="<?php if(!empty($gender)) echo $gender; ?>"/><br/>
	<label for="birthdate">出生日期：</label>
	<input type="text" id="birthdate" name="birthdate" value="<?php if(!empty($birthdate)) echo $birthdate; ?>"/><br/>
	<label for="city">城市：</label>
	<input type="text" id="city" name="city" value="<?php if(!empty($city)) echo $city; ?>"/><br/>
	
	<label for="picture">头像：</label>
	<input type="file" id="picture" name="picture" /><br/>
	<hr/>
	<input type="submit" value="add" name="submit" />
</form>

<?php
	require_once('footer.php');
?>
