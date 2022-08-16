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
<body>
    <?php createNav(); ?>

    <main>
        <section id="hero">
        <div class="hero-left">
            <h1>Hungry? We have just the thing!</h1>
            <h2>Try out our world-class burgers now</h2>
            <?php if(isset($_SESSION["username"])){ ?>
                <a href="menu.php"><button class ="cta order-now-cta">Order Now!</button></a>
            <?php } else { ?>
                <a href="login.php"><button class ="cta order-now-cta">Order Now!</button></a>
            <?php } ?>
        </div>
        <div class="hero-img">
            <img src="images/burger.jpg" alt="Burger">
        </div>
        </section>

        <section id ="benefits">
            <h2>Why come to The Burger Joint?</h2>
            <div class="benefits-div">
                <div class="benefit-card">
                    <p>Each and every burger is hand-made with care</p>
                </div>
                <div class="benefit-card">
                    <p>Our menu offers tons of options to choose from</p>
                </div>
                <div class="benefit-card">
                    <p>We have very fast and professional service</p>
                </div>
            </div>
        </section>

        <section id="reviews">
            <h2>But don't take our word for it. Ask them!</h2>
            <div class="reviews">
                <div class="review-card">
                    <div class="review-photo"><img src="images/Trevor.jpg" alt="Trevor"></div>
                    <p>"The king size is a must have."</p>
                    <p>~Trevor M.</p>
                </div>
                <div class="review-card">
                    <div class="review-photo"><img src="images/Faith.jpg" alt="Faith"></div>
                    <p>"I loved the service. Big thumbs up!"</p>
                    <p>~Faith N.</p>
                </div>
                <div class="review-card">
                    <div class="review-photo"><img src="images/Andrew.jpg" alt="Andrew"></div>
                    <p>"The food was amazing. I can't wait to go back."</p>
                    <p>~Andrew K.</p>
                </div>
            </div>
        </section>

        <section id="misc">
            <div class="misc-container">
                <div class="contact-left">
                    <h2>Contact Us</h2>
    
                    <form class="contact-form">
                        <label for="email">Email</label>
                        <input type="text" id="email" name="email" placeholder="Email">
    
                        <label for="message">Message</label>
                        <textarea name="message" id="message" cols="30" rows="10" placeholder="Write your message here"></textarea>
    
                        <input type="submit" class="cta contact-form-cta" value="Get in touch"> 
                    </form>

                </div>

                <div class="contact-right">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d63820.97542252294!2d36.78798491327864!3d-1.2875431445550025!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f197f307b02fd%3A0xce5866289d9a257e!2sBurger%20King%20Lavington!5e0!3m2!1sen!2ske!4v1625431239393!5m2!1sen!2ske" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </section>
    </main>

    <?php createFooter(); ?>
    
</body>
</html>