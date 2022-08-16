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
<body class="cart-body">
    <?php createNav(); ?>
            
    <?php


        if(isset($_POST["edit"])){

            $cartitemID = $_POST["edit"];

            $sql = "SELECT * FROM cart_item WHERE cartItemID = '$cartitemID'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();

                echo "<h1 class='title'>Edit item quantity</h1>
                <div class='cart-container'>
                <h3>You cannot change the cart item ID. It is only for identification purposes.</h3>
                    <form method='post'>
                    <div class='edit-cart-div'>
                        <div class='edit-cart-label-input'>
                            <label class='cart-label' for='cartitemID'>Cart Item ID: </label>
                            <input class='input cart-input' type='text' name='cartitemID' id='cartitemID' value =". $cartitemID. " readonly>
                        </div>
                        <div class='edit-cart-label-input'>
                            <label class='cart-label' for='quantity'>Quantity: </label>
                            <input class='input cart-input' type='number' name='quantity' id='quantity' value=". $row["quantity"]. " placeholder=". $row["quantity"]. ">
                        </div>
                    </div>
                    <div class='cart-cta-section'>
                        <button name='change' class='cta cart-cta'>Edit</button>
                        <button name='cancel' class='cta cart-cta'>Cancel</button>
                    </div>
                    </form>
                </div>";
            }
            else{
                echo "This user no longer exists.";
            }
        }
        else{
            echo "<h1 class='title'>Delete item from cart</h1>
            <div class='cart-container'>
                <form method='post'>
                <h2>Are you sure you want to delete this item from your cart? </h2>";

            $sql = "SELECT cart_item.*, cart.*, food.* FROM cart_item 
                INNER JOIN food ON cart_item.foodID = food.foodID
                INNER JOIN cart ON cart_item.cartID = cart.cartID
                WHERE cart_item.cartItemID = '".$_POST["delete"]."'
                ";

            $result = $conn->query($sql);
            if($result->num_rows > 0){
                $row = $result->fetch_assoc();
                $name = $row["foodName"];
            }
            echo "<h1>". $name ."</h1>
                <h2>This action is irreversible</h2>

                <div class='cart-cta-section'>
                    <button name ='cancel' class='cta cart-cta'>Cancel</button>
                    <button name ='del' value='".$_POST["delete"]."' class='cta cart-cta'>Delete</button>
                </div>
                </form>
            </div>";
        }
            
    ?>

    <?php createFooter(); ?>
        
</body>
</html>


<?php
    if(isset($_POST["change"])){
        $cartitemID = $_POST["cartitemID"];
        $quantity = $_POST["quantity"];
        $sql = "SELECT cart_item.*, cart.*, food.* FROM cart_item 
            INNER JOIN food ON cart_item.foodID = food.foodID
            INNER JOIN cart ON cart_item.cartID = cart.cartID
            WHERE cart_item.cartItemID = '".$cartitemID."'
            ";

        $result = $conn->query($sql);
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $oldcost = $row["cost"];
            $newcost = $quantity * $row["price"];
            $newtotal = $row["total"] - $oldcost + $newcost;
        }

        $sql = "UPDATE cart_item SET quantity='$quantity', cost='$newcost' WHERE cartItemID ='$cartitemID'";

        if($conn->query($sql) === TRUE){
            $sql = "UPDATE cart SET total='$newtotal' WHERE cartID ='".$_SESSION["cartID"]."'";
            if($conn->query($sql) === TRUE){
                echo "<script type='text/javascript'> document.location = 'order.php'; </script>"; 
            }
            else{
                echo "Insertion error: ". $conn->error;
            }
        }
        else{
            echo "Insertion error: ". $conn->error;
        }
    }

    if(isset($_POST["del"])){
        $cartitemID = $_POST["del"];

        $sql = "SELECT cart_item.*, cart.*, food.* FROM cart_item 
            INNER JOIN food ON cart_item.foodID = food.foodID
            INNER JOIN cart ON cart_item.cartID = cart.cartID
            WHERE cart_item.cartItemID = '".$cartitemID."'
            ";

        $result = $conn->query($sql);
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $cost = $row["cost"];
            $newtotal = $row["total"] - $cost;
        }

        $sql = "DELETE FROM cart_item WHERE cartItemID = '$cartitemID'";
        if($conn->query($sql) === TRUE){
            $sql = "UPDATE cart SET total='$newtotal' WHERE cartID ='".$_SESSION["cartID"]."'";
            if($conn->query($sql) === TRUE){
                echo "<script type='text/javascript'> document.location = 'order.php'; </script>"; 
            }
            else{
                echo "Insertion error: ". $conn->error;
            }
        }
        else{
            echo "Deletion error: ". $conn->error;
        } 
    }

    if(isset($_POST["cancel"])){
        echo "<script type='text/javascript'> document.location = 'order.php'; </script>"; 
    }

    if(isset($_POST["confirm"])){
        $sql = "SELECT * FROM cart WHERE cartID ='".$_SESSION["cartID"]."' ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $sql = "INSERT INTO orders(orderID, username, total) VALUES ('".$row["cartID"]."','".$row["username"]."','".$row["total"]."')";
            if($conn->query($sql) === TRUE){
                echo "Insertion sucessful";
            }
            else{
                echo "Insertion error: ". $conn->error;
            }
        }

        $sql = "SELECT cart_item.*, cart.* FROM cart_item 
        INNER JOIN cart ON cart_item.cartID = cart.cartID
        WHERE cart_item.cartID = '".$_SESSION["cartID"]."'
        "; 

        $result = $conn->query($sql);
     
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $sql = "INSERT INTO order_item(orderItemID, orderID, foodID, quantity, cost) VALUES ('".$row["cartItemID"]."','".$row["cartID"]."','".$row["foodID"]."','".$row["quantity"]."','".$row["cost"]."')";
                if($conn->query($sql) === TRUE){
                    echo "Insertion sucessful";
                }
                else{
                    echo "Insertion error: ". $conn->error;
                }
            }
        }

        $sql = "DELETE FROM cart_item WHERE cartID ='".$_SESSION["cartID"]."'";
        if($conn->query($sql) === TRUE){
            echo "Deletion sucessful";
        }
        else{
            echo "Deletion error: ". $conn->error;
        }

        $sql = "DELETE FROM cart WHERE cartID ='".$_SESSION["cartID"]."'";
        if($conn->query($sql) === TRUE){
            unset($_SESSION["cartID"]);
            echo "<script>alert('Your order is on its way!');</script>";
            echo "<script type='text/javascript'> document.location = 'index.php'; </script>"; 
        }
        else{
            echo "Deletion error: ". $conn->error;
        }
            
    }  

    if(isset($_POST["previous"])){
        echo "<script type='text/javascript'> document.location = 'menu.php'; </script>"; 
    }
?>