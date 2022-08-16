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
<body class="logout-body">
    <?php createNav(); ?>
            
    <?php
        echo "<h1 class='title'>Log Out</h1>
        <div class='logout-container'>
            <form method='post'>
                <h1>". $_SESSION["username"] ."</h1>
                <h2>Are you sure you want to logout?</h2>

                <div class='logout-cta-section'>
                    <button name ='return' class='cta logout-cta'>Return to main menu</button>
                    <button name ='logout' class='cta logout-cta'>Logout</button>
                </div>
            </form>
        </div>";
            
    ?>

    <?php createFooter(); ?>
        
</body>
</html>


<?php
    if(isset($_POST["logout"])){
        session_unset();
        session_destroy();
        echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
    }

    if(isset($_POST["return"])){
        if($_SESSION["usertype"]=="customer"){
            echo "<script type='text/javascript'> document.location = 'menu.php'; </script>";
        }
        else{
            echo "<script type='text/javascript'> document.location = 'admindashboard.php'; </script>";
        }
    }
?>