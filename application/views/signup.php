<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Sign up Page</title>
</head>
<body>

<div id="container">
	<h1>Sign Up</h1>
	<?php
	echo form_open('main/signup_validation');
	
	echo validation_errors();
	
	echo "<p>Email: ";
	echo form_input('email', $this->input->post('email'));
	echo "</p>";
	
	echo "<p>Passowrd: ";
	echo form_password('password');
	echo "</p>";
	
	echo "<p>Confirm Passowrd: ";
	echo form_password('cpassword');
	echo "</p>";
	
	echo "<p>";
	echo form_submit('login_submit', 'Sign Up');
	echo "</p>";

	echo form_close();
	?>

	<a href = '<?php echo base_url(). "main/login"; ?>' >Login</a>

</div>

</body>
</html>