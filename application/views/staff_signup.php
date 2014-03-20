<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/resources/style/admin_login.css"></link>
	<title>Sign up Page</title>
</head>
<body>

<divclass="center_marker">
	<h1>Sign Up</h1>
	<?php
	echo form_open('admin/signup_validation');
	
	echo validation_errors();
	
	echo "<p class=\"select_separate\">Email: ";
	echo form_input('email', $this->input->post('email'));
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