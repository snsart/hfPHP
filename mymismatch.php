<?php
	require_once('startsession.php');
	if(!isset($_SESSION['user_id'])){
		echo '<p class="login">please <a href="login.php">log in</a></p>';
		exit();
	}
	$page_title='Questionnaire';
	require_once('header.php');
	
	require_once('appvars.php');
	require_once('connectvars.php');
	
	require_once('navmenu.php');
	
	$dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die("数据库链接失败");
	$query="select * from mismatch_response where user_id='".$_SESSION['user_id']."'";
	$data=mysqli_query($dbc,$query);
	if(mysqli_num_rows($data)!=0){
		$user_response=array();
		$query="select mr.response_id,mr.topic_id,mr.response,mt.name as topic_name from mismatch_response as mr inner join mismatch_topic as mt using(topic_id) where mr.user_id='".$_SESSION['user_id']."'";                    
		$data=mysqli_query($dbc,$query);
		while($row=mysqli_fetch_array($data)){
			array_push($user_response,$row);
		}
		
		$mismatch_score=0;
		$mismatch_user_id=-1;
		$mismatch_topics=array();
		
		$query="select user_id from mismatch_user where user_id!='".$_SESSION['user_id']."'";
		$data=mysqli_query($dbc,$query);
		while($row=mysqli_fetch_array($data)){
			$query2="select response_id,topic_id,response from mismatch_response where user_id='".$row['user_id']."'";
			$data2=mysqli_query($dbc,$query2);
			$mismatch_responses=array();
			while($row2=mysqli_fetch_array($data2)){
				array_push($mismatch_responses,$row2);
			}
			
			$score=0;
			$topics=array();
			
			for($i=0;$i<count($user_response);$i++){
				if((int)$user_response[$i]['response']+(int)$mismatch_responses[$i]['response']==3){
					$score++;
					array_push($topics,$user_response[$i]['topic_name']);
				}
			}
			
			if($score>$mismatch_score){
				$mismatch_score=$score;
				$mismatch_user_id=$row['user_id'];
				$mismatch_topics=array_slice($topics,0);
			}
		}
		
		if($mismatch_user_id!=-1){
			$query="select username,name,city,picture from mismatch_user where user_id='$mismatch_user_id'";
			$data=mysqli_query($dbc,$query);
			if(mysqli_num_rows($data)==1){
				$row=mysqli_fetch_array($data);
				echo '<table><tr><td class="label">';
				if(!empty($row['name'])){
					echo $row['name'].'<br/>';
				}
				if(!empty($row['city'])){
					echo $row['city'].'<br/>';
				}
				echo '</td></table>';
				echo '<h4>你们在下面'.count($mismatch_topics).'项互补</h4>';
				foreach($mismatch_topics as $topic){
					echo $topic.'<br/>';
				}
				
				echo '<h4>查看<a href=viewprofile.php?username='.$row['username'].'>'.$row['name'].'的主页<a></h4>';
			}
		}
		
	}else{
		echo '<p>请先填写<a href="questionnaire.php">问卷调查表</a>以得到你的互补配对</p>';
	}
	
	
?>

<?php
	require_once('footer.php');
?>