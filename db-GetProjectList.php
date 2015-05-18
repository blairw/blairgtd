<?php
	// connect to mysql
	include ('../3971thesis-db/db-MysqlAccess.php');
	
	// get tasks
	$resProjects = $mysqli->query("
		select *
		from bgtd_projects
		order by project_name
	");
	$arrProjects = array();
	while ($row = $resProjects->fetch_assoc()) {
		array_push($arrProjects, $row);
	}
	$resProjects->close();
	
	header('Content-type: application/json');
	echo json_encode($arrProjects, JSON_PRETTY_PRINT);
?>