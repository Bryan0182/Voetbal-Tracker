<div class="mobile_menu">
    <div class="topnav">
        <div id="myLinks">
            <a class="<?php if($page== 'home'){echo 'mobile_active';} ?>" href="index.php">Home</a>
            <a class="<?php if($page== 'profielen'){echo 'mobile_active';} ?>" href="profielen.php">Profielen</a>
            <a class="<?php if($page== 'login'){echo 'mobile_active';} ?>" href="login.php">Login</a>
        </div>
        <a href="javascript:void(0);" class="icon" onclick="mobileMenu()">
            <i class="fa fa-bars"></i>
        </a>
    </div>
</div>
<header class="otherheader">
    <div class="desktop_menu otherheader">
        <div class="logo">
            <a href="index.php"><img src="./assets/images/soccer_ball_icon.png" alt="" class="menu-logo"></a>
        </div>
        <div class="menu">
            <ul>
                <li><a class="<?php if($page== 'home'){echo 'active';} ?>" href="index.php"><i
                            class="fa-solid fa-house"></i> Home</a></li>
                <li><a class="<?php if($page== 'profielen'){echo 'active';} ?>" href="profielen.php"><i
                            class="fa-solid fa-users"></i> Profielen</a></li>
            </ul>
        </div>
        <div class="right_menu">
            <ul>
                <?php if (isset($_SESSION['user']) === true) : ?>
                <?php
                    $id = $_SESSION['user'];
                    $sql = $conn->prepare("SELECT * FROM `user` WHERE `user_ID`='$id'");
                    $sql->execute();
                    $fetch = $sql->fetch();
                ?>
                <div class="dropdown">
                    <li><button class="dropbtn"><i class="fa-solid fa-user"></i>
                            <?php echo "Welkom " . $fetch['name']?>
                            <i class="fa fa-caret-down"></i></button>
                        <div class="dropdown-content">
                            <a href="my_profile.php">Mijn profiel</a>
                            <a href="../../php/logout.php">Uitloggen</a>
                        </div>
                    </li>
                </div>
                    <?php else : ?>
                    <li><a class="<?php if($page== 'login'){echo 'active';} ?>" href="<?= ('index.php') ?>"><i
                                class="fa-solid fa-lock-open"></i> Login</a></li>
                    <li><a class="<?php if($page== 'registreer'){echo 'active';} ?>" href="<?= ('register.php') ?>"><i
                                class="fa-solid fa-key"></i> Registreer</a></li>
                    <?php endif; ?>
            </ul>
        </div>
    </div>
</header>