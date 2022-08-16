<?php session_start(); require_once("connect.php");?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Web App</title>
    <link rel="stylesheet" href="css/register.css?v=<?php echo time(); ?>">
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
    
        <div class="register-container">
            <h1>SIGN UP</h1>
            <form method = "post" class="details">
                <div class="detail-item">
                    <input class="input" type="text" name="username" id="username" placeholder="Username">
                </div>
                <div class="detail-item">
                    <input class="input" type="text" name="fname" id="fname" placeholder="First name">
                </div>
                <div class="detail-item">
                    <input class="input" type="text" name="lname" id="lname" placeholder="Last name">
                </div>
                <div class="detail-item">
                    <input class="input" type="email" name="email" id="email" placeholder="E-mail">
                </div>
                <div class="detail-item">
                    <input class="input" type="text" name="phone" id="phone" placeholder="Phone number">
                </div>
                <div class="detail-item">
                    <input class="input" type="password" name="password" id="password" placeholder="Password">
                </div>
                <div class="detail-item">
                    <input class="input" type="password" name="confirmpassword" id="confirmpassword" placeholder="Confirm Password">
                </div>
                <div class="cta">
                    <button name="register" class="cta-button">Sign Up</button>
                </div>
                <div class="links">
                    <a href="login.php">Already have an account?</a>
                </div>
            </form>
            
        </div>
    </div>
    
    
</body>
</html>

<?php

    if(isset($_POST["register"])){
        $username = $_POST["username"];
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $email = $_POST["email"];
        $phoneNo = $_POST["phone"];
        $password = $_POST["password"];
        $confirmpassword = $_POST["confirmpassword"];
    
        $sql = "INSERT INTO customer(username, firstName, lastName, email, phoneNo, password) VALUES ('$username', '$fname ',  '$lname',  '$email', '$phoneNo',  '$password')";
        
        if($conn->query($sql) === TRUE){
            $_SESSION["username"] = $username;
            $_SESSION["usertype"] = "customer";
            echo "<script type='text/javascript'> document.location = 'menu.php'; </script>";
        }
        else{
            echo "Insertion error: ". $conn->error;
        }

    }

    
?>