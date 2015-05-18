<?php
	if (isset($_GET['id']) && is_int((int) $_GET['id'])) {
		// only continue if id is set and it is an int
		$selectedId = $_GET['id'];
	} else {
		// send them to the index page whatever it may be
		header('Location: ./');
	}
	
	// connect to mysql
	include ('../3971thesis-db/db-MysqlAccess.php');
	
	// project info
	$resProjects = $mysqli->query("
		select *
		from bgtd_projects
		where project_id = ".$selectedId."
	");
	$arrProjects = array();
	while ($row = $resProjects->fetch_assoc()) {
		array_push($arrProjects, $row);
	}
	$resProjects->close();
	
	// get tasks
	$resTasks = $mysqli->query("
		select *
		from bgtd_tasks
		where project_id = ".$selectedId."
		order by isnull(due_date) ASC, due_date asc
	");
	$arrTasks = array();
	while ($row = $resTasks->fetch_assoc()) {
		array_push($arrTasks, $row);
	}
	$resTasks->close();
	
	// get files
	$resFiles = $mysqli->query("
		select *
		from bgtd_project_files
		where project_id = ".$selectedId."
	");
	$arrFiles = array();
	while ($row = $resFiles->fetch_assoc()) {
		array_push($arrFiles, $row);
	}
	$resFiles->close();
	
	// create blank taskupdates in each task
	for ($i = 0; $i < count($arrTasks); $i++) {
		$arrTasks[$i]['taskUpdates'] = array();
		$arrTasks[$i]['latestStatus'] = 1;
		$arrTasks[$i]['latestPriority'] = null;
	}
	
	$resTaskUpdates = $mysqli->query("
		select *
		from bgtd_task_updates
		where task_id in (
			select task_id
			from bgtd_tasks
			where project_id = ".$selectedId."
		)
		order by create_ts asc
	");
	while ($row = $resTaskUpdates->fetch_assoc()) {
		for ($i = 0; $i < count($arrTasks); $i++) {
			if ($arrTasks[$i]['task_id'] == $row['task_id']) {
				array_push($arrTasks[$i]['taskUpdates'], $row);
				$arrTasks[$i]['latestStatus'] = $row['status_id'];
				$arrTasks[$i]['latestPriority'] = $row['priority'];
			}
		}
	}
	$resTaskUpdates->close();
	$mysqli->close();
	
	$arr = array(
		"projectInfo" => $arrProjects[0],
		"tasks" => $arrTasks,
		"files" => $arrFiles
	);
	
	header('Content-type: application/json');
	echo json_encode($arr, JSON_PRETTY_PRINT);
?>