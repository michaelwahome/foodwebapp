<?php

$conn = connect();

function connect(){
    $conn = new mysqli("localhost", "wahome", "mw@home02", "foodwebapp");

    if($conn->connect_error){
        die("Not connected".$conn->connect_error);
    }

    return $conn;
}

function createDatabase(){
    $conn = connect();
    $sql = "CREATE DATABASE IF NOT EXISTS foodwebapp";

    if($conn->query($sql) !== TRUE){
        echo "Database creation failed ".$conn->error;
    }
}

function createCustomerTable(){
    $conn = connect();
    $sql_table = "CREATE TABLE IF NOT EXISTS customer(
        username VARCHAR(20) PRIMARY KEY,
        firstname varchar(15) NOT NULL,
        lastname varchar(15) NOT NULL,
        email varchar(30) NOT NULL,
        phoneNo varchar(20) NOT NULL,
        password varchar(15) NOT NULL     
    )";

    if($conn->query($sql_table) !== TRUE){
        echo "<br>Table creation failed: ".$conn->error;
    }
}

function createAdminTable(){
    $conn = connect();
    $sql_table = "CREATE TABLE IF NOT EXISTS admin(
        username VARCHAR(20) PRIMARY KEY,
        firstname varchar(15) NOT NULL,
        lastname varchar(15) NOT NULL,
        priority varchar(10) NOT NULL,
        email varchar(30) NOT NULL,
        phoneNo varchar(20) NOT NULL,
        password varchar(15) NOT NULL     
    )";
    
    if($conn->query($sql_table) !== TRUE){
        echo "<br>Table creation failed: ".$conn->error;
    }
}

function createFoodTable(){
    $conn = connect();
    $sql_table = "CREATE TABLE IF NOT EXISTS food(
        foodID VARCHAR(20) PRIMARY KEY,
        foodName varchar(30) NOT NULL,
        foodImage varchar(100) NOT NULL,
        price INT(11) NOT NULL,   
    )";
    
    if($conn->query($sql_table) !== TRUE){
        echo "<br>Table creation failed: ".$conn->error;
    }
}

function createOrdersTable(){
    $conn = connect();
    $sql_table = "CREATE TABLE IF NOT EXISTS orders(
        orderID INT(20) PRIMARY KEY,
        username varchar(20) NOT NULL,
        total INT(25) NOT NULL,

        FOREIGN KEY(username) REFERENCES customer(username)     
    )";
    
    if($conn->query($sql_table) !== TRUE){
        echo "<br>Table creation failed: ".$conn->error;
    }
}

function createOrderItemTable(){
    $conn = connect();
    $sql_table = "CREATE TABLE IF NOT EXISTS order_item(
        orderItemID INT(20) PRIMARY KEY,
        orderID INT(20) PRIMARY KEY,
        foodID varchar(20) NOT NULL,
        quantity INT(10) NOT NULL,
        cost INT(20) NOT NULL,

        FOREIGN KEY(orderID) REFERENCES orders(orderID)     
        FOREIGN KEY(foodID) REFERENCES food(foodID)     
    )";
    
    if($conn->query($sql_table) !== TRUE){
        echo "<br>Table creation failed: ".$conn->error;
    }
}

function createCartTable(){
    $conn = connect();
    $sql_table = "CREATE TABLE IF NOT EXISTS cart(
        cartID INT(20) AUTO_INCREMENT PRIMARY KEY,
        username varchar(20) NOT NULL,
        total INT(25) NOT NULL,

        FOREIGN KEY(username) REFERENCES customer(username)     
    )";
    
    if($conn->query($sql_table) !== TRUE){
        echo "<br>Table creation failed: ".$conn->error;
    }
}

function createCartItemTable(){
    $conn = connect();
    $sql_table = "CREATE TABLE IF NOT EXISTS cart_item(
        cartItemID INT(20) AUTO_INCREMENT PRIMARY KEY,
        cartID INT(20) PRIMARY KEY,
        foodID varchar(20) NOT NULL,
        quantity INT(10) NOT NULL,
        cost INT(20) NOT NULL,

        FOREIGN KEY(cartID) REFERENCES cart(cartID)     
        FOREIGN KEY(foodID) REFERENCES food(foodID)     
    )";
    
    if($conn->query($sql_table) !== TRUE){
        echo "<br>Table creation failed: ".$conn->error;
    }
}

function createNav(){
    echo "<header>
        <div class='logo'>";
            if(isset($_SESSION["username"])){
                if($_SESSION["usertype"] == "customer"){
                    echo "<h1><a href='index.php'>The<span style='color: rgb(0, 204, 255);'>Burger</span>Joint</a></h1>";
                }
                else{
                    echo "<h1><a href='admindashboard.php'>The<span style='color: rgb(0, 204, 255);'>Burger</span>Joint</a></h1>";
                }
            }
            else{
                echo "<h1><a href='index.php'>The<span style='color: rgb(0, 204, 255);'>Burger</span>Joint</a></h1>";
            }
        echo "</div>";
        echo "<nav "; 
            if (isset($_SESSION["username"])){
                echo "style='margin-top: 0em;'";
            } 
            echo ">
                <ul  class='nav'>";
                    
                    if(isset($_SESSION["username"])){
                        if($_SESSION["usertype"] == "customer"){
                            echo "<li class='nav-item'><a href='index.php'>Home</a></li>
                            <li class='nav-item'><a href='menu.php'>Our Menu</a></li>
                            <li class='nav-item'><a href='purchasehistory.php'>Order History</a></li>
                            <li class='nav-item'><a href='profile.php'>My Profile</a></li>";
                        }
                        else{
                            echo "<li class='nav-item'><a href='admindashboard.php'>Home</a></li>
                            <li class='nav-item'><a href='viewimage.php'>View Menu</a></li>
                            <li class='nav-item'><a href='useraccounts.php'>View Accounts</a></li>
                            <li class='nav-item'><a href='profile.php'>My Profile</a></li>";
                        }
                    }
                    else{
                        echo "<li class='nav-item'><a href='index.php'>Home</a></li>
                        <li class='nav-item'><a href='menu.php'>Our Menu</a></li>
                        <li class='nav-item'><a href='about.php'>About Us</a></li>
                        <li class='nav-item'><a href='contact.php'>Contact Us</a></li>";
                    }

                    if(isset($_SESSION["username"])){
                        if($_SESSION["usertype"] == "customer"){
                            echo "<li class='nav-item'><a class='nav-cart-icon' href='order.php'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='30' height='30' viewBox='0 3 25 25'><path d='M24 3l-.743 2h-1.929l-3.474 12h-13.239l-4.615-11h16.812l-.564 2h-13.24l2.937 7h10.428l3.432-12h4.195zm-15.5 15c-.828 0-1.5.672-1.5 1.5 0 .829.672 1.5 1.5 1.5s1.5-.671 1.5-1.5c0-.828-.672-1.5-1.5-1.5zm6.9-7-1.9 7c-.828 0-1.5.671-1.5 1.5s.672 1.5 1.5 1.5 1.5-.671 1.5-1.5c0-.828-.672-1.5-1.5-1.5z'/></svg>
                            </a></li>
                            <li class='nav-item'><a class='nav-user' href='logout.php'>".$_SESSION["username"]."</a></li>";
                        }
                        else{
                            echo "<li class='nav-item nav-li-username-admin'><a class='nav-user' href='logout.php'>".$_SESSION["username"]."</a></li>";
                        }
                    }
                    else{
                        echo "<li class='nav-item'><a class='nav-login' href='login.php'>Sign In</a></li>
                            <li class='nav-item'><a class='nav-register' href='register.php'>Sign Up</a></li>";
                    }

                echo "</ul>";
        echo "</nav>";
    echo "</header>";
}

function createFooter(){
    echo "<footer>
        <ul class='footer-links'>
            <li><a href='#'>Back to top</a></li>
            <li>
                <ul>
                    <li  class='footer-top-level'>Customer links</li>
                    <li><a href='about.php'>About Us</a></li>
                    <li><a href='contact.php'>Contact Us</a></li>
                    <li><a href='login.php'>Login</a></li>
                    <li><a href='menu.php'>Digital Menu</a></li>
                    <li><a href='contact.php'>Map to our location</a></li>
                    <li><a href='#'>FAQs</a></li>
                </ul>
            </li>
            <li>
                <ul>
                    <li class='footer-top-level'>Administrative links</li>
                    <li><a href='adminlogin.php'>Login</a></li>
                </ul>
            </li>
            <li>
                <ul>
                    <li class='footer-top-level'>Stay in touch</li>
                    <li class='footer-socials'>
                        <a href='#'><img src='images/facebook.svg' alt='Facebook icon'></a>
                        <a href='#'><img src='images/instagram.svg' alt='Instagram icon'></a>
                        <a href='#'><img src='images/twitter.svg' alt='Twitter icon'></a>
                        <a href='#'><img src='images/email.svg' alt='Email icon'></a>
                        <a href='#'><img src='images/call.svg' alt='Call icon'></a>
                        <a href='#'><img src='images/share.svg' alt='Call icon'></a>
                    </li>
                </ul>
            </li>
            <li>
                <ul>
                    <li class='footer-top-level'>Legal Documents</li>
                    <li><a href='#'>Privacy Policy</a></li>
                    <li><a href='#'>Terms of Use</a></li>
                </ul>
            </li>
        </ul>
        <p class='copyright-tag'>©Wachira Developers 2021. All Rights Reserved</p>
    </footer>";
}







?>