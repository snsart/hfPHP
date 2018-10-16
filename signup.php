
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>注册</title>
		<link rel="stylesheet" href="style.css" type="text/css"/>
	</head>
	<body>
		<h2>Mismatch-sign up</h2>
		
		<?php 
			require_once('appvars.php');
			require_once('connectvars.php');
			$dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
			if(isset($_POST['submit'])){
				$username=mysqli_real_escape_string($dbc,trim($_POST['username']));
				$password1=mysqli_real_escape_string($dbc,trim($_POST['password1']));
				$password2=mysqli_real_escape_string($dbc,trim($_POST['password2']));
				
				if(!empty($username)&&!empty($password1)&&!empty($password2)&&($password1==$password2)){
					
					$query="select * from mismatch_user where username='$username'";
					$data=mysqli_query($dbc,$query) or die("数据查询失败");
					
					if(mysqli_num_rows($data)==0){
						$query="insert into mismatch_user(username,password,join_date) values('$username',SHA('$password1'),now())";
						mysqli_query($dbc,$query) or die("数据更新失败");
						echo '<p>注册成功，你现在可以<a href="editprofile.php">编辑你的详细信息</a></p>';
						mysqli_close($dbc);
						exit();
					}else{
						echo '<p class="error">账号已经存在，请输入一个不同的用户名</p>';
						$username="";
					}
									
				}else{
					echo '<p class="error">请输入所有信息，密码需输入两次</p>';
				}
			}
		?>
		
		<hr />
		<p>请输入用户名和密码</p>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<fieldset>
				<legend>注册</legend>
				<label for="username">用户名：</label>
				<input type="text" id="username" name="username" value="<?php if(!empty($username)) echo $username; ?>"/><br/>
				<label for="password1">密码：</label>
				<input type="password" id="password1" name="password1"/><br/>
				<label for="password2">重新输入密码：</label>
				<input type="password" id="password2" name="password2"/><br/>
			
			</fieldset>
			<input type="submit" value="add" name="submit" />
		</form>
		
	</body>
</html>
