<?php session_start(); require_once("connect.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Web App</title>
    <link rel="stylesheet" href="css/admin.css?v=<?php echo time(); ?>">
    <link rel="icon" href="images/favicon.svg">
</head>
<body>
    <?php createNav(); ?>

    <div class="container">
        <h1>Welcome <?php echo $_SESSION["username"]; ?></h1>
        <h1>Main Menu</h1>
        <div class="cta-container">
            <a href="allorders.php"><button class="cta">View orders</button></a>
            <a href="useraccounts.php"><button class="cta">View user accounts</button></a>
            <a href="uploadimage.php"><button class="cta">Add menu items</button></a>
            <a href="adminaccounts.php"><button class="cta">View admin accounts</button></a>
            <a href="viewimage.php"><button class="cta">View menu items</button></a>
            <?php if($_SESSION["priority"] == "super"){ ?>
                <a href="adminregister.php"><button class="cta">Register an admin</button></a>
            <?php } ?>
        </div>
        
    </div>
</body>
</html>