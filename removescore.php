<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>删除确认</title>
		<link rel="stylesheet" href="style.css" type="text/css"/>
	</head>
	<body>
		<h2>Guitar-wars-High Scores</h2>
		<p>删除确认界面</a></p>
		<hr />
		
		<?php 
			require_once('appvars.php');
			require_once('connectvars.php');
			
			if(isset($_GET['id'])&&isset($_GET['date'])&&isset($_GET['name'])&&isset($_GET['score'])&&isset($_GET['screenshot'])){
				$id=$_GET['id'];
				$date=$_GET['date'];
				$name=$_GET['name'];
				$score=$_GET['score'];
				$screenshot=$_GET['screenshot'];
			}else if(isset($_POST['id'])&&isset($_POST['name'])&&isset($_POST['score'])){
				$id=$_POST['id'];
				$name=$_POST['name'];
				$score=$_POST['score'];
			}else{
				echo '<p class="error">抱歉，高分没有删除</p>';
			}
			
			if(isset($_POST['submit'])){
				if($_POST['confirm']=='yes'){
					@unlink(GW_UPLOADPATH.$screenshot);
					$dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
					$query="delete from guitarwars where id=$id limit 1";
					mysqli_query($dbc,$query);
					mysqli_close($dbc);
					echo '<p>'.$name.'的分数'.$score.'被成功删除</p>';
				}else{
					echo '<p class="error">抱歉，高分没有删除</p>';
				}
			}else if(isset($id)&&isset($name)&&isset($date)&&isset($score)&&isset($screenshot)){
				echo '<p>你确定要删除以下分数</p>';
				echo '<p><strong>name:</strong>'.$name.'<br/><strong>date:</strong>'.$date.'<br/><strong>score:</strong>'.$score.'</p>';
				echo '<form method="post" action="removescore.php">';
				echo '<input type="radio" name="confirm" value="yes"/>Yes';
				echo '<input type="radio" name="confirm" value="no" checked="checked" />No<br/>';
				echo '<input type="submit" value="Submit" name="submit" />';
				echo '<input type="hidden" name="id" value="'.$id.'"/>';
				echo '<input type="hidden" name="name" value="'.$name.'"/>';
				echo '<input type="hidden" name="score" value="'.$score.'"/>';
				echo '</form>';
			}
			
			echo '<p><a href="admin.php">&lt;&lt;返回管理界面</a></p>';
			
		?>
		
	</body>
</html>
