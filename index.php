<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="frameworks/bootstrap-3.3.4-dist/css/bootstrap.min.css" />
		<link rel="stylesheet" href="frameworks/bootstrap-3.3.4-dist/css/bootstrap-theme.min.css" />
		<link rel="stylesheet" href="frameworks/font-awesome-4.3.0/css/font-awesome.min.css">
		<script src="frameworks/jquery-1.11.3.min.js"></script>
		<script src="ui-Homepage.logic.js"></script>
		<script src="frameworks/bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
		<script>
			var selectedId = parseInt(<?php echo $_GET['projectId']; ?>);
		</script>
		<style>
			.priorityListing {
				font-weight: bold;
			}
			body {
				background-image: url('frameworks/subtlepatterns.com/symphony/symphony.png');
				background-attachment: fixed;
				font-family: 'TeX Gyre Heros', 'Segoe UI', sans-serif;
				padding: 1px;
			}
			h3 {
				font-weight: bold;
			}
			#bodyWrapper {
				padding-left: 1vw;
				padding-right: 1vw;
			}
			#statusBar {
				padding: 0.5vw;
				text-align: center;
				margin-bottom: 1vw;
				border-radius: 0.5vw;
			}
			.statusBarLoading {
				background-color: rgb(200,255,0);
				color: rgba(0,0,0,0.5);
			}
			.statusBarDone {
				background-color: rgb(0,101,189);
				color: rgba(255,255,255,0.75);
			}
		</style>
		<title>PROJECT_NAME</title>
	</head>
	<body onload="bodyDidLoad()">
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Modal title</h4>
					</div>
					<div class="modal-body"> ... </div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary">Save changes</button>
					</div>
				</div>
			</div>
		</div>
		<nav class="navbar navbar-default">
			<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</button>
			<span class="navbar-brand">
				<strong>blairgtd</strong>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;<span id="navbarSubtitle"></span>
			</span>
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="javascript:
						$('#myModal').modal()
					">New task</a></li>
					<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Change project <span class="caret"></span></a>
					<ul class="dropdown-menu" role="menu" id="projectSelector">
						<li><a href="#">Create new project...</a></li>
						<li class="divider"></li>
					</ul>
					</li>
				</ul>
			</div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		</nav>
		<div id="bodyWrapper">
			<!-- <div id="statusBar" class="statusBarLoading"><i class="fa fa-circle-o-notch fa-spin"></i>&nbsp;&nbsp;loading ...</div> -->
			<div class="row">
				<div class="col-md-3">
					<div class="panel panel-danger">
						<div class="panel-heading">
							<h3 class="panel-title">
								<i class="fa fa-inbox"></i>&nbsp;
								Todo
							</h3>
						</div>
						<ul class="list-group" id="outputTasksTodo">
						</ul>
					</div>
				</div>
				<div class="col-md-3">
					<div class="panel panel-warning">
						<div class="panel-heading">
							<h3 class="panel-title">
								<i class="fa fa-play"></i>&nbsp;
								In Progress
							</h3>
						</div>
						<ul class="list-group" id="outputTasksInProgress">
						</ul>
					</div>
				</div>
				<div class="col-md-3">
					<div class="panel panel-success">
						<div class="panel-heading">
							<h3 class="panel-title">
								<i class="fa fa-check"></i>&nbsp;
								Done
							</h3>
						</div>
						<ul class="list-group" id="outputTasksDone">
						</ul>
					</div>
				</div>
				<div class="col-md-3">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">
								<i class="fa fa-folder"></i>&nbsp;
								Project Files
							</h3>
						</div>
						<ul class="list-group" id="outputFiles">
						</ul>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
