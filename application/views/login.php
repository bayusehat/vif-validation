<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Victory Internation Future</title>
	<link href="<?= base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?= base_url();?>assets/css/datepicker3.css" rel="stylesheet">
	<link href="<?= base_url();?>assets/css/styles.css" rel="stylesheet">
	<script src="<?= base_url();?>assets/js/jquery-1.11.1.min.js"></script>
	<script src="<?= base_url();?>assets/js/sweetalert/sweetalert2@7.js"></script>
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<center><img src="<?= base_url();?>assets/images/vif.png" class="img-responsive"></center>
				
				<div class="panel-body">
					<form role="form" method="post">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="E-mail" name="email" id="email" autofocus="" type="email">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="password" id="password" type="password">
							</div>
							<div class="checkbox">
								<label>
									<input name="remember" type="checkbox" value="Remember Me">Remember Me
								</label>
							</div>
							<div class="form-group">
								<button type="submit" id="btnLogin" class="btn btn-primary btn-block"> Login</button>
							</div>
						</fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
	

<script src="<?= base_url();?>assets/js/jquery-1.11.1.min.js"></script>
<script src="<?= base_url();?>assets/js/bootstrap.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.all.min.js"></script> -->
<!-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.css"> -->
</body>
</html>
<!--===============================================================================================-->
	<script type="text/javascript">

		function swal_success(msg) {
			swal({
		        title: "Success",
		        text: msg,
		        timer: 2500,
		        showConfirmButton: false,
		        type: 'success'
		    });
		}

		function swal_failed(msg) {
			swal({
		        title: "Failed",
		        text: msg,
		        timer: 2500,
		        showConfirmButton: false,
		        type: 'error'
		    });
		}

		$("#btnLogin").click(function(event){
			event.preventDefault();
			var email  = $("#email").val();
			var password  = $("#password").val();
			var url = "<?php echo base_url('login');?>";
			
			if(checkEmail(email) == false){
				swal_failed('Email format is invalid');
				$("#email").focus();
			}else{
				$.ajax({
					type : "POST",
					url : "<?php echo base_url('login/login_user');?>",
					dataType : "json",
					data : {
						email : email,
						password : password
					},
					success:function(data){
						if(data.valid == true){
							swal_success(data.msg);
							setTimeout(function(){
								window.location = url;
							},1000);
						}else{
							swal_failed(data.msg);
							$('form').trigger('reset');
							$("#username").focus();
						}
					},
					error:function(data){
						swal_failed(data.msg);
						$('form').trigger('reset');
						$("#username").focus();
					}
				});
			}
				
			});

		function checkEmail(email) {
			var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			  if(!regex.test(email)) {
			    return false;
			  }else{
			    return true;
  			}
		}
	</script>

</body>
</html>