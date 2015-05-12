<?php
	// connect to mysql
	include ('../3971thesis-db/db-MysqlAccess.php');
	
	// get tasks
	$resTasks = $mysqli->query("
		select *
		from bgtd_tasks
	");
	$arrTasks = array();
	while ($row = $resTasks->fetch_assoc()) {
		array_push($arrTasks, $row);
	}
	$resTasks->close();
	
	// create blank taskupdates in each task
	for ($i = 0; $i < count($arrTasks); $i++) {
		$arrTasks[$i]['taskUpdates'] = array();
		$arrTasks[$i]['latestStatus'] = 1;
	}
	
	$resTaskUpdates = $mysqli->query("
		select *
		from bgtd_task_updates
		order by create_ts asc
	");
	while ($row = $resTaskUpdates->fetch_assoc()) {
		for ($i = 0; $i < count($arrTasks); $i++) {
			if ($arrTasks[$i]['task_id'] == $row['task_id']) {
				array_push($arrTasks[$i]['taskUpdates'], $row);
				$arrTasks[$i]['latestStatus'] = $row['status_id'];
			}
		}
	}
	$resTaskUpdates->close();
	$mysqli->close();
	
	$arr = array(
		"tasks" => $arrTasks
	);
	
	header('Content-type: application/json');
	echo json_encode($arr, JSON_PRETTY_PRINT);
?>