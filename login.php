<html>
<head>
  <link rel="stylesheet" type="text/css" href="default.css">
<title>Employee Login</title>
</head>
<body>
  <ul>
  <li><a href="home.php">Home</a></li>
  <li><a href="register.php">Register</a></li>
</ul>
<h1>Employee Login</h1>
<?php
if (!isset($_POST['submit'])){
?>
<!-- The HTML login form -->
<form action="<?=$_login['PHP_SELF']?>" method="post">
Username: <input type="text" name="username" /><br />
Password: <input type="password" name="password" /><br />
 
<input type="submit" name="submit" value="Login" />
</form>
<?php
} else {
require_once("db_const.php");
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
# check connection
if ($mysqli->connect_errno) {
echo "<p>MySQL error no {$mysqli->connect_errno} : {$mysqli->connect_error}</p>";
exit();
}
 
$username = $_POST['username'];
$password = $_POST['password'];
 
$sql = "SELECT * from employees WHERE username LIKE '{$username}' AND password LIKE '{$password}' LIMIT 1";
$result = $mysqli->query($sql);
if (!$result->num_rows == 1) {
echo "<p>Invalid username/password combination</p>";
} else {
echo "<p>Logged in successfully</p>";
$row = $result->fetch_assoc();
//echo "User Type: ".$row["user_type"];
session_start();
$_SESSION["username"] = $username;
$_SESSION["user_type"] = $row["user_type"];
$_SESSION["first_name"] = $row["first_name"];
$_SESSION["last_name"] = $row["last_name"];
$_SESSION["employee_id"] = $row["id"];
switch ($_SESSION["user_type"]) {
  case "Cashier":
    header("Location: cashier.php");
    break;
  case "Chef":
    header("Location: chef.php");
    break;
  case "Deliveryman":
    header("Location: deliveryman.php");
    break;
  case "Kitchen_Staff":
    header("Location: kitchen_staff.php");
    break;
  case "Supply_Staff":
    header("Location: supply_staff.php");
    break;
  case "Waiter":
    header("Location: waiter.php");
    break;
  default:
    echo "Invalid User Type";
}
}
}
?>	
</body>
</html>
