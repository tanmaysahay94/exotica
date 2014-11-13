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
	function showDeleteForm()
	{
		document.getElementById('deleteform').style.display="inline";
	};
	function showDeliverForm()
	{
		document.getElementById('deliverform').style.display="inline";
	};
	</script>
	<title>Waiter Dashboard</title>
	Waiter Dashboard<br />
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
		echo "<table><th>ID</th><th>Item_ID</th><th>Waiter_ID</th><th>Cook_ID</th><th>Prepared</th><th>Delivered</th>";
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
	<button onclick="showAddForm()">Take New Order</button>
	<button onclick="showDeleteForm()">Cancel Order</button>
	<button onclick="showDeliverForm()">Deliver Order</button><br />
	<form style="display:none" action="<?=$_localhost['PHP_SELF']?>" method="post" id="addform">
		Item ID :<input type="text" name="items" /><br />
		<input type="submit" name="submit" value="Confirm This Order" />
	</form><br />
	<form style="display:none" action="<?=$_localhost['PHP_SELF']?>" method="post" id="deleteform">
		ID:<input type="number" name="id" /><br />
		<input type="submit" name="submit" value="Cancel This Order" />
	</form><br />
	<form style="display:none" action="<?=$_localhost['PHP_SELF']?>" method="post" id="deliverform">
		ID:<input type="number" name="id" /><br />
		<input type="submit" name="deliver" value="Deliver This Order" />
	</form><br />
	<?php
		if (isset($_POST['submit']))
		{
			$deliver=$_POST["deliver"];
			$id=$_POST["id"];
			$items=$_POST["items"];
			$waiter_id=$_SESSION["employee_id"];
			$cook_id="8"; //Placeholder
			if(!$id)
			{
				$result=$mysqli->query("insert into orders (id, items, waiter_id, cook_id, prepared, delivered) VALUES (NULL,'".$items."',".$waiter_id.",".$cook_id.",'NO','NO')");
				header("Location: waiter.php");
			}
			else
			{
				$result=$mysqli->query("delete from orders where id like {$id}");
				header("Location: waiter.php");
			}
		}
		if (isset($_POST['deliver']))
		{
			$deliver=$_POST["deliver"];
			$id=$_POST["id"];
			$items=$_POST["items"];
			$waiter_id=$_SESSION["employee_id"];
			$cook_id="1"; //Placeholder
			$result=$mysqli->query("update orders set delivered='YES' where id={$id}");
			header("Location: waiter.php");
		}
	?>
</body>
</html>