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
        <h2>View all menu items</h2>
        
        <div class="image">
            
            <?php

                $sql = "SELECT * FROM food";
                $result = $conn->query($sql);

                $results_per_page = 5;
                $number_of_results = $result->num_rows;
                $number_of_pages = ceil($number_of_results/$results_per_page);

                if (!isset ($_GET['page']) ) {  
                    $page = 1;  
                } else {  
                    $page = $_GET['page'];  
                }  

                $page_first_result = ($page-1) * $results_per_page;

                $sql = "SELECT * FROM food LIMIT ".$page_first_result.", ". $results_per_page;
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    echo "<table style='width: 100%; text-align: left;'><tr><th>Food ID</th><th>Image</th><th>Edit Image</th><th>Food Name</th><th>Price</th><th>Edit Others</th><th>Delete</th></tr>";

                        while($row = $result->fetch_assoc()) {
                            $path = "assets/".$row["foodImage"];

                            echo "<form action='editimage.php' method='post'><tr>
                                <td style='padding-left: 1em;'>" . $row["foodID"] . "</td>
                                <td><img class='food-image' src='".$path."'></td>
                                <td>
                                    <button name='editimage' value=".$row["foodID"].">
                                        <img src='images/edit.svg' alt='Edit'>
                                    </button>
                                </td>
                                <td>" . $row["foodName"] . "</td>
                                <td>" . $row["price"] . "</td>
                                <td>
                                    <button name='editothers' value=".$row["foodID"].">
                                        <img src='images/edit.svg' alt='Edit'>
                                    </button>
                                </td>
                                <td>
                                    <button name='delete' value='".$row["foodID"]."'>
                                        <img src='images/delete.svg' alt='Delete'>
                                    </button>
                                </td>
                            </tr></form>";
                        }

                    echo "</table>";
                } else {
                echo "0 results<br>";
                }

                for($page = 1; $page<= $number_of_pages; $page++) {  
                    echo "<a style='margin: 1em; font-weight: bold;' href = 'viewimage.php?page=" . $page . "'>Page " . $page . " </a>";  
                }
            ?>
        </div>
        <a href="admindashboard.php"><button class="cta return-to-menu-btn">Return to main menu</button></a>
        
    </div>
</body>
</html>

