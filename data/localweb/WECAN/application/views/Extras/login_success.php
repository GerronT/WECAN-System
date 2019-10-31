<?php
session_start();
if(!session_is_registered(myusername)){
header("location:main_login.php");
}
?>

<html>
<body>
	
header("location:header.php");
header("location:home.php");
		$this->load->view('header');
		$this->load->view('home');
</body>
</html>
