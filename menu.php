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
<body class="menu-body">
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

    <h1 class="title">Pick your poison</h1>

    <?php if(isset($_SESSION["username"])){ ?>
    <div class="main-cta-div"><a href="order.php" class="cta main-cta">Proceed to confirm order</a></div>
    <?php } ?>

    <div class="menu-container">
            
        <?php

            $sql = "SELECT * FROM food";
            $result = $conn->query($sql);

            if($result->num_rows > 0){
                
                while($row = $result->fetch_assoc()){
                    $path = "assets/".$row["foodImage"];

                    echo "<form method='post'>
                        <div class='menu-div'>
                            <div class='menu-item-image'>
                                <img src='".$path."' alt='".$path."'>
                            </div>
                            <div class='menu-item-text'>
                                <form method='post'>
                                <h2 class='menu-subtitle'>".$row["foodName"]."</h2>
                                <div class='menu-item-div'><p>Price: <input class='price-detail' type='number' name='price' value='".$row["price"]."' readonly></p></div>
                                <div class='menu-item-div'><p>Quantity: <input class='input menu-quantity' type='number' name='quantity' value='1' placeholder='Quantity'></p></div>";

                                if(isset($_SESSION["username"])){
                                    echo "<button name='addtocart' value='".$row["foodID"]."' class='cta add-to-cart-cta'>Add to cart</button>";  
                                }
                                echo "</form>                  
                            </div>
                        </div>
                    </form>";
                }
            }
            else{
                echo "There are no menu items";
            }

        ?>

    </div>
    
    <?php createFooter(); ?>

</body>
</html>


<?php
    if(isset($_POST["addtocart"])){
        if(!isset($_SESSION["cartID"])){
            $username=$_SESSION["username"];
            $sql = "SELECT * FROM cart WHERE username = '$username'";
                $result = $conn->query($sql);
                
                if($result->num_rows == 1){
                    $row = $result->fetch_assoc();
                    $_SESSION["cartID"] = $row["cartID"];
                }
                else{
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
        }

        $cartID = $_SESSION["cartID"];
        $foodID = $_POST["addtocart"];
        $quantity = $_POST["quantity"];
        $price = $_POST["price"];
        $cost = $price * $quantity;
        $sql = "INSERT INTO cart_item(cartID, foodID, quantity, cost) VALUES('$cartID', '$foodID', '$quantity', '$cost')";

        if($conn->query($sql) === TRUE){
            $sql = "SELECT * FROM cart WHERE cartID='$cartID'";
            $result=$conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $total = $row["total"] + $cost;

                $sql = "UPDATE cart SET total = '$total' WHERE cartID = '$cartID'";
                $conn->query($sql);
            }
            else{
                echo "No results found.";
            }

            unset($_POST["addtocart"]);
            echo "<script>alert('Successfully added to cart!');</script>";
            
        }
        else{
            echo "Insertion error: ". $conn->error;
        }

    }




?>