<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>最高得分</title>
		<link rel="stylesheet" href="style.css" type="text/css"/>
	</head>
	<body>
		<h2>Guitar-wars-High Scores</h2>
		<p>欢迎访问吉它小站，你想提供你的得分记录吗？<a href="addscore.php">添加你的得分</a></p>
		<hr />
		
		<?php 
			require_once('appvars.php');
			require_once('connectvars.php');
			$dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
			
			$query="select * from guitarwars order by score DESC,DATE ASC";
			$data=mysqli_query($dbc,$query);
			
			echo '<table>';
			$i=0;
			while($row=mysqli_fetch_array($data)){
				if($i==0){
					echo '<tr><td colspan="2" class="topscoreheader">TOP SCORE:'.$row['score'].'</td></tr>';
				}
				
				echo '<tr><td class="scoreinfo">';
				echo '<span class="score">'. $row["score"].' </span><br/>';
				echo '<strong>name:</strong>'.$row["name"].'<br/>';
				echo '<strong>date:</strong>'.$row["date"].'</td>';
				if(is_file(GW_UPLOADPATH.$row['screenshot'])&&filesize(GW_UPLOADPATH.$row['screenshot'])>0){
					echo '<td><img src="'.GW_UPLOADPATH.$row['screenshot'].'" alt="score image"/></td></tr>';
				}else{
					echo '<td><img src="unverified.gif" alt="unverified score"/></td></tr>';
				}
				$i++;
			}
			echo '</table>';
			mysqli_close($dbc);
		?>
		
	</body>
</html>
