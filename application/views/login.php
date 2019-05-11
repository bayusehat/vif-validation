<!DOCTYPE html>
<html lang="en">
<head>
	<title>Vif Validation Test Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link rel="icon" type="image/png" href="<?= base_url();?>assets/images/vif.png"/>

	<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/vendor/bootstrap/css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/vendor/animate/animate.css">
	
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/vendor/css-hamburgers/hamburgers.min.css">

	<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/vendor/select2/select2.min.css">

	<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/css/main.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.all.min.js"></script>

</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="<?= base_url();?>assets/images/vif.png" alt="IMG" style="width:300px;padding-top: 40px">
				</div>

				<form class="login100-form validate-form" method="post" id="loginForm">
					<span class="login100-form-title">
						Validation App Login
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="text" name="email" id="email" placeholder="Your username">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="password" id="password" placeholder="Your password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<!-- <input type="submit" name="submit" value="submit" class="login100-form-btn"> -->
						<button class="login100-form-btn" id="btnLogin">
							Login
						</button>
					</div>

					<!-- <div class="text-center p-t-12">
						<span class="txt1">
							Forgot
						</span>
						<a class="txt2" href="#">
							Username / Password?
						</a>
					</div> -->

					<div class="text-center p-t-136">
						<a class="txt2" href="#">
							2019 &copy; Victory International Future
							<!-- <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i> -->
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="<?= base_url();?>assets/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url();?>assets/vendor/bootstrap/js/popper.js"></script>
	<script src="<?= base_url();?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url();?>assets/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="<?= base_url();?>assets/vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
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
			});
	</script>

</body>
</html>