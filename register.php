<?php
	session_start();
	require_once './assets/php/conn.php';

    /* Gegevens registreren in de database */

	if(ISSET($_POST['register'])){
		if($_POST['name'] != "" || $_POST['email'] != "" || $_POST['password'] != ""){
			try{
				$name = $_POST['name'];
				$email = $_POST['email'];
				$password = md5($_POST['password']);
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "INSERT INTO `user` VALUES ('', '$name', '', '', '', '', '$email', '$password')";
				$conn->exec($sql);
			}catch(PDOException $e){
				echo $e->getMessage();
			}
			$_SESSION['message']=array("text"=>"Gebruiker succesvol aangemaakt!","alert"=>"info");
			$conn = null;
			header('location:index.php');
		}else{
			echo "
				<script>alert('Vul alle velden in!')</script>
				<script>window.location = 'register.php'</script>
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="./Assets/css/style.css">
    <title>Registreren | Voetbal Tracker</title>
    <link rel="icon" type="image" href="./Assets/images/Dinder_small_logo.png">

    <script src="https://kit.fontawesome.com/1395c9ece5.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php $page = 'registreer'; include './assets/php/header.php';?>

    <section class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-6 user_form">
                    <h3>Registreren Voetbal Tracker</h3>
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="text" id="name" name="name" placeholder="Naam" required>
                        </div>
                        <div class="form-group">
                            <input type="email" id="email" name="email" placeholder="E-mailadres" required>
                        </div>
                        <div class="form-group">
                            <input type="password" id="password" name="password" placeholder="Wachtwoord" required>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" onclick="showPassword()">
                            <label for="showPassword"> Laat wachtwoord zien</label>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="register" value="Registreer" class="form_button">
                        </div>
                    </form>
                    <div class="row login_options">
                        <div class="col-sm-6 offset-md-3">
                            <p>Heb je al een account? <a href="./index.php">Login hier!</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include './assets/php/footer.php';?>

    <script src="./Assets/javascript/script.js"></script>
</body>

</html>