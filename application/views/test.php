<!DOCTYPE html>
<html>
<head>
	<title>Test</title>
</head>
<body>
	<?php
		echo $this->session->userdata('login')."</br>";
		echo $this->session->userdata('token')."</br>";
		echo $this->session->userdata('email');
		echo 'Berhasil';
		$exp = $this->session->userdata('exp');

		echo date('Y-m-d H:i:s',$exp);
	?>

	<a href="<?= base_url('index.php/login/logout');?>">Logout</a>
</body>
</html>