<!DOCTYPE html>
<html>
<head>
	<title>Test</title>
</head>
<body>
	<?php
		echo $this->session->userdata('id')."</br>";
		echo $this->session->userdata('token')."</br>";
		echo $this->session->userdata('exp');
	?>
</body>
</html>