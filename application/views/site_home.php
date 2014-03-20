<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/resources/style/site_home.css">
		<title>Disaster Management System</title>
	</head>
	<body>
		<div class="center_marker">
			<h1>Missing people report</h1>
			<div id="select_center">
				Select State: <select class="select_separate" onchange="">
					<option value="1">All</option>
					<option value="1">Gujarat</option>
					<option value="2">Rajesthan</option>
					<option value="3">Madhya Pradesh</option>
					<option value="4">Kerela</option>
					<option value="5">Tamil Nadu</option>
					<option value="6">Assam</option>
				</select>
				Select Disaster Type: <select class="select_separate" onchange="">
					<option value="1">All</option>
					<option value="1">Earthquack</option>
					<option value="2">Fire</option>
					<option value="3">Volcanic Euption</option>
					<option value="4">Floods</option>
					<option value="5">Cyclone</option>
					<option value="6">Tsunami</option>
				</select>
			</div>
			<div id="content">
				
			</div>
		</div>
		<div id="footer">
			<p>
				<a href="<?php echo base_url(); ?>admin">Admin Login</a>
				<?php echo base_url(); ?>
				<a href="<?php echo base_url(); ?>staff">Staff Login</a>
			</p>
			c2014
		</div>
	</body>
</html>