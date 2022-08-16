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
        
        <?php

            if(isset($_POST["orderdetails"])){
                echo "<h1 class ='title'>View the order details</h1>";
                $orderID = $_POST["orderdetails"];             
            
                $sql = "SELECT order_item.*, orders.*, food.* FROM order_item 
                INNER JOIN food ON order_item.foodID = food.foodID
                INNER JOIN orders ON order_item.orderID = orders.orderID
                WHERE order_item.orderID = '".$orderID."'
                ";
                $result = $conn->query($sql);
                if($result->num_rows > 0){
                    echo "<table class='table'><tr><th></th><th>Food Name</th><th>Food Image</th><th>Price</th><th>Quantity</th><th>Cost</th></tr>";
                    while($row = $result->fetch_assoc()){
                        $total = $row["total"];
                        $path = "assets/".$row["foodImage"];
                        echo "<tr>
                            <td style='padding-left: 1em;'>" . $row["orderItemID"] . "</td>
                            <td>" . $row["foodName"] . "</td>
                            <td><img class='food-image' src='" .$path . "' alt='Food Image'></td>
                            <td>" . $row["price"] . "</td>
                            <td>" . $row["quantity"] . "</td>
                            <td>" . $row["cost"] . "</td>
                            
                        </tr>";
                    }
                    echo "<tr class='row-total'><td colspan='6'>Total for this order: ".$total."</td></tr>";
                    echo "</table>";
                }
               
            }
            else{
                echo "<h1 class ='title'>View the user details</h1>";
                $username = $_POST["userdetails"];

                $sql = "SELECT * FROM customer WHERE username = '$username'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();

                    echo "<form method='post'>
                        <label for='username'>Username: </label>
                        <input type='text' name='username' id='username' value =". $username. " readonly>
                        <br>
                        <label for='fname'>First Name: </label>
                        <input type='text' name='fname' id='fname' value=". $row["firstName"]. " placeholder=". $row["firstName"]. ">
                        <br>
                        <label for='lname'>Last Name: </label>
                        <input type='text' name='lname' id='lname' value=". $row["lastName"]. " placeholder=". $row["lastName"]. ">
                        <br>
                        <label for='email'>Email: </label>
                        <input type='email' name='email' id='email' value=". $row["email"]. " placeholder=". $row["email"]. ">
                        <br>
                        <label for='phone'>Phone Number: </label>
                        <input type='text' name='phone' id='phone' value=". $row["phoneNo"]. " placeholder=". $row["phoneNo"]. ">
                        <br>
                        <label for='password'>Password: </label>
                        <input type='text' name='password' id='password' value=". $row["password"]. " placeholder=". $row["password"]. " readonly>
                        <br>

                       
                    </form>";
                }
                else{
                    echo "This user no longer exists.";
                }
            }

            
        ?>
        <div class="cta-container">
            <a href="allorders.php"><button name='change' class='cta'>Return to previous screen</button></a>
            <a href="admindashboard.php"><button class="cta">Return to main menu</button></a>
        </div>
    </div>
</body>
</html>



