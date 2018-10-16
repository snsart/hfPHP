<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>最高得分</title>
		<link rel="stylesheet" href="style.css" type="text/css"/>
	</head>
	<body>
		<h2>Mismatch-where opposites attract!</h2>
		<p><a href="viewprofile.php">查看你的主页</a></p>
		<p><a href="editprofile.php">编辑你的主页</a></p>
		<hr />
		<h4>会员列表</h4>
		<?php 
			require_once('appvars.php');
			require_once('connectvars.php');
			$dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die("数据库链接失败");
			
			$query="select * from mismatch_user order by join_date ASC";
			$data=mysqli_query($dbc,$query) or die("数据库查询失败");
			
			echo '<table>';
			
			while($row=mysqli_fetch_array($data)){
				
				if(is_file(GW_UPLOADPATH.$row['picture'])&&filesize(GW_UPLOADPATH.$row['picture'])>0){
					echo '<tr><td><img src="'.GW_UPLOADPATH.$row['picture'].'" alt="score image"/></td>';
				}else{
					echo '<tr><td><img src="unverified.gif" alt="unverified score"/></td>';
				}
				
				echo '<td class="scoreinfo">';
				echo '<strong>'.$row["name"].'</strong><br/>';
			}
			echo '</table>';
			mysqli_close($dbc);
		?>
		
	</body>
</html>
