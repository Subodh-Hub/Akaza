<?php
session_start();
include './database/Database.php';
$database = new Database();
$user = false;

if(isset($_SESSION['user'])){
    $user=$_SESSION['user'];
}


if (isset($_GET['genre']) && !empty($_GET['genre'])) {
    $selectedGenre = $_GET['genre'];
    $anime_data = $database->get_anime_list_by_genre($selectedGenre);
} else {
   
    $anime_data = $database->get_anime_list();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Genre</title>
    <link rel="stylesheet" href="./style/index.css">
</head>
<body>  
    <section class="container" id="darkbox"></section>
    <section class="container" id="darkbox_menu" onclick="openBar()"></section>
    <?php include './components/register.php';?>
    <?php include './components/login.php';?>
    <?php include './components/navbar.php';?>
    <?php include './components/option.php';?>

    <section class="genre_list">

    <div class="genre1">
        <form action="" method="get">

        <label for="">Choose Genre:</label>
            <select name="genre" class="select" onchange="this.form.submit()">
                <option value="All" <?php if(isset($_GET['genre']) && $_GET['genre'] == 'All') echo 'selected'; ?>>All</option>
                <option value="Action" <?php if(isset($_GET['genre']) && $_GET['genre'] == 'Action') echo 'selected'; ?>>Action</option>
                <option value="Romance" <?php if(isset($_GET['genre']) && $_GET['genre'] == 'Romance') echo 'selected'; ?>>Romance</option>
                <option value="Comedy" <?php if(isset($_GET['genre']) && $_GET['genre'] == 'Comedy') echo 'selected'; ?>>Comedy</option>
                <option value="Sports" <?php if(isset($_GET['genre']) && $_GET['genre'] == 'Sports') echo 'selected'; ?>>Sports</option>
                <option value="Mystery" <?php if(isset($_GET['genre']) && $_GET['genre'] == 'Mystery') echo 'selected'; ?>>Mystery</option>
            </select>
        </form>


    </div>
</section>



<section class="anime1" id="animeContainer">
    <?php 
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $search_query = $_POST["search_query"];
        
        $anime_data = $database->get_anime_list_by_search($search_query);
    }

    foreach ($anime_data as $anime): ?>
        <a href="video.php?id=<?php echo $anime['vid_id'] ?>">
            <div class="anime_card1"> 
                <div class="card_img">
                    <img src="./uploads/images/<?php echo $anime['banner_loc']; ?>">
                </div>
                <div>
                    <h1><?php echo $anime['title']; ?></h1>
                </div>
            </div>
        </a>
    <?php endforeach; ?>
</section>

    <?php include './components/footer.php';?>

    <script src="./javascript/index.js"></script>
    
</body>
</html>