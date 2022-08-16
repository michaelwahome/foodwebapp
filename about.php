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
<body class="about-body">
    <?php createNav(); ?>

    <div class="about-container">
        <h1>About Us</h1>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur eu lacinia elit. Phasellus ipsum risus, dignissim a sapien vitae, volutpat efficitur sapien. Praesent vehicula cursus libero, vitae fermentum neque lobortis at. Ut interdum diam at orci tincidunt, non varius sem suscipit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Suspendisse neque purus, laoreet id ultricies ac, vulputate sed urna. Duis cursus luctus lectus, non dignissim dui semper id. Fusce bibendum purus eget mauris varius lobortis. Morbi posuere ac lacus eu tempor. In tincidunt magna vel venenatis luctus. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Nulla tempor nunc in sagittis commodo. Mauris euismod massa lacinia blandit cursus. Vivamus pretium imperdiet rutrum. In semper purus sapien, non euismod justo ultrices in.

            Vestibulum eget accumsan ex, quis dignissim diam. Vestibulum tincidunt leo sapien, non scelerisque ex eleifend quis. Fusce sed purus lectus. Donec ullamcorper semper tortor eu posuere. In ultricies ante id mauris mollis, vel blandit eros euismod. Vestibulum eu felis at orci hendrerit elementum. Integer accumsan diam nec tellus cursus, tempor tempus elit posuere.
        </p>
    </div>
    
    <?php createFooter(); ?>
    
</body>
</html>