<!DOCTYPE html>
<?php
    require_once './assets/php/conn.php';
    session_start();

    if(!ISSET($_SESSION['user'])){
		header('location:index.php');
	}

    $id = $_SESSION['user'];
    $sql = $conn->prepare("SELECT * FROM `user` WHERE `user_ID`='$id'");
    $sql->execute();
    $fetch = $sql->fetch();

    /* Updaten van de gebruiker */

    if(ISSET($_POST['user_update'])){
		if($_POST['email'] != ""){
			try{
                $email = $_POST['email'];
                $club = $_POST['club'];
                $team = $_POST['team'];
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "UPDATE user SET email='$email', club='$club', team='$team' WHERE user_ID='$id'";
				$conn->exec($sql);
			}catch(PDOException $e){
				echo $e->getMessage();
			}
			$_SESSION['message']=array("text"=>"Gebruiker succesvol geupdate!","alert"=>"info");
			$conn = null;
			header('location:my_profile.php');
            exit();
		}else{
			echo "
				<script>alert('Vul alle velden in!')</script>
				<script>window.location = 'my_profile.php'</script>
			";
		}
	}
?>
<?php error_reporting(0); ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./Assets/css/style.css">
    <title>Mijn Profiel | Voetbal Tracker</title>
    <link rel="icon" type="image" href="./assets/images/soccer_ball_icon.png">

    <script src="https://kit.fontawesome.com/1395c9ece5.js" crossorigin="anonymous"></script>
    <script src="./Assets/javascript/script.js"></script>
</head>

<body>
    <?php $page = 'login'; include './assets/php/header.php';?>

    <?php
        $id = $_SESSION['user'];
        $sql = $conn->prepare("SELECT * FROM `user` WHERE `user_ID`='$id'");
        $sql->execute();
        $fetch = $sql->fetch();
    ?>

    <section class="main">
        <div class="container">
            <div class="row">
                <div class="col-md-4 offset-md-5">
                    <h3 class="profile_name">
                        <strong><?php echo $fetch['name']?></strong></h3>
                </div>
            </div>
            <form method="POST" class="user_update_form">
                <div class="row">
                    <div class="col-md-4 offset-md-4">
                        <table>
                            <tr>
                                <td style="width: 40%;">E-mailadres</td>
                                <td><input type="text" name="email" class="input-white"
                                        value=<?php echo $fetch['email']?>></td>
                            </tr>
                            <tr>
                                <td>Club</td>
                                <td><input type="text" name="club" class="input-white"
                                        value=<?php echo $fetch['club']?>></td>
                            </tr>
                            <tr>
                                <td>Team</td>
                                <td><input type="text" name="team" class="input-white"
                                        value=<?php echo $fetch['team']?>></td>
                            </tr>
                            <tr>
                                <td><input type="hidden" name="user_ID" class="input-white"
                                    value=<?php echo $row['user_ID']?>></td>
                            </tr>
                        </table>
                        <div class="form-group">
                            <input type="submit" name="user_update" value="Update" class="form_update_button">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <?php include 'footer.php';?>
</body>

</html>