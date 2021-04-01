<?php require_once('./model/database.php');  ?>

<!DOCTYPE html>
<html>
<head>
	<title>Advertisements</title>
	<meta charset="utf-8">
	<meta name="keywords" content="Index,users,advertisements">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<header>
		<h1>Advertisements</h1>
	</header>
	<nav>
		<ul>
			<li><a href="index">Index</a></li>
		</ul>
	</nav>
	<main> 
		<?php echo '<table>
					<tr>
						<th>Id</th>
						<th>Title</th>
						<th>User Name</th>	
					</tr>';
			
		 		foreach($data as $element)
		 		{
		 			$id = $element['id'];
					$title = $element['title'];
					$name = $element['name'];
					echo '<tr>
					<td>'.$id.'</td>
					<td>'.$title.'</td>
					<td>'.$name.'</td>';
		 		}
					
			echo '</tr>';
			echo '</table>';

			
			
		?> 
	</main>
</body>
</html>