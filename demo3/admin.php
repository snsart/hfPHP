<?php
require_once('authorize.php');	
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>最高得分</title>
		<link rel="stylesheet" href="style.css" type="text/css"/>
	</head>
	<body>
		<h2>Guitar-wars-High Scores</h2>
		<p>吉它小站后台管理界面</a></p>
		<hr />
		
		<?php 
			require_once('appvars.php');
			require_once('connectvars.php');
			$dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
			
			$query="select * from guitarwars order by score DESC,DATE ASC";
			$data=mysqli_query($dbc,$query);
			
			echo '<table>';
			while($row=mysqli_fetch_array($data)){
				
				echo '<tr class="scorerow"><td><strong>'.$row['name'].'</strong></td>';
				echo '<td>'.$row['date'].'</td>';
				echo '<td>'.$row['score'].'</td>';
				echo '<td><a href="removescore.php?id='.$row['id'].'&amp;date='.$row['date'].'&amp;name='.$row['name'].'&amp;score='.$row['score'].'&amp;screenshot='.$row['screenshot'].' " >remove</a>';
				if($row['approved']==0){
					echo ' / <a href="approvescore.php?id='.$row['id'].'&amp;date='.$row['date'].'&amp;name='.$row['name'].'&amp;score='.$row['score'].'&amp;screenshot='.$row['screenshot'].' " >approve</a>';
				}
				echo '</td></tr>';
				
			}
			echo '</table>';
			mysqli_close($dbc);
		?>
		
	</body>
</html>
