<!DOCTYPE html>
<html>
<head>
	<title>Users</title>
	<meta charset="utf-8">
	<meta name="keywords" content="Index,users,advertisements">
	<link rel="stylesheet" type="text/css" href="./css/style.css">
</head>
<body>
	<header>
		<h1>Users</h1>
	</header>
	<nav>
		<ul>
			<li><a href="index">Index</a></li>
		</ul>
	</nav>
	<main> 
	<?php 
	echo '<table>
				<tr>
					<th>Id</th>
					<th>Name</th>	
				</tr>';

	 	foreach($data as $row)
		{

			$id = $row[0];
			$name = $row[1];

			echo '<tr>
					<td>'.$id.'</td>
					<td>'.$name.'</td>
				</tr>';
		}

		echo '</table>'; 
	 ?> 
	</main> 
</body>
</html>