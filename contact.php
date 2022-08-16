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
<body class="contact-page-body">
    <?php createNav(); ?>

    <div class="contact-page-main-container">
        <div class="contact-page-container">
            <div class="contact-page-left">
                <iframe class="contact-page-map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63820.97542252294!2d36.78798491327864!3d-1.2875431445550025!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f197f307b02fd%3A0xce5866289d9a257e!2sBurger%20King%20Lavington!5e0!3m2!1sen!2ske!4v1625431239393!5m2!1sen!2ske" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>

            <div class="contact-page-right">
                <h1>CONTACT US</h1>
                <div class="contact-page-socials-list">
                    <div class="contact-page-social">
                        <img src="images/call.svg" alt="Call icon">
                        <p>0722333444</p>
                    </div>
                    <div class="contact-page-social">
                        <img src="images/email.svg" alt="Email icon">
                        <p>theburgerplace@gmail.com</p>
                    </div>
                    <div class="contact-page-social">
                        <img src="images/facebook.svg" alt="Facebook icon">
                        <p>The Burger Place</p>
                    </div>
                    <div class="contact-page-social">
                        <img src="images/instagram.svg" alt="Instagram icon">
                        <p>@burgerplaceke</p>
                    </div>
                    <div class="contact-page-social">
                        <img src="images/twitter.svg" alt="Twitter icon">
                        <p>@burgerplaceke</p>
                    </div>
                </div>
                
                <div class="contact-page-details">
                    <div class="contact-page-detail-item">
                        <input class="input" type="email" name="email" id="email" placeholder="Your E-mail">
                    </div>
                    <div class="contact-page-detail-item">
                        <input class="input" type="text" name="name" id="name" placeholder="Full Name">
                    </div>
                    <div class="contact-page-detail-item">
                        <textarea class="contact-page-message" name="message" id="message" cols="40" rows="4" placeholder="Your Message"></textarea>
                    </div>
                    <div>
                        <a href="#"><button class="cta contact-page-cta">Submit Form</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <?php createFooter(); ?>
    
</body>
</html>