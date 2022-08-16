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
<body class='purchase-history-body'>
    <?php createNav(); ?>
    

    <h1 class="title">View purchase history</h1>
    <div class="purchase-history-container">
        
        <?php   

            $sql = "SELECT * FROM orders WHERE username='".$_SESSION["username"]."'";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                $i = 0;
                while($row = $result->fetch_assoc()){
                    $i += 1; 
                    $orderID[$i] = $row["orderID"];    
                }
                
                echo "<table class='table'><tr><th></th><th>Food Name</th><th>Food Image</th><th>Price</th><th>Quantity</th><th>Cost</th></tr>";            
                for($j = 1; $j <= $i; $j++){
                    $sql = "SELECT order_item.*, orders.*, food.* FROM order_item 
                    INNER JOIN food ON order_item.foodID = food.foodID
                    INNER JOIN orders ON order_item.orderID = orders.orderID
                    WHERE order_item.orderID = '".$orderID[$j]."'
                    ";
                    $result = $conn->query($sql);
                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()){
                            $total = $row["total"];
                            $path = "assets/".$row["foodImage"];
                            echo "<tr>
                                <td style='padding-left: 1em;'>" . $row["orderItemID"] . "</td>
                                <td>" . $row["foodName"] . "</td>
                                <td><img class='cart-item-image' src='" .$path . "' alt='Food Image'></td>
                                <td>" . $row["price"] . "</td>
                                <td>" . $row["quantity"] . "</td>
                                <td>" . $row["cost"] . "</td>
                                
                            </tr>";
                        }
                        echo "<tr class='purchase-history-total'><td colspan='6'>Total for this order:".$total."</td></tr>";
                    
                    }
                }
                echo "</table>";
            }
            else{
                echo "<p class='cart-empty-warning'>You have not made any orders yet.</p>";
            }
        
        
        
        
        ?>

        <div class="purchase-history-cta-section">
            <a href="index.php"><button class="cta purchase-history-cta">Return to home screen</button></a>
        </div>
        
    </div>


    <?php createFooter(); ?>


</body>
</html>