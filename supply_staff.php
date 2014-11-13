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
	function showDeliverForm()
	{
		document.getElementById('deliverform').style.display="inline";
	};
	</script>
	<title>Supply Staff Dashboard</title>
	Supply Staff Dashboard<br />
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
		$tablename="inventory";
		$sql="SELECT * from $tablename";
		$result=$mysqli->query($sql);
		$numFields=mysqli_num_fields($result);
		echo "<table><th>Item ID</th><th>Quantity</th><th>Item Name</th><th>Supply Requested</th>";
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
	<button onclick="showDeliverForm()">Supply Items</button>
	<button onclick="showAddForm()">Add New Item</button><br />
	<form style="display:none" action="<?=$_localhost['PHP_SELF']?>" method="post" id="deliverform">
		ID:<input type="number" name="id" /><br />
		Quantity:<input type="number" name="quantity" /><br />
		<input type="submit" name="submit" value="Supply this Ingredient" />
	</form><br />
	<form style="display:none" action="<?=$_localhost['PHP_SELF']?>" method="post" id="addform">
		Item Name:<input type="text" name="name" /><br />
		Quantity:<input type="number" name="quantity" /><br />
		<input type="submit" name="submit" value="Add this Ingredient" />
	</form><br />
	<?php
		if (isset($_POST['submit']))
		{
			$item_id=$_POST["id"];
			$quantity=$_POST["quantity"];
			$name=$_POST["name"];
			if($item_id)
			{
				$result=$mysqli->query("update inventory set quantity=quantity+".$quantity.",supply_requested='NO' where item_id={$item_id}");
				header("Location: supply_staff.php");
			}
			if($name)
			{
				$result=$mysqli->query("insert into inventory (item_id, quantity, item_name, supply_requested) VALUES (NULL, {$quantity}, '".$name."','NO')");
				header("Location: supply_staff.php");
			}
		}
	?>
</body>
</html>