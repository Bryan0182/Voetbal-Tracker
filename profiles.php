<!DOCTYPE html>
<?php
    require './assets/php/conn.php';
    
    session_start();

    if(!ISSET($_SESSION['user'])){
		header('location:login.php');
	}

    /* Ophalen van de session */

    $id = $_SESSION['user'];
    $sql = $conn->prepare("SELECT * FROM `user` WHERE `user_ID`='$id'");
    $sql->execute();
    $fetch = $sql->fetch();

    /* Updaten van de gebruiker */

    if(ISSET($_POST['user_update'])){
		if($_POST['goals'] != ""){
			try{
                $goals = $_POST['goals'];
				$assists = $_POST['assists'];
                $club = $_POST['club'];
                $team = $_POST['team'];
                $user_ID = $_POST['user_ID'];
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "UPDATE user SET goals='$goals', assists='$assists', club='$club', team='$team' WHERE user_ID='$user_ID'";
				$conn->exec($sql);
			}catch(PDOException $e){
				echo $e->getMessage();
			}
			$_SESSION['message']=array("text"=>"Gebruiker succesvol geupdate!","alert"=>"info");
			$conn = null;
			header('location:profiles.php');
            exit();
		}else{
            exit();
			echo "
				<script>alert('Vul alle velden in!')</script>
				<script>window.location = 'profiles.php'</script>
			";
		}
	}

    /* Verwijderen van de gebruiker */
    
    if(ISSET($_POST['user_delete'])){
		try{
            $user_ID = $_POST['user_ID'];
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "DELETE FROM user WHERE user_ID='$user_ID'";
			$conn->exec($sql);
		}catch(PDOException $e){
			echo $e->getMessage();
		}
		$_SESSION['message']=array("text"=>"Hond succesvol verwijderd!","alert"=>"info");
		$conn = null;
		header('location:profiles.php');
        exit();
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
    <title>Profielen | Voetbal Tracker</title>
    <link rel="icon" type="image" href="./Assets/images/Dinder_small_logo.png">

    <script src="https://kit.fontawesome.com/1395c9ece5.js" crossorigin="anonymous"></script>
    <script src="./Assets/javascript/script.js"></script>
</head>

<body>
    <?php  $page = 'profiles'; include './assets/php/header.php';?>

    <?php
        $id = $_SESSION['user'];
        $sql = $conn->prepare("SELECT * FROM `user` WHERE `user_ID`='$id'");
        $sql->execute();
        $fetch = $sql->fetch();
    ?>

    <section class="main">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-8">
                <?php
                $stmt = $conn->prepare("SELECT * FROM `user` WHERE `user_ID` = '$id'");
                $stmt->execute();
                $fetch = $stmt->fetch();
                ?>
                <?php
                    $sql = "SELECT user_ID, name, goals, assists, club, team FROM user";

                    try{
                        $stmt = $conn->query($sql);
                        
                        if($stmt === false){
                        die("Error");
                        }
                        
                    }catch (PDOException $e){
                        echo $e->getMessage();
                    }
                ?>
            <table>
                <thead>
                    <tr>
                        <th style="width: 250px;">Naam</th>
                        <th style="width: 100px;">Goals</th>
                        <th style="width: 100px;">Assists</th>
                        <th style="width: 150px;">Club</th>
                        <th style="width: 100px;">Team</th>
                        <th style="width: 100px;">Update</th>
                        <th style="width: 250px;">Verwijderen</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                    <tr>
                        <td><?php echo ($row['name']); ?></td>
                        <form method="POST" class="user-update-form">
                            <td><input type="number" min="0" style="width: 50px;" name="goals" class="user-input-purple"
                            value=<?php echo $row['goals']?>></td>
                            <td><input type="number" min="0" style="width: 50px;" name="assists" class="user-input-purple"
                            value=<?php echo $row['assists']?>></td>
                            <td><input type="text" style="width: 75px;" name="club" class="user-input-purple"
                            value=<?php echo $row['club']?>></td>
                            <td><input type="text" style="width: 75px;" name="team" class="user-input-purple"
                            value=<?php echo $row['team']?>></td>
                            <td><input type="submit" name="user_update" value="Update" class="user_update_button"></td>
                            <input type="hidden" name="user_ID" class="user-input-purple"
                                    value=<?php echo $row['user_ID']?>>
                        </form>
                        <td>
                            <form method="POST" class="user-delete-form">
                                <input type="submit" name="user_delete" value="Verwijderen" class="user_delete_button">
                                <input type="hidden" name="user_ID" class="user-input-purple"
                                    value=<?php echo $row['user_ID']?>>
                            </form>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
                </div>
            </div>
        </div>
    </section>

    <?php include 'footer.php';?>
</body>

</html>