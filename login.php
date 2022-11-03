<?php
	session_start();

	require_once './assets/php/conn.php';

    /* Controlere van de gegevens van de gebruiker gebruiker */

	if(ISSET($_POST['login'])){
		if($_POST['email'] != "" || $_POST['password'] != ""){
			$username = $_POST['email'];
            $password = md5($_POST['password']);
            $recaptcha = $_POST['g-recaptcha-response'];
			$sql = "SELECT * FROM `user` WHERE `email`=? AND `password`=? ";
			$query = $conn->prepare($sql);
			$query->execute(array($username, $password));
			$row = $query->rowCount();
			$fetch = $query->fetch();
			if($row > 0) {
				$_SESSION["email"] = $fetch["email"];
				$_SESSION['user'] = $fetch['user_ID'];
                $recaptcha = $_POST['g-recaptcha-response'];
                $secret_key = 'your_secret_key';
                $url = 'https://www.google.com/recaptcha/api/siteverify?secret='
                        . $secret_key . '&response=' . $recaptcha;
                $response = file_get_contents($url);
                $response = json_decode($response);
				header("location: ./my_profile.php");
			} else{
				echo "
				<script>alert('Ongeldigde e-mail of wachtwoord')</script>
				<script>window.location = './index.php'</script>
				";
			}
		}else{
			echo "
				<script>alert('Vul alle velden in alsjeblieft')</script>
				<script>window.location = './index.php'</script>
			";
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Inloggen | Voetbal Tracker</title>
    <link rel="icon" type="image" href="./assets/images/soccer_ball_icon.png">
    
    <script src="https://kit.fontawesome.com/1395c9ece5.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php $page = 'login'; include './assets/php/header.php';?>

    <section class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-6 user_form">
                    <h3>Inloggen Voetbal Tracker</h3>
                    <?php if(isset($_SESSION['message'])): ?>
                    <div class="alert alert-<?php echo $_SESSION['message']['alert'] ?> msg">
                        <?php echo $_SESSION['message']['text'] ?>
                    </div>
                    <script>
                        (function () {
                            setTimeout(function () {
                                document.querySelector('.msg').remove();
                            }, 3000)
                        })();
                    </script>
                    <?php 
                        endif;
                        // clearing the message
                        unset($_SESSION['message']);
                    ?>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="text" id="email" name="email" placeholder="E-mailadres" required>
                        </div>
                        <div class="form-group">
                            <input type="password" id="password" name="password" placeholder="Wachtwoord" required>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" onclick="showPassword()">
                            <label for="showPassword"> Laat wachtwoord zien</label>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="login" value="Login" class="form_button">
                        </div>
                    </form>
                    <div class="row login_options">
                        <div class="col-sm-6 offset-md-3">
                            <p>Nog geen account? <a href="./register.php">Registreer hier!</a></p>
                            <p>Admin login? <a href="./adminlogin.php">Login hier!</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include './assets/php/footer.php';?>

    <script src="./assets/javascript/script.js"></script>
</body>
</html>