<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= $title; ?> - Validation App</title>
	<link href="<?= base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?= base_url();?>assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="<?= base_url();?>assets/css/datepicker3.css" rel="stylesheet">
	<link href="<?= base_url();?>assets/css/styles.css" rel="stylesheet">
	
	<!--Custom Font-->
	<!-- <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet"> -->
	<link href="https://fonts.googleapis.com/css?family=Karla&display=swap" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
	<style type="text/css">
		.pad-rl{
			padding: 15px;
		}
		.mb-3{
			margin-bottom: 10px;
		}
		.mt-3{
			margin-top: 25px;
		}
		.right{
			float: right;
		}
		.border{
			border: 0.5px solid lightblue;
		}
	</style>
</head>
<body>
	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span></button>
				<a class="navbar-brand" href="#"><span>Validation</span> App</a>
				<ul class="nav navbar-top-links navbar-right">
					<li class="dropdown"><a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
						<em class="fa fa-envelope"></em><span class="label label-danger">15</span>
					</a>
						<ul class="dropdown-menu dropdown-messages">
							<li>
								<div class="dropdown-messages-box"><a href="profile.html" class="pull-left">
									<img alt="image" class="img-circle" src="http://placehold.it/40/30a5ff/fff">
									</a>
									<div class="message-body"><small class="pull-right">3 mins ago</small>
										<a href="#"><strong>John Doe</strong> commented on <strong>your photo</strong>.</a>
									<br /><small class="text-muted">1:24 pm - 25/03/2015</small></div>
								</div>
							</li>
							<li class="divider"></li>
							<li>
								<div class="dropdown-messages-box"><a href="profile.html" class="pull-left">
									<img alt="image" class="img-circle" src="http://placehold.it/40/30a5ff/fff">
									</a>
									<div class="message-body"><small class="pull-right">1 hour ago</small>
										<a href="#">New message from <strong>Jane Doe</strong>.</a>
									<br /><small class="text-muted">12:27 pm - 25/03/2015</small></div>
								</div>
							</li>
							<li class="divider"></li>
							<li>
								<div class="all-button"><a href="#">
									<em class="fa fa-inbox"></em> <strong>All Messages</strong>
								</a></div>
							</li>
						</ul>
					</li>
					<li class="dropdown"><a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
						<em class="fa fa-bell"></em><span class="label label-info">5</span>
					</a>
						<ul class="dropdown-menu dropdown-alerts">
							<li><a href="#">
								<div><em class="fa fa-envelope"></em> 1 New Message
									<span class="pull-right text-muted small">3 mins ago</span></div>
							</a></li>
							<li class="divider"></li>
							<li><a href="#">
								<div><em class="fa fa-heart"></em> 12 New Likes
									<span class="pull-right text-muted small">4 mins ago</span></div>
							</a></li>
							<li class="divider"></li>
							<li><a href="#">
								<div><em class="fa fa-user"></em> 5 New Followers
									<span class="pull-right text-muted small">4 mins ago</span></div>
							</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div><!-- /.container-fluid -->
	</nav>
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<div class="profile-sidebar">
			<div class="profile-userpic">
				<img src="http://placehold.it/50/30a5ff/fff" class="img-responsive" alt="">
			</div>
			<div class="profile-usertitle">
				<div class="profile-usertitle-name"><?= $this->session->userdata('username');?></div>
				<div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="divider"></div>
		<!-- <form role="search">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Search">
			</div>
		</form> -->
		<ul class="nav menu">
			<li><a href="<?= base_url();?>"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
			<li><a href="<?= base_url();?>form"><em class="fa fa-wpforms">&nbsp;</em> Form Active</a></li>
			<li><a href="#"><em class="fa fa-sign-in">&nbsp;</em> Form Send</a></li>
			<li><a href="#"><em class="fa fa-window-close">&nbsp;</em> Form Rejected</a></li>
			<li><a href="#"><em class="fa fa-clone">&nbsp;</em> Alerts &amp; Panels</a></li>
			<!-- <li class="parent "><a data-toggle="collapse" href="#sub-item-1">
				<em class="fa fa-navicon">&nbsp;</em> Multilevel <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-1">
					<li><a class="" href="#">
						<span class="fa fa-arrow-right">&nbsp;</span> Sub Item 1
					</a></li>
					<li><a class="" href="#">
						<span class="fa fa-arrow-right">&nbsp;</span> Sub Item 2
					</a></li>
					<li><a class="" href="#">
						<span class="fa fa-arrow-right">&nbsp;</span> Sub Item 3
					</a></li>
				</ul>
			</li> -->
			<li><a href="<?= base_url();?>login/logout" style="color:red"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
		</ul>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active"><?= $title;?></li>
			</ol>
		</div><!--/.row-->
			<br>
		<!-- <div class="row">
			<div class="col-lg-12">
				<h1 class="page-header"><?= $title;?></h1>
			</div>
		</div> --><!--/.row-->
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 mt-5">
				<?php
					$this->load->view($main_view);
				?>
			</div>
		</div>
		
		
		
			<div class="col-sm-12">
				<p class="back-link">Victory International Future &copy; 2019</p>
			</div>
		</div><!--/.row-->
	</div>	<!--/.main-->
	
<!--===============================================================================================-->	
	<script src="<?= base_url();?>assets/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url();?>assets/vendor/bootstrap/js/popper.js"></script>
	<script src="<?= base_url();?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url();?>assets/js/chart.min.js"></script>
	<script src="<?= base_url();?>assets/js/chart-data.js"></script>
	<script src="<?= base_url();?>assets/js/easypiechart.js"></script>
	<script src="<?= base_url();?>assets/js/easypiechart-data.js"></script>
	<script src="<?= base_url();?>assets/js/bootstrap-datepicker.js"></script>
	<script src="<?= base_url();?>assets/js/custom.js"></script>
	<script src="<?= base_url();?>assets/js/sweetalert/sweetalert2@7.js"></script>
	<script>
		window.onload = function () {
			var chart1 = document.getElementById("line-chart").getContext("2d");
			window.myLine = new Chart(chart1).Line(lineChartData, {
			responsive: true,
			scaleLineColor: "rgba(0,0,0,.2)",
			scaleGridLineColor: "rgba(0,0,0,.05)",
			scaleFontColor: "#c5c7cc"
			});
		};

		function logout() {
			swal({
			    title: "Are you sure?",
			    text: "You will not be able to recover this imaginary file!",
			    type: "warning",
			    showCancelButton: true,
			    confirmButtonColor: "#DD6B55",
			    confirmButtonText: "Yes, delete it!",
			    cancelButtonText: "No, cancel plx!",
			    closeOnConfirm: false,
			    closeOnCancel: false
			  },
			    function (isConfirm) {
			      if (isConfirm) {
			        $.ajax({
			          type: "POST",
			          url: "<?= base_url();?>login/logout",
			          data: data,
			          success: function (data) {
			            swal("Logout!", "Your imaginary file has been deleted.", "success");
			          },
			          error: function (data) {
			            swal("NOT Deleted!", "Something blew up.", "error");
			          }
			        });
			      } else {
			        
			      }
			    });

			  return false;
		}
	</script>
		
</body>
</html>