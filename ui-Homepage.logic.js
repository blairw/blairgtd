function bodyDidLoad() {
	$("#statusBar").html("bodyDidLoad()");
	$.get("db-GetProjectStuff.php", function(ajaxResponse) {
		console.log(ajaxResponse);
		for (i = 0; i < ajaxResponse.tasks.length; i++) {
			$("#statusBar").html("processing");
			if (ajaxResponse.tasks[i].latestStatus == 1) {
				$("#outputTasksTodo").append(
					'<a class="list-group-item">'
					+ajaxResponse.tasks[i].task_name
					+'<span class="pull-right"><button class="btn btn-xs"><i class="fa fa-arrow-right"></i></button></span></a>'
				);
			} else if (ajaxResponse.tasks[i].latestStatus == 2) {
				$("#outputTasksInProgress").append(
					'<a class="list-group-item">'
					+ajaxResponse.tasks[i].task_name
					+'<span class="pull-right"><span class="btn-group">'
					+'<button class="btn btn-xs"><i class="fa fa-arrow-left"></i></button>'
					+'<button class="btn btn-xs"><i class="fa fa-arrow-right"></i></button>'
					+'</span></span></a>');
			} else if (ajaxResponse.tasks[i].latestStatus == 3) {
				$("#outputTasksDone").append(
					'<a class="list-group-item">'
					+ajaxResponse.tasks[i].task_name
					+'<span class="pull-right"><button class="btn btn-xs"><i class="fa fa-arrow-left"></i></button></span></a>'
				);
			} else {
			}
		}
		$("#statusBar").html("done "+new Date());
		$("#statusBar").removeClass("statusBarLoading");
		$("#statusBar").addClass("statusBarDone");
	});
}