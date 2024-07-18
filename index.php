<?php
session_start();
include './database/Database.php';
$database= new Database();
$user = false;

if(isset($_SESSION['user'])){
    $user=$_SESSION['user'];
}

$anime_data = $database->get_anime_list();

$top_anime = $database->getTopAnime();


if (isset($_POST['submit'])) {
    if ($_POST['submit'] == "login") {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = $database->check_user($username, $password);

        $_SESSION['user']=$username;

    }

    if ($_POST['submit'] == "register") {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm_password'];

        if ($password !== $confirmPassword) {
            echo  "<script>alert('Error: Passwords do not match')</script>";
            
            
        }

        $registration_successful = $database->register_user($username, $email, $password);

        if ($registration_successful) {
            
            echo "<script>alert('Registered')</script>";
            
        } else {
            
            echo "<script>alert('Registration fail')</script>";
        }
    }

}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akaza</title>
    <link rel="stylesheet" href="./style/index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,500&display=swap" rel="stylesheet">
</head>

<body>
    <section class="container" id="darkbox" ></section>
    <section class="container" id="darkbox_menu" onclick="openBar()"></section>
    <?php include './components/register.php';?>
    <?php include './components/login.php';?>
    <?php include './components/navbar.php';?>
    <?php include './components/option.php';?>
    

    <section class="video_section">
        <div class="video_left">
            <video src="./assets/Aka.mp4" loop autoplay muted ></video>
        </div>

        <div class="video_right">

            <div class="nav1">
                <h1> Top Anime </h1>
            </div>

            <div class="top_list">
            <div>
                <?php foreach ($top_anime as $index => $anime): ?>
                    <div class="top<?= $index + 1 ?>">
                        <div class="num<?= $index + 1 ?>">
                            <?= $index + 1 ?>
                        </div>
                        <a href="video.php?id=<?= $anime['vid_id'] ?>"><img src="./uploads/images/<?= $anime['banner_loc'] ?>" ></a>
                        <div class="pag<?= $index + 1 ?>">
                            <h2><?= $anime['title'] ?></h2>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
                
        </div>
        </div>

    </section>

    <section class="updated">
            <h1>Recently Updated</h1>
    </section>

    <?php include './components/body.php';?>
    
    <?php include './components/footer.php';?>

    <script src="./javascript/index.js"></script>

    

</body>
</html>