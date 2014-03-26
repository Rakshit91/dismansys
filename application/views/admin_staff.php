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
		echo validation_errors();
		echo "<table>";
		echo "<tr>";
		//echo "<td>".""."</td>";
		//echo "<td>"."id"."</td>";
		echo "<td>"."name"."</td>";
		echo "<td>"."email"."</td>";
		echo "</tr>";
		foreach ($results->result() as $row)
		{
			echo "<tr>";
			//echo "<td>".$row->id."</td>";
			echo "<td>".$row->name."</td>";
			echo "<td>".$row->email."</td>";
			//echo "<td>"."edit"."</td>";
			echo "</tr>";
		}

		echo "<tr>";
		echo form_open('admin/add_staff_validation');
		
		//echo "<td>";
		//echo form_submit('login_submit', 'Submit');
		//echo "</td>";

		//echo "<td>Email: ";
		echo "<td>";
		echo form_input('name', $this->input->post('name'));
		echo "</td>";
		
		//echo "<td>Type: ";
		echo "<td>";
		echo form_input('email', $this->input->post('email'));
		echo "</td>";
		
		echo "<td>";
		echo form_submit('login_submit', 'Add');
		echo "</td>";

		echo form_close();
		echo "</tr>";
		echo "</table>";
		echo $this->session->flashdata('msg');
	?>
	<a href = '<?php echo base_url(). "admin/logout" ?>'>Logout</a>
</div>

</body>
</html>