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
        <h1>View all admin accounts</h1>

        <div class="account">
            <?php

                $_SESSION["edittype"] = "admin";

                $sql= "SELECT * FROM admin";
                $result = $conn->query($sql);

                $results_per_page = 6;
                $number_of_results = $result->num_rows;
                $number_of_pages = ceil($number_of_results/$results_per_page);

                if (!isset ($_GET['page']) ) {  
                    $page = 1;  
                } else {  
                    $page = $_GET['page'];  
                }  

                $page_first_result = ($page-1) * $results_per_page;

                $sql = "SELECT * FROM admin LIMIT ".$page_first_result.", ". $results_per_page;
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    if($_SESSION["priority"] =="super"){
                        echo "<table class='table'><tr><th>Username</th><th>First Name</th><th>Last Name</th><th>Priority</th><th>Email</th><th>Phone Number</th><th>Password</th><th>Edit</th><th>Delete</th></tr>";

                        while($row = $result->fetch_assoc()) {
                            echo "<form action='edit.php' method='post'><tr>
                                <td style='padding-left: 1em;'>" . $row["username"] . "</td>
                                <td>" . $row["firstName"] . "</td>
                                <td>" . $row["lastName"] . "</td>
                                <td>" . $row["priority"] . "</td>
                                <td>" . $row["email"] . "</td>
                                <td>" . $row["phoneNo"] . "</td>
                                <td>" . $row["password"] . "</td>
                                <td>
                                    <button name='username' value=".$row["username"].">
                                        <img src='images/edit.svg' alt='Edit'>
                                    </button>
                                </td>
                                <td>
                                    <button name='delete' value=".$row["username"].">
                                        <img src='images/delete.svg' alt='Delete'>
                                    </button>
                                </td>
                            </tr></form>";
                        }

                    echo "</table>";
                    }
                    else{
                        echo "<table style='width: 100%; text-align: left;'><tr><th>Username</th><th>First Name</th><th>Last Name</th><th>Priority</th><th>Email</th><th>Phone Number</th><th>Password</th></tr>";

                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td style='padding-left: 1em;'>" . $row["username"] . "</td>
                                <td>" . $row["firstName"] . "</td>
                                <td>" . $row["lastName"] . "</td>
                                <td>" . $row["priority"] . "</td>
                                <td>" . $row["email"] . "</td>
                                <td>" . $row["phoneNo"] . "</td>
                                <td>" . $row["password"] . "</td>
                            </tr>";
                        }

                    echo "</table>";
                    }
                    
                } else {
                echo "0 results<br>";
                }

                for($page = 1; $page<= $number_of_pages; $page++) {  
                    echo "<a style='margin: 1em; font-weight: bold;' href = 'adminaccounts.php?page=" . $page . "'>Page " . $page . " </a>";  
                }  

            ?>
        </div>
        <a href="admindashboard.php"><button class="cta return-to-menu-btn">Return to main menu</button></a>
    </div>
</body>
</html>