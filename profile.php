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
<body class="profile-body">
    <?php createNav(); ?>

    <h1 class='title'>View your profile details</h1>

    <div class="profile-container">

        <h3>
            Change the fields you would like to edit. 
            <?php if(isset($_SESSION["priority"])){
                echo "You cannot change your username, password or priority.";
            }
            else{
                echo "You cannot change your username or password.";
            } ?>
        </h3>
        
        <?php
            
            $username = $_SESSION["username"];
            $usertype = $_SESSION["usertype"];

            $sql = "SELECT * FROM ".$usertype." WHERE username = '$username'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();

                echo "<form method='post'>
                    <label for='username'>Username: </label>
                    <input class='input' type='text' name='username' id='username' value =". $username. " readonly>
                    <br>
                    <label for='fname'>First Name: </label>
                    <input class='input' type='text' name='fname' id='fname' value=". $row["firstName"]. " placeholder=". $row["firstName"]. ">
                    <br>
                    <label for='lname'>Last Name: </label>
                    <input class='input' type='text' name='lname' id='lname' value=". $row["lastName"]. " placeholder=". $row["lastName"]. ">
                    <br>";
                    if(isset($_SESSION["priority"])){
                        echo "<label for='priority'>Priority: </label>
                        <input class='input' type='text' name='priority' id='priority' value=". $row["priority"]. " placeholder=". $row["priority"]. " readonly>
                        <br>";
                    }
                    echo "<label for='email'>Email: </label>
                    <input class='input' type='email' name='email' id='email' value=". $row["email"]. " placeholder=". $row["email"]. ">
                    <br>
                    <label for='phone'>Phone Number: </label>
                    <input class='input' type='text' name='phone' id='phone' value=". $row["phoneNo"]. " placeholder=". $row["phoneNo"]. ">
                    <br>
                    <label for='password'>Password: </label>
                    <input class='input' type='text' name='password' id='password' value=". $row["password"]. " placeholder=". $row["password"]. " readonly>
                    <br>

                    <div class='profile-cta-section'>
                        <button name='change' class='cta profile-cta'>Edit</button>
                        <button name='return' class='cta profile-cta'>Return to home screen</button>
                    </div>
                </form>";
            }
            else{
                echo "This user no longer exists.";
            }
                
        ?>


    </div>

    <?php createFooter(); ?>
        
</body>
</html>

<?php
    if (isset($_POST["change"])){
        $username = $_POST["username"];
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $password = $_POST["password"];
        $sql = "UPDATE ".$usertype." SET firstName ='$fname', lastName = '$lname', email = '$email', phoneNo = '$phone' WHERE username = '$username'";
        if($conn->query($sql) === TRUE){
            if($usertype=="customer"){
                echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
            }
            else{
                echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
            }
        }
        else{
            echo "Insertion error: ". $conn->error;
        }
    }

    if(isset($_POST["return"])){
        if($usertype=="customer"){
            echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
        }
        else{
            echo "<script type='text/javascript'> document.location = 'admindashboard.php'; </script>";
        }
    }

?>