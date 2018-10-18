<?php
	echo '<hr/>';
	if(isset($_SESSION['username'])){
		echo '<a href="index.php">主页</a>';
		echo '&#10084;<a href="viewprofile.php">查看你的主页</a>';
		echo '&#10084;<a href="editprofile.php">编辑你的主页</a>';
		echo '&#10084;<a href="logout.php">退出('.$_SESSION['username'].')</a>';
	}else{
		echo '&#10084;<a href="login.php">登录</a>';
		echo '&#10084;<a href="signup.php">注册</a>';
	}
	echo '<hr/>';
?>