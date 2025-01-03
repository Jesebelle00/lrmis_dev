<?php 
	session_start();

	require_once 'config.php'; 

	$total_lr=0;
	$query = "select status,count(fk_id) lr  from lrmis where school_code = ".$_SESSION["school_code"]." group by 1";
	
	$x=0;
	$status[]='';
	$lr2[]=0;

	$exec = mysqli_query($link,$query);
	while($row = mysqli_fetch_array($exec)){
		if($row['lr']!=0){
	 		$total_lr += $row['lr'];
			$status[$x]="'".$row['status']."'";
			$lr2[$x] = $row['lr'];
			$x+=1;
		}
	}
	$statuses= implode(',',$status);
	$lrs2=implode(',',$lr2);
?> 
