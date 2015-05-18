function bodyDidLoad() {
	$("#statusBar").html("bodyDidLoad()");
	$.get("db-GetProjectList.php", function(ajaxResponseA) {
		for (j = 0; j < ajaxResponseA.length; j++) {
			$('#projectSelector').append(
				'<li><a href="index.php?projectId='+ajaxResponseA[j].project_id+'">'+ajaxResponseA[j].project_name+'</a></li>'
			);
		}
	
		$.get("db-GetProjectDetails.php?id="+selectedId, function(ajaxResponse) {
			
			document.title = ajaxResponse.projectInfo.project_name;
			$('#navbarSubtitle').html(ajaxResponse.projectInfo.project_name);
			
			for (i = 0; i < ajaxResponse.tasks.length; i++) {
				var tempTaskPrefix = (
					ajaxResponse.tasks[i].latestPriority
					? "<span class='priorityListing'>(P"+ajaxResponse.tasks[i].latestPriority+")</span>&nbsp;"
					: ""
				);
				var tempTaskName = (
					ajaxResponse.tasks[i].url
					? "<a href='"+ajaxResponse.tasks[i].url+"' target='_blank'>"+ajaxResponse.tasks[i].task_name+"</a>"
					: ajaxResponse.tasks[i].task_name
				);
				var tempTaskText = '<li class="list-group-item">'
				+'<span class="pull-right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
				+(
					ajaxResponse.tasks[i].req_net
					? '<i class="fa fa-wifi"></i>'
					: ''
				)
				+(
					ajaxResponse.tasks[i].req_home
					? '<i class="fa fa-home"></i>'
					: ''
				)
				+'</span>'
				+(
					ajaxResponse.tasks[i].due_date
					? "[#"+ajaxResponse.tasks[i].task_id+"] "+tempTaskPrefix+tempTaskName
					: "[#"+ajaxResponse.tasks[i].task_id+"] "+tempTaskPrefix+'<em>'+tempTaskName+'</em>'
				)
				+'</li>'
			
				$("#statusBar").html("processing");
				if (ajaxResponse.tasks[i].latestStatus == 1) {
					$("#outputTasksTodo").append(tempTaskText);
				} else if (ajaxResponse.tasks[i].latestStatus == 2) {
					$("#outputTasksInProgress").append(tempTaskText);
				} else if (ajaxResponse.tasks[i].latestStatus == 3) {
					$("#outputTasksDone").append(tempTaskText);
				} else {
					// do nothing
				}
			}
			// $("#statusBar").html("done "+new Date());
			// $("#statusBar").removeClass("statusBarLoading");
			// $("#statusBar").addClass("statusBarDone");
			
			for (i = 0; i < ajaxResponse.files.length; i++) {
				var tempFilename = ajaxResponse.files[i].pfile_label;
				var tempFileUrl = ajaxResponse.files[i].pfile_url;
				var tempFileType = ajaxResponse.files[i].pfile_type;

				$("#outputFiles").append(
					'<li class="list-group-item">'
					+(
						tempFileType == 'pdf'
						? '<i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;'
						: (
							tempFileType == 'url'
							? '<i class="fa fa-external-link"></i>&nbsp;&nbsp;'
							: (
								tempFileType == 'dir'
								? '<i class="fa fa-folder-o"></i>&nbsp;&nbsp;'
								: ""
							)
						)
					)
					+'<a target="_blank" href="'+tempFileUrl+'">'
					+tempFilename
					+'</a>'
					+'</li>'
				);
			}
		});
	});
}
