<html>
<head>
<title>Logout</title>
</head>
<body>
<h1>Employee Logout</h1>
<?php
session_start();
session_unset();
session_destroy();
echo "Logged out successfully. <a href='login.php'>Click here</a> to login again";
?>	
</body>
</html>