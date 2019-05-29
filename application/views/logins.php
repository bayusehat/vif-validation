<!DOCTYPE html>
<html lang="en">
<head>
	<title>Validation App - Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">	
	<link rel="icon" type="image/png" href="<?= base_url();?>assets/images/icon.png"/>
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/login/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/login/vendor/animate/animate.css">	
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/login/vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/login/vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/login/vendor/select2/select2.min.css">	
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/login/vendor/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/login/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/login/css/main.css">
	<script src="<?= base_url();?>assets/js/sweetalert/sweetalert2@7.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Karla&display=swap" rel="stylesheet">
	<style type="text/css">
		*{
		  font-family: "Karla","Montserrat", "Helvetica Neue", Helvetica, Arial, sans-serif; 
		}
	</style>
</head>
<body style="background-color: #666666;">
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form">
					<div class="form-group">
						<center><img src="<?= base_url();?>assets/images/vif.png"></center>
					</div>
					<div class="form-group">
						<label>Email</label>
						<input class="form-control" type="text" name="email" id="email" placeholder="E-mail">
					</div>
					
					<div class="form-group">
						<label>Password</label>
						<input class="form-control" type="password" name="password" id="password" placeholder="******">
					</div>
					<div class="form-group">
						<div class="container-login100-form-btn">
							<button class="btn btn-primary btn-block" type="submit" id="btnLogin">
								Login
							</button>
						</div>
					</div>
					<div class="form-group">
						<div class="login100-form-social flex-c-m">
							<a href="#" class="login100-form-social-item flex-c-m bg1 m-r-5">
								<i class="fa fa-facebook-f" aria-hidden="true"></i>
							</a>

							<a href="#" class="login100-form-social-item flex-c-m bg2 m-r-5">
								<i class="fa fa-twitter" aria-hidden="true"></i>
							</a>
						</div>
					</div>
				</form>
				<div class="login100-more" style="background-image: url('<?php base_url();?>assets/login/images/bg-02.jpg');">
				</div>
			</div>
		</div>
	</div>
	
	

	
	
	<script src="<?= base_url();?>assets/login/vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="<?= base_url();?>assets/login/vendor/animsition/js/animsition.min.js"></script>
	<script src="<?= base_url();?>assets/login/vendor/bootstrap/js/popper.js"></script>
	<script src="<?= base_url();?>assets/login/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?= base_url();?>assets/login/vendor/select2/select2.min.js"></script>
	<script src="<?= base_url();?>assets/login/vendor/daterangepicker/moment.min.js"></script>
	<script src="<?= base_url();?>assets/login/vendor/daterangepicker/daterangepicker.js"></script>
	<script src="<?= base_url();?>assets/login/vendor/countdowntime/countdowntime.js"></script>
	<script src="<?= base_url();?>assets/login/js/main.js"></script>
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
							$("#email").focus();
						}
					},
					error:function(data){
						swal_failed(data.msg);
						$('form').trigger('reset');
						$("#email").focus();
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