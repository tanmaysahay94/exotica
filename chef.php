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
	<title>Chef Dashboard</title>
	Chef Dashboard
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
	<button onclick="showDeliverForm()">Request Items</button>
	<button onclick="showAddForm()">Request New Item</button>
	<form style="display:none" action="<?=$_localhost['PHP_SELF']?>" method="post" id="deliverform">
		ID:<input type="number" name="id" /><br />
		<input type="submit" name="submit" value="Request this Ingredient" />
	</form>
	<form style="display:none" action="<?=$_localhost['PHP_SELF']?>" method="post" id="addform">
		Item Name:<input type="text" name="name" /><br />
		<input type="submit" name="submit" value="Request this new Ingredient" />
	</form>
	<?php
		if (isset($_POST['submit']))
		{
			$item_id=$_POST["id"];
			$name=$_POST["name"];
			if($item_id)
			{
				$result=$mysqli->query("update inventory set supply_requested='YES' where item_id={$item_id}");
				header("Location: chef.php");
			}
			if($name)
			{
				$result=$mysqli->query("insert into inventory (item_id, quantity, item_name, supply_requested) VALUES (NULL, 0, '".$name."','YES')");
				header("Location: chef.php");
			}
		}
	?>
</body>
</html>
