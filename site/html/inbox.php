<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
		<link rel="stylesheet" type="text/css" href="bootstrap.css"/>
    </head>
<body>
    <h1 class="text-primary">Inbox</h1>
	<table class="table table-hover">
		<thead>
			<tr class="table-primary">
				<th>Sender</th>
				<th>Date</th>
				<th>Subject</th>
				<th colspan="3">Actions</th>				
			</tr>
		</thead>
		<tbody>
		<tr>
			<?php 			
				
				
				
				echo "<td>The table body</td>";
				echo "<td>with two columns</td>";
				echo "<td></td>";
				echo "<td><button name=\"read\" class=\"btn btn-primary\">Read</button></td>";
				echo "<td><button name=\"answer\" class=\"btn btn-info\">Answer</button></td>";	
				echo "<td><button name=\"delete\" class=\"btn btn-danger\">Delete</button></td>";	
					
			?>			
		</tr>			
		</tbody>
</table>	
</body>		
</html>