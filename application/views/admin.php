<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Members Page</title>
</head>
<body>

<div id="container">
	<h1>Welcome Admin</h1>

	<a href="<?php echo base_url()."admin/disasters"?>">Disasters</a>
	<a href="<?php echo base_url()."admin/staff"?>">Staff</a>
	<?php 
		/*
		echo "<pre>";
		foreach ($results->result() as $row)
		{
			echo $row->id;
			echo "    ";
			echo $row->state;
			echo "    ";
			echo $row->type;
			echo "    ";
			echo $row->date;
			echo "    ";
			echo $row->cities;
			echo "<br/>";
		}
		echo "</pre>";
		*/
	?>
	<a href = '<?php echo base_url(). "admin/logout" ?>'>Logout</a>
</div>

</body>
</html>