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
        

        <div class="edit">
            <?php
                
                $edittype = $_SESSION["edittype"];

                if (isset($_POST["username"])){
                    echo "<h1>Edit accounts</h1>
                    <p>Change the fields you would like to edit.</p>
                    <p>The username and password cannot be changed.</p>";

                    $username = $_POST["username"];

                    $sql = "SELECT * FROM ".$edittype." WHERE username = '$username'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();

                        echo "<form method='post'>
                            <label for='username'>Username: </label>
                            <input class='input edit-page-input' type='text' name='username' id='username' value =". $username. " readonly>
                            <br>
                            <label for='fname'>First Name: </label>
                            <input class='input edit-page-input' type='text' name='fname' id='fname' value=". $row["firstName"]. " placeholder=". $row["firstName"]. ">
                            <br>
                            <label for='lname'>Last Name: </label>
                            <input class='input edit-page-input' type='text' name='lname' id='lname' value=". $row["lastName"]. " placeholder=". $row["lastName"]. ">
                            <br>";
                            if($edittype == "admin"){
                                echo "<div class='detail-item'>
                                    <label for='priority'>Select priority: </label>
                                    <select class='input edit-page-input admin-priority' name='priority' id='priority' readonly>";
                                        if($row["priority"] == "normal"){
                                            echo "<option value='normal' default>Normal</option>
                                            <option value='super'>Super</option>";
                                        }
                                        else{
                                            echo "<option value='super'>Super</option>
                                            <option value='normal' default>Normal</option>";
                                        }
                                    echo "</select>
                                </div>";
                            }
                            echo "<label for='email'>Email: </label>
                            <input class='input edit-page-input' type='email' name='email' id='email' value=". $row["email"]. " placeholder=". $row["email"]. ">
                            <br>
                            <label for='phone'>Phone Number: </label>
                            <input class='input edit-page-input' type='text' name='phone' id='phone' value=". $row["phoneNo"]. " placeholder=". $row["phoneNo"]. ">
                            <br>
                            <label for='password'>Password: </label>
                            <input class='input edit-page-input' type='text' name='password' id='password' value=". $row["password"]. " placeholder=". $row["password"]. " readonly>
                            <br>
                            
                            <div class='cancel-edit-container'>
                                <button name ='cancel' class='cta'>Cancel</button>
                                <button name ='change' class='cta'>Edit</button>
                            </div>
                        </form>";
                    }
                    else{
                        echo "This user no longer exists.";
                    }
                }
                else{
                    echo "<form method='post'>
                        <h1>Are you sure you want to delete the record associated with user: </h1>
                        <h1>". $_POST["delete"] ."</h1>
                        <h2>This action is irreversible</h2>

                        <div class='cancel-edit-container'>
                            <button name = 'cancel' class='cta'>Cancel</button>
                            <button name ='del' value=".$_POST["delete"]." class='cta'>Delete</button>
                        </div>
                        </form>";
                }
            ?>
        </div>
        <a href="admindashboard.php"><button class="cta return-to-menu-btn">Return to main menu</button></a>
    </div>


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

        if(isset($_POST["priority"])){
            $priority = $_POST["priority"];
            $sql = "UPDATE ".$edittype." SET firstName ='$fname', lastName = '$lname', priority = '$priority', email = '$email', phoneNo = '$phone' WHERE username = '$username'";
            if($conn->query($sql) === TRUE){
                if($edittype == "customer"){
                    header("location: useraccounts.php");
                }
                else{
                    header("location: adminaccounts.php");
                } 
            }
            else{
                echo "Insertion error: ". $conn->error;
            }
        }
        
        else{
            $sql = "UPDATE ".$edittype." SET firstName ='$fname', lastName = '$lname', email = '$email', phoneNo = '$phone' WHERE username = '$username'";
            if($conn->query($sql) === TRUE){
                if($edittype == "customer"){
                    header("location: useraccounts.php");
                }
                else{
                    header("location: adminaccounts.php");
                } 
            }
            else{
                echo "Insertion error: ". $conn->error;
            }
        }   
    }

    if(isset($_POST["del"])){
        $username = $_POST["del"];
        $sql = "DELETE FROM ".$edittype." WHERE username = '$username'";
        if($conn->query($sql) === TRUE){
            if($edittype == "customer"){
                header("location: useraccounts.php");
            }
            else{
                header("location: adminaccounts.php");
            } 
        }
        else{
            echo "Deletion error: ". $conn->error;
        }  
    }

    if(isset($_POST["cancel"])){
        if($edittype == "customer"){
            header("location: useraccounts.php");
        }
        else{
            header("location: adminaccounts.php");
        } 
    }
?>








