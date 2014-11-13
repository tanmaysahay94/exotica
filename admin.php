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
	function showUpdateForm()
	{
		document.getElementById('updateform').style.display="inline";
	};
	</script>
	<title>Manager Dashboard</title>
	Manager Dashboard<br />
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
		$tablename="items";
		$sql="SELECT * from $tablename";
		$result=$mysqli->query($sql);
		$numFields=mysqli_num_fields($result);
		echo "<table><th>Price</th><th>Description</th><th>Item_ID</th>";
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
	<button onclick="showAddForm()">Add Item</button>
	<button onclick="showDeleteForm()">Delete Item</button>
	<button onclick="showUpdateForm()">Update Item</button><br />
	<form style="display:none" action="<?=$_localhost['PHP_SELF']?>" method="post" id="addform">
		Item ID:<input type="text" name="item_id" /><br />
		Price:<input type="number" name="price" /><br />
		Description:<input type="text" name="description" /><br />
		<input type="submit" name="add" value="Add This Item" />
	</form><br />
	<form style="display:none" action="<?=$_localhost['PHP_SELF']?>" method="post" id="deleteform">
		Item ID:<input type="text" name="item_id" /><br />
		<input type="submit" name="delete" value="Delete This Item" />
	</form><br />
	<form style="display:none" action="<?=$_localhost['PHP_SELF']?>" method="post" id="updateform">
		Old Item ID:<input type="text" name="old_item_id" /><br />
		New Item ID:<input type="text" name="item_id" /><br />
		Price:<input type="number" name="price" /><br />
		Description:<input type="text" name="description" /><br />
		<input type="submit" name="update" value="Add This Item" />
	</form><br />
	<?php
		$old_item_id=$_POST["old_item_id"];
		$new_item_id=$_POST["item_id"];
		$description=$_POST["description"];
		$price=$_POST["price"];
		if(isset($_POST["add"]))
		{
			$result=$mysqli->query("insert into items (price,description,item_id) VALUES ({$price},'".$description."','".$new_item_id."')");
			header("Location: admin.php");
		}
		if(isset($_POST["update"]))
		{
			$result=$mysqli->query("update items set price={$price},description='".$description."',item_id='".$new_item_id."' where item_id='".$old_item_id."'");
			header("Location: admin.php");
		}
		if(isset($_POST["delete"]))
		{
			$result=$mysqli->query("delete from items where item_id='".$new_item_id."'");
			header("Location: admin.php");
		}
	?>
</body>
</html>