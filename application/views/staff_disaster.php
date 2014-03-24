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
		echo $this->session->userdata('disaster_id');
		echo "<br/>Select Resource Category<br/>";
		echo "<table>";
		echo form_open('staff/select_resource_category');
		echo "<tr>";
		echo "<td>".""."</td>";
		//echo "<td>"."id"."</td>";
		echo "<td>".""."</td>";
		echo "</tr>";
		foreach ($results->result() as $row)
		{
			echo "<tr>";
			//echo "<td>".$row->id."</td>";
			//<input type="checkbox" name="newsletter" id="newsletter" value="accept" checked="checked" style="margin:10px" />
			//echo "<td>".form_radio($row->id."", $row->id."", 'accept', false)."<td>";
			$cb = array(
			    'name'        => 'resource_category_id',
			    'id'          => 'resource_category_id',
			    'value'       => $row->id,
			    'checked'     => TRUE,
			    //'style'       => 'margin:10px',
		    );

			echo "<td>".form_radio($cb)."</td>";
		
			//echo "<td>".$row->state."</td>";
			//echo "<td>".$row->type."</td>";
			//echo "<td>".$row->date."</td>";
			echo "<td>".$row->type."</td>";
			//echo "<td>"."edit"."</td>";
			echo "</tr>";
		}
		echo "<tr><td>".form_submit('select_submit', 'Select')."</td></tr>";
		echo form_close();
		echo "</table>";
		
	?>
	<a href = '<?php echo base_url(). "staff/logout" ?>'>Logout</a>
</div>

</body>
</html>