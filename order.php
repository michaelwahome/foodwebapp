<?php session_start(); require_once("connect.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Web App</title>
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <link rel="icon" href="images/favicon.svg">
</head>
<body class="order-body">
    <?php createNav(); ?>

    <?php
    if(!isset($_SESSION["cartID"])){
        $sql = "INSERT INTO cart(username) VALUES('$username')";
            if($conn->query($sql) === TRUE){
                $sql = "SELECT * FROM cart WHERE username = '$username'";
                $result = $conn->query($sql);
                if($result->num_rows == 1){
                    $row = $result->fetch_assoc();
                    $_SESSION["cartID"] = $row["cartID"];
                }
            }
    }
    ?>

    <h1 class="title">Confirm order</h1>
    

    <div class="order-container">
        <form action='editcart.php' method="post">
        
        <?php
            
            if(!isset($_SESSION["cartID"])){
            $sql = "SELECT * FROM cart WHERE username = '".$_SESSION["username"]."'";
                $result = $conn->query($sql);
                
                if($result->num_rows == 1){
                    $row = $result->fetch_assoc();
                    $_SESSION["cartID"] = $row["cartID"];
                }
                else{
                    $sql = "INSERT INTO cart(username) VALUES('".$_SESSION["username"]."')";
                    if($conn->query($sql) === TRUE){
                        $sql = "SELECT * FROM cart WHERE username = '".$_SESSION["username"]."'";
                        $result = $conn->query($sql);
                        if($result->num_rows == 1){
                            $row = $result->fetch_assoc();
                            $_SESSION["cartID"] = $row["cartID"];
                        }
                    }
                }
            }

             $sql = "SELECT cart_item.*, cart.*, food.* FROM cart_item 
             INNER JOIN food ON cart_item.foodID = food.foodID
             INNER JOIN cart ON cart_item.cartID = cart.cartID
             WHERE cart_item.cartID = '".$_SESSION["cartID"]."'
             ";
             $result = $conn->query($sql);
             
             if ($result->num_rows > 0) {
                echo "<table class='table'><tr><th></th><th>Food Name</th><th>Food Image</th><th>Price</th><th>Quantity</th><th>Cost</th><th>Edit Quantity</th><th>Delete</th></tr>";

                    while($row = $result->fetch_assoc()) {
                        $path = "assets/".$row["foodImage"];
                        
                        echo "<form action='editcart.php' method='post'><tr>
                            <td style='padding-left: 1em;'>" . $row["cartItemID"] . "</td>
                            <td>" . $row["foodName"] . "</td>
                            <td><img class='cart-item-image' src='" .$path . "' alt='Food Image'></td>
                            <td>" . $row["price"] . "</td>
                            <td>" . $row["quantity"] . "</td>
                            <td>" . $row["cost"] . "</td>
                            <td>
                                <button name='edit' value=".$row["cartItemID"].">
                                    <img src='images/edit.svg' alt='Edit'>
                                </button>
                            </td>
                            <td>
                                <button name='delete' value=".$row["cartItemID"].">
                                    <img src='images/delete.svg' alt='Delete'>
                                </button>
                            </td>
                        </tr></form>";
                        $total = $row["total"];
                    }
                    

                echo "</table>";
            } else {
            echo "<h2 class='cart-empty-warning'>Your cart is empty</h2>";
            }
            if(isset($total)){
                echo "<h2 class='order-total'>The total is: ".$total."Ksh</h2>";
            }
        ?>

        <div class="order-cta-section">
            <a href="menu.php"><button name="previous" class="cta order-cta">Previous Screen</button></a>
            <button name='confirm' class="cta order-cta">Confirm</button> 
        </div>
        
        </form>
    </div>

    <?php createFooter(); ?>

</body>
</html>


<?php 
      

?>