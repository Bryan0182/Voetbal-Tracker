<?php
	session_start();

	require_once './assets/php/conn.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Home | Voetbal Tracker</title>
    <link rel="icon" type="image" href="./assets/images/soccer_ball_icon.png">
    
    <script src="https://kit.fontawesome.com/1395c9ece5.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php $page = 'home'; include './assets/php/header.php';?>

    <section class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-6 user_form">
                    <h3>Voetbal Tracker</h3>
                    <p>Gebruiker nu de Voetbal TRacker, de website om alles van voetbal bij te houden!</p>
                </div>
            </div>
        </div>
    </section>

    <?php include './assets/php/footer.php';?>

    <script src="./assets/javascript/script.js"></script>
</body>
</html>