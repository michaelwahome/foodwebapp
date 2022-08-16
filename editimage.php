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
        
        <div class="upload">
        
        <?php
                
                if (isset($_POST["editimage"])){
                    echo "<h1>Edit the menu item image</h1>
                    <p>The ID of the menu item cannot be changed</p>";

                    $foodID = $_POST["editimage"];

                    $sql = "SELECT * FROM food WHERE foodID = '$foodID'";
                    $result = $conn->query($sql);
                    
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $path = "assets/".$row["foodImage"];

                        echo "<form method='post' enctype='multipart/form-data'>
                            <input type='text' class='input' name='foodID' value = '".$row["foodID"] ."' placeholder='".$row["foodID"] ."' readonly>
                            <br>
                            <div class='edit-image-div'>
                                <img class='food-image food-image-single' src='".$path."'>
                                <input type='file' class='input select-file-btn' name='foodimageupdate'>
                            </div>
                            <br>
                            
                            <div class='cancel-edit-container'>
                                <button name ='cancel' class='cta'>Cancel</button>
                                <button name ='changeimage' class='cta'>Edit</button>
                            </div>
                        </form>";
                    }
                    else{
                        echo "This user no longer exists.";
                    }
                }
                elseif (isset($_POST["editothers"])){
                    echo "<h1>Edit menu items</h1>
                    <p>Change the fields you would like to edit.</p>
                    <p>The ID of the menu item cannot be changed</p>";

                    $foodID = $_POST["editothers"];

                    $sql = "SELECT * FROM food WHERE foodID = '$foodID'";
                    $result = $conn->query($sql);
                    
                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc();

                        echo "<form method='post' enctype='multipart/form-data'>
                            <input type='text' class='input' name='foodID' value = '".$row["foodID"] ."' placeholder='".$row["foodID"] ."' readonly>
                            <br>
                            <br>
                            <input type='text' class='input' name='foodname' value = '".$row["foodName"] ."' placeholder='".$row["foodName"] ."'>
                            <br>
                            <br>
                            <input type='text' class='input' name='price' value='".$row["price"]."' placeholder='".$row["price"]."'>
                            <br>
                            
                            <div class='cancel-edit-container'>
                                <button name ='cancel' class='cta'>Cancel</button>
                                <button name ='changeothers' class='cta'>Edit</button>
                            </div>
                        </form>";
                    }
                    else{
                        echo "This user no longer exists.";
                    }
                }
                else{
                    echo "<form method='post'>
                        <h1>Are you sure you want to delete the record associated with food item: </h1>
                        <h1>". $_POST["delete"] ."</h1>
                        <h2>This action is irreversible</h2>

                        <div class='cancel-edit-container'>
                            <button name ='cancel' class='cta'>Cancel</button>
                            <button name ='del' value='".$_POST["delete"]."' class='cta'>Delete</button>
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
    
    if (isset($_POST["changeimage"])){
        $foodID = $_POST["foodID"];
        $file_path="assets/";

        $original_file_name= $_FILES['foodimageupdate']['name'];
        $file_tmp_location = $_FILES['foodimageupdate']['tmp_name'];

        if (move_uploaded_file($file_tmp_location, $file_path.$original_file_name)){

            $sql = "UPDATE food SET foodImage='$original_file_name' WHERE foodID='$foodID'";

            if($conn->query($sql) === TRUE){
                header("location: viewimage.php");
            }
            else{
                echo "Insertion error: ". $conn->error;
            }

        }    
    }

    if(isset($_POST["changeothers"])){
        $foodID = $_POST["foodID"];
        $foodname = $_POST["foodname"];
        $price = $_POST["price"];
        $sql = "UPDATE food SET foodname='$foodname', price='$price' WHERE foodID ='$foodID'";

        if($conn->query($sql) === TRUE){
            header("location: viewimage.php");
        }
        else{
            echo "Insertion error: ". $conn->error;
        }
    }


    if(isset($_POST["del"])){
        $foodID = $_POST["del"];

        $sql = "DELETE FROM food WHERE foodID = '$foodID'";
        if($conn->query($sql) === TRUE){
            header("location: viewimage.php");
        }
        else{
            echo "Deletion error: ". $conn->error;
        } 
    }

    if(isset($_POST["cancel"])){
        header("location: viewimage.php");
    }
?>








