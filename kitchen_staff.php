<html>
<head>
	<link rel="stylesheet" type="text/css" href="default.css">
<ul>
  <li><a href="home.php">Home</a></li>
  <li><a href="logout.php">Logout</a></li>
</ul>
	<script>
	function showAddForm()
	{
		document.getElementById('addform').style.display="inline";
	};
	</script>
	<title>Kitchen Staff Dashboard</title>
	Kitchen Staff Dashboard<br />
</head>
<body>
	<?php
		session_start();
		echo "Welcome ".$_SESSION["first_name"]."!<br />";
		require_once("db_const.php");
		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		if ($mysqli->connect_errno) {
		echo "<p>MySQL error no {$mysqli->connect_errno} : {$mysqli->connect_error}</p>";
		exit();
		}
		$tablename="orders";
		$sql="SELECT * from $tablename";
		$result=$mysqli->query($sql);
		$numFields=mysqli_num_fields($result);
		echo "<table><th>ID</th><th>Items</th><th>Waiter ID</th><th>Cook ID</th><th>Prepared</th><th>Delivered</th>";
		while ($row=mysqli_fetch_row($result))
		{
			echo "<tr>";
			for($x=0;$x<$numFields;$x++)
			{
				echo "<td>".$row[$x]."</td>";
			}
			echo "</tr>";
		}
		echo "</table><br />";
	?>
	<button onclick="showAddForm()">Prepare Order</button><br />
	<form style="display:none" action="<?=$_localhost['PHP_SELF']?>" method="post" id="addform">
		ID :<input type="number" name="id" /><br />
		<input type="submit" name="submit" value="Prepare This Order" />
	</form><br />
	<?php
		if (isset($_POST['submit']))
		{
			$id=$_POST["id"];
			$cook_id=$_SESSION["employee_id"];
			if($id)
			{
				$result=$mysqli->query("update orders set prepared='YES',cook_id={$cook_id} where id={$id}");
				header("Location: kitchen_staff.php");
			}
		}
	?>
</body>
</html>