<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Members Page</title>
</head>
<body>

<div id="container">
	<h1>Welcome <?php echo $this->session->userdata('name'); ?></h1>
	<?php
		echo "<pre>";
		foreach ($results->result() as $row)
		{
			echo $row->id;
			echo "    ";
			echo $row->state;
			echo "    ";
			echo $row->date;
			echo "    ";
			echo $row->type;
			echo "    ";
			echo $row->cities;
			echo "<br/>";
		}
		echo "</pre>";
	?>
	<a href = '<?php echo base_url(). "staff/logout" ?>'>Logout</a>
</div>

</body>
</html>