<!DOCTYPE html>
<html>
<head>
	<title>Test</title>
</head>
<body>
	<?php
		echo $this->session->userdata('login')."</br>";
		echo $this->session->userdata('token')."</br>";
		echo $this->session->userdata('username');
		echo 'Berhasil';
	?>

	<a href="<?= base_url('index.php/login/logout');?>">Logout</a>
</body>
</html>