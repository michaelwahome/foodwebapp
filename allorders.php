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
        <h1 class ="title">View all customer orders</h1>
        
        <?php

            $sql = "SELECT * FROM orders";
            $result = $conn->query($sql);
            if($result->num_rows>0){
                echo "<table class='table'><tr><th>Order ID</th><th>Username</th><th>Total</th><th>Order Details</th><th>User Details</th></tr>";
                while($row= $result->fetch_assoc()){ 
                    echo "<form action='details.php' method='post'><tr>
                        <td style='padding-left: 1em;'>" . $row["orderID"] . "</td>
                        <td>" . $row["username"] . "</td>
                        <td>" . $row["total"] . "</td>
                        <td>
                            <button name='orderdetails' value=".$row["orderID"].">
                                View order details
                            </button>
                        </td>
                        <td>
                            <button name='userdetails' value=".$row["username"].">
                                View user details
                            </button>
                        </td>
                    </tr></form>"; 
                } 
                echo "</table>";
            }else {
            echo "0 results<br>";
            }
        ?>
        <a href="admindashboard.php"><button class="cta return-to-menu-btn">Return to main menu</button></a>
    </div>
</body>
</html>



