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
	if(mysqli_num_rows($data)==0){
		$query="select topic_id from mismatch_topic order by topic_id";
		$data=mysqli_query($dbc,$query);
		$topicIDs=array();
		while($row=mysqli_fetch_array($data)){
			array_push($topicIDs,$row['topic_id']);
		}
		foreach($topicIDs as $topic_id){
			$query="insert into mismatch_response(user_id,topic_id)values('".$_SESSION['user_id']."','$topic_id')";
			mysqli_query($dbc,$query);
		}
	}
	
	if(isset($_POST['submit'])){
		foreach($_POST as $response_id=>$response){
			$query="update mismatch_response set response='$response'where response_id='$response_id'";
			mysqli_query($dbc,$query);
		}
		echo '<p>你的问卷已被提交</p>';
	}
	
	$query="select mr.response_id,mr.topic_id,mr.response,mt.name as topic_name,mc.name as category_name from mismatch_response as mr inner join mismatch_topic as mt using(topic_id) inner join mismatch_category as mc using(category_id) where mr.user_id='".$_SESSION['user_id']."'";
	$data=mysqli_query($dbc,$query) or die("查询失败");
	$responses=array();
	while($row=mysqli_fetch_array($data)){
		array_push($responses,$row);
	}
	mysqli_close($dbc);
	
	echo '<form method="post" action="'.$_SERVER['PHP_SELF'].'">';
	echo '<p>对下列主题你持什么态度？</p>';
	$category=$responses[0]['category_name'];
	echo '<fieldset><legend>'.$responses[0]['category_name'].'</legend>';
	foreach($responses as $response){
		if($category!=$response['category_name']){
			$category=$response['category_name'];
			echo '</fieldset><fieldset><legend>'.$response['category_name'].'</legend>';
		}
		echo '<label'.($response['response']==null?'class="error"':'').'for="'.$response['response_id'].'">'.$response['topic_name'].'</label><br/>';
		echo '<input type="radio" id="'.$response['response_id'].'" name="'.$response['response_id'].'" value="1"'.($response['response']==1?'checked="checked"':'').'>喜欢';
		echo '<input type="radio" id="'.$response['response_id'].'" name="'.$response['response_id'].'" value="2"'.($response['response']==2?'checked="checked"':'').'>不喜欢<br/>';
	}
	
	echo '</fieldset>';
	echo '<input type="submit" value="提交问卷" name="submit"/>';
	echo '</form>';

?>

<?php
	require_once('footer.php');
?>