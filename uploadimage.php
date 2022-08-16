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
        
        <h1>Add an item to the menu</h1>

        <div class="upload">
            <form method="post" enctype="multipart/form-data">
                <div class="detail-item">
                    <input type="text" class="input" name="foodID" placeholder="Food ID" required>
                </div>
                <br>
                <div class="detail-item">
                    <input type="text" class="input" name="foodname" placeholder="Food item name" required>
                </div>
                <div class="detail-item">
                    <input type="file" class="input select-file-btn" name="foodimage" required>
                </div>
                <div class="detail-item">
                    <input type="number" class="input" name="price" placeholder="Price" required>
                </div>      
                <button name ="upload" class="cta in-form-btn">Upload</button>
            </form>
            <a href="admindashboard.php"><button class="cta return-to-menu-btn">Return to main menu</button></a>
        </div>
    </div>


</body>
</html>

<?php

    if(isset($_POST["upload"])){

        $foodID = $_POST["foodID"];
        $foodname = $_POST["foodname"];
        $price = $_POST["price"];


        $file_path="assets/";

        $original_file_name= $_FILES['foodimage']['name'];
        $file_tmp_location = $_FILES['foodimage']['tmp_name'];

        if (move_uploaded_file($file_tmp_location, $file_path.$original_file_name)){

            $sql = "INSERT INTO food(foodID, foodName, foodImage, price) VALUES('$foodID', '$foodname', '$original_file_name', '$price')";

            if($conn->query($sql) === TRUE){
                unset($_FILES["foodimage"]);
                header("location: admindashboard.php");
            }
            else{
                echo "Insertion error: ". $conn->error;
            }

        }
    }

?>








