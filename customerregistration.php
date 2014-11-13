<html>
<head>
	<link rel="stylesheet" type="text/css" href="default.css">
<title>Customer Registration</title>
</head>
<body>
<ul>
  <li><a href="home.php">Home</a></li>
  <li><a href="login.php">Login</a></li>
</ul>
<h1>Customer Registration</h1>
<?php
require_once("db_const.php");
if (!isset($_POST['submit'])) {
?>	<!-- The HTML registration form -->
<form action="<?=$_localhost['PHP_SELF']?>" method="post" id="regform">
Name: <input type="text" name="name" /><br />
Contact No: <input type="number" name="contact_no" /><br />
Address: <input type="textarea" name="address" /><br />
 
<input type="submit" name="submit" value="Register" />
</form>
<?php
} else {
## connect mysql server
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
# check connection
if ($mysqli->connect_errno) {
echo "<p>MySQL error no {$mysqli->connect_errno} : {$mysqli->connect_error}</p>";
exit();
}
## query database
# prepare data for insertion
$name=$_POST["name"];
$contact_no=$_POST["contact_no"];
$address=$_POST["address"];
 
$exists = 0;
$result = $mysqli->query("SELECT * from customers WHERE contact_no = '{$contact_no}' LIMIT 1");
if ($result->num_rows == 1) {
$exists = 1;	
}
 
if ($exists == 1) echo "<p>Customer already exists!</p>";
else {
# insert data into mysql database
$sql = "insert into customers (id, name, contact_no, address) VALUES (NULL, '".$name."', '".$contact_no."', '".$address."')";
 //echo $sql;
if ($mysqli->query($sql)) {
echo "Customer ID :".$mysqli->insert_id;
echo "<p>Registered successfully!</p>";
} else {
echo "<p>MySQL error no {$mysqli->errno} : {$mysqli->error}</p>";
exit();
}
}
}
?>	
</body>
</html>