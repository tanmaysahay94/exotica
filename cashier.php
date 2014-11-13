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
	</script>
	<title>Cashier Dashboard</title>
	Cashier Dashboard<br />
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
		$tablename="bills";
		$sql="SELECT * from $tablename";
		$result=$mysqli->query($sql);
		$numFields=mysqli_num_fields($result);
		echo "<table><th>ID</th><th>Order ID</th><th>Price</th><th>Cashier ID</th><th>Timestamp</th>";
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
	<button onclick="showAddForm()">Add New Bill</button>
	<button onclick="showDeleteForm()">Delete Bill</button><br />
	<form style="display:none" action="<?=$_localhost['PHP_SELF']?>" method="post" id="addform">
		Order ID:<input type="number" name="order_id" /><br />
		Price:<input type="number" name="price" /><br />
		<input type="submit" name="submit" value="Add Bill" />
	</form><br />
	<form style="display:none" action="<?=$_localhost['PHP_SELF']?>" method="post" id="deleteform">
		Order ID:<input type="number" name="order_id" /><br />
		<input type="submit" name="submit" value="Delete Bill" />
	</form><br />
	<?php
		if (isset($_POST['submit']))
		{
			$order_id=$_POST["order_id"];
			$price=$_POST["price"];
			$cashier_id=$_SESSION["employee_id"];
			$result=$mysqli->query("SELECT * from bills where order_id like {$order_id}");
			if($result->num_rows==0)
			{
				$result=$mysqli->query("insert into bills (id, order_id, price, cashier_id, time) VALUES (NULL, ".$order_id.", ".$price.", ".$cashier_id.", NULL)");
				header("Location: cashier.php");
			}
			else
			{
				$result=$mysqli->query("delete from bills where order_id like {$order_id}");
				header("Location: cashier.php");
			}
		}
	?>
</body>
</html>