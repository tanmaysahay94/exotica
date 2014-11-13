<html>
<head>
	<link rel="stylesheet" type="text/css" href="default.css">
<title>Employee Registration</title>
</head>
<body>
<ul>
  <li><a href="home.php">Home</a></li>
  <li><a href="login.php">Login</a></li>
</ul>
<h1>Employee Registration</h1>
<?php
require_once("db_const.php");
if (!isset($_POST['submit'])) {
?>	<!-- The HTML registration form -->
<form action="<?=$_localhost['PHP_SELF']?>" method="post" id="regform">
Username: <input type="text" name="username" /><br />
Password: <input type="password" name="password" /><br />
First name: <input type="text" name="first_name" /><br />
Last name: <input type="text" name="last_name" /><br />
User Type: <select name="user_type" form="regform">
  <option value="Cashier">Cashier</option>
  <option value="Chef">Chef</option>
  <option value="Deliveryman">Deliveryman</option>
  <option value="Kitchen_Staff">Kitchen Staff</option>
  <option value="Supply_Staff">Supply Staff</option>
  <option value="Waiter">Waiter</option>
</select>
 
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
$username	= $_POST['username'];
$password	= $_POST['password'];
$first_name	= $_POST['first_name'];
$last_name	= $_POST['last_name'];
$user_type = $_POST['user_type'];
 
$exists = 0;
$result = $mysqli->query("SELECT username from employees WHERE username = '{$username}' LIMIT 1");
if ($result->num_rows == 1) {
$exists = 1;	
}
 
if ($exists == 1) echo "<p>Username already exists!</p>";
else {
# insert data into mysql database
$sql = "INSERT  INTO `employees` (`id`, `username`, `password`, `first_name`, `last_name`, `user_type`)
VALUES (NULL, '{$username}', '{$password}', '{$first_name}', '{$last_name}', '{$user_type}')";
 
if ($mysqli->query($sql)) {
//echo "New Record has id ".$mysqli->insert_id;
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
