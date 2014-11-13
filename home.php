<html>
<head>
  <link rel="stylesheet" type="text/css" href="default.css">
  <title>Exotica Management</title>
  <h1>Exotica Management</h1>
</head>
<body>
  <?php
    session_start();
    if(!isset($_SESSION["user_type"]))
    {
  ?>
<ul>
  <li><a href="home.php">Home</a></li>
  <li><a href="register.php">Register</a></li>
  <li><a href="customerregistration.php">Customer Registration</a></li>
  <li><a href="login.php">Login</a></li>
  <li><a href="adminlogin.php">Admin Login</a></li>
</ul>
  <?php
    }
    else
    {
      echo "Welcome ".$_SESSION["first_name"]."!<br />";
      echo "User Type :".$_SESSION["user_type"]."<br />";
  ?>
  <form action="<?=$_localhost['PHP_SELF']?>" method="post" id="dashboard">
<input type="submit" name="dashboard" value="Dashboard" />
</form>
<form action="<?=$_localhost['PHP_SELF']?>" method="post" id="dashboard">
<input type="submit" name="logout" value="Logout" />
</form>  
  <?php
      if(isset($_POST["dashboard"]))
      {
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
      if(isset($_POST["logout"]))
      {
        header("Location: logout.php");
      }
    }
  ?>
</body>
</html>