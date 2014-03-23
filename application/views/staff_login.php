<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/resources/style/admin_login.css"></link>
	<title>Login Page</title>
</head>
<body>

<div class="center_marker">
	<h1>Staff Login</h1>
	<?php
	echo form_open('staff/login_validation');
	
	echo validation_errors();
	
	echo "<p class=\"select_separate\">Email:  ";
	echo form_input('email', $this->input->post('email'));
	echo "</p>";
	
	echo "<p class=\"select_separate\">Passowrd:  ";
	echo form_password('password');
	echo "</p>";
	
	echo "<p class=\"select_separate\">";
	echo form_submit('login_submit', 'Login');
	echo "</p>";

	echo form_close();
	?>

</div>

</body>
</html>