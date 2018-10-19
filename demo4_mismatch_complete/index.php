<?php
	require_once('startsession.php');
	$page_title='where opposites abstract!';
	require_once('header.php');
	
	require_once('appvars.php');
	require_once('connectvars.php');
	
	require_once('navmenu.php');
	echo '<h4>会员列表</h4>';
	$dbc=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME) or die("数据库链接失败");
	
	$query="select * from mismatch_user order by join_date ASC";
	$data=mysqli_query($dbc,$query) or die("数据库查询失败");
	
	echo '<table>';
	while($row=mysqli_fetch_array($data)){
		
		if(is_file(GW_UPLOADPATH.$row['picture'])&&filesize(GW_UPLOADPATH.$row['picture'])>0){
			echo '<tr><td><img src="'.GW_UPLOADPATH.$row['picture'].'" alt="image"/></td>';
		}else{
			echo '<tr><td><img src="unverified.gif" alt="image"/></td>';
		}
		
		echo '<td class="username">';
		if(isset($_SESSION['username'])){
			echo '<strong><a href="viewprofile.php?username='.$row['username'].'">'.$row["name"].'</a></strong></td><br/>';
		}else{
			echo '<strong>'.$row["name"].'</strong></td><br/>';
		}
		
	}
	echo '</table>';
	mysqli_close($dbc);

?>
<?php
	require_once('footer.php');
?>


