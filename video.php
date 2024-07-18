<?php 
session_start();

include './database/Database.php';
$database = new Database();

$user = false;

if(isset($_SESSION['user'])){
    $user=$_SESSION['user'];
}

$vid_id=$_GET['id'];

$database->incrementAnimeViews($vid_id);

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


$anime=$database->get_anime_info($vid_id);

$anime_data = $database->get_anime_list();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video</title>
    <link rel="stylesheet" href="./style/video.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,500&display=swap" rel="stylesheet">
</head>
<body>

    <section class="container" id="darkbox"></section>  
    <section class="container" id="darkbox_menu" onclick="openBar()"></section>
    <?php include './components/register.php';?>
    <?php include './components/login.php';?>
    <?php include './components/navbar.php';?>
    <?php include './components/option.php';?>

     <section class="video_section">
        <div class="video_left">
            <video src="./uploads/videos/<?php echo $anime['location'] ?>" controls ></video>
        </div>

        <div class="video_right">

            <div class="onepiece">
                <img src="./uploads/images/<?php echo $anime['banner_loc'] ?>" >
            </div>   

            <h1><?php echo $anime['title'] ?></h1>

            <p> <?php echo $anime['description'] ?> </p>
            <p>Akaza is the best site to watch anime online.Even you can also  find Toei Animation anime on it.</p>  
        </div>

    </section>

    <section class="episodes">
        <div class="ep1">1</div>
        <div class="ep2">2</div>
    </section>

       
    <?php include './components/body.php';?>

    <?php include './components/footer1.php';?>

    <script src="./javascript/index.js"></script>
    
</body>
</html>