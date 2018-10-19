<?php
	require_once('startsession.php');
	if(!isset($_SESSION['user_id'])){
		require_once('login.php');
		exit();
	}else{
		if(isset($_GET['username'])){
			$user_username=$_GET['username'];
		}else{
			$user_username=$_SESSION['username'];
		}	
	}
	$page_title='View Profile';
	require_once('header.php');
	
	require_once('appvars.php');
	require_once('connectvars.php');
	
	require_once('navmenu.php');
	
	$dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die("数据库链接失败");
			
	$query="select * from mismatch_user where username='$user_username'";
	$data=mysqli_query($dbc,$query) or die("数据库查询失败");
	
	
	while($row=mysqli_fetch_array($data)){
		echo '<strong>用户名:</strong>'.$row["username"].'</br>';
		echo '<strong>名字:</strong>'.$row["name"].'</br>';
		echo '<strong>性别:</strong>'.($row["gender"]=='F'?'女':'男').'</br>';
		echo '<strong>生日:</strong>'.$row["birthdate"].'</br>';
		echo '<strong>城市:</strong>'.$row["city"].'</br>';
		
		if(is_file(GW_UPLOADPATH.$row['picture'])&&filesize(GW_UPLOADPATH.$row['picture'])>0){
			echo '<strong>头像:</strong><img src="'.GW_UPLOADPATH.$row['picture'].'" alt="score image"/>';
		}else{
			echo '<strong>头像:</strong><img src="unverified.gif" alt="picture"/>';
		}	
	}
	mysqli_close($dbc);
?>

	<p><a href="editprofile.php">编辑你的主页</a></p>
		
<?php
	require_once('footer.php');
?>
