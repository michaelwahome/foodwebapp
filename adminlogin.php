<?php session_start(); require_once("connect.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Web App</title>
    <link rel="stylesheet" href="css/login.css?v=<?php echo time(); ?>">
    <link rel="icon" href="images/favicon.svg">
</head>

<body>
    <div class="container">
        <div class="wall">
            <div class="logo">
                <h1><a href="index.php">The<span style="color: rgb(0, 204, 255);">Burger</span>Joint</a></h1>
            </div>
            <div class="wall-message">
                <h2>A world of flavour awaits</h2>
            </div>
        </div>
    
        <div class="login-container">
            <h1>ADMIN SIGN IN</h1>
            <form method="post" class="details">
                <div class="detail-item">
                    <input class="input" type="text" name="username" id="username" placeholder="Username">
                </div>
                <div class="detail-item">
                    <input class="input" type="password" name="password" id="password" placeholder="Password">
                </div>
                <div class="cta">
                    <button name="login" class="cta-button">Sign In</button>
                </div>
                <div class="links-div">
                    <a class="links" href="#">Forgot password?</a>
                    <div class="bar"></div>
                    <a class="links" href="login.php">Not an admin?</a>
                </div>
            </form>
        </div>
    </div>
    
    
</body>
</html>

<?php

    if(isset($_POST["login"])){
        if(empty($_POST["username"]) || empty($_POST["password"])){
            echo "<script type='text/javascript'> document.location = 'adminlogin.php'; </script>"; 
        }
        else{
            $username = $_POST["username"];
            $password = $_POST["password"];
        
            $sql = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
            $result = $conn->query($sql);
            if($result->num_rows >0) { 
                while($row = $result-> fetch_assoc()){
                    $_SESSION["username"] = $username;    
                    $_SESSION["usertype"] = "admin";   
                    $_SESSION["priority"] = $row["priority"]; 
                    echo "<script type='text/javascript'> document.location = 'admindashboard.php'; </script>";
                }
            }    
            else{
                echo "<script type='text/javascript'> document.location = 'adminlogin.php'; </script>";
            }
        }
    }
    
?>