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
		echo "<td>"."state"."</td>";
		echo "<td>"."type"."</td>";
		echo "<td>"."date"."</td>";
		echo "<td>"."cities"."</td>";
		echo "</tr>";
		foreach ($results->result() as $row)
		{
			echo "<tr>";
			//echo "<td>".$row->id."</td>";
			echo "<td>".$row->state."</td>";
			echo "<td>".$row->type."</td>";
			echo "<td>".$row->date."</td>";
			echo "<td>".$row->cities."</td>";
			//echo "<td>"."edit"."</td>";
			echo "</tr>";
		}

		echo "<tr>";
		echo form_open('admin/add_disaster');
		
		//echo "<td>";
		//echo form_submit('login_submit', 'Submit');
		//echo "</td>";

		//echo "<td>Email: ";
		echo "<td>";
		echo form_input('state', $this->input->post('state'));
		echo "</td>";
		
		//echo "<td>Type: ";
		echo "<td>";
		echo form_input('type', $this->input->post('type'));
		echo "</td>";
		
		//echo "<td>Date(YYYY-MM-DD): ";
		echo "<td>";
		echo form_input('date', $this->input->post('date'));
		echo "</td>";
		
		//echo "<td>city: ";
		echo "<td>";
		echo form_input('city', $this->input->post('city'));
		echo "</td>";

		echo "<td>";
		echo form_submit('login_submit', 'Add');
		echo "</td>";


		echo form_close();
		echo "</tr>";
		echo "</table>";
	?>
	<a href = '<?php echo base_url(). "admin/logout" ?>'>Logout</a>
</div>

</body>
</html>