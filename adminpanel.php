<?php


$servername = "localhost"; // Change this to your MySQL server name
$username = "root"; // Change this to your MySQL username
$password = ""; // Change this to your MySQL password
$database = "akaza"; // Change this to your MySQL database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT vid_id, title, description, banner_loc, production_name, genre FROM anime_list";
$result = $conn->query($sql);


$sql = "SELECT user_id, username, password, email FROM users";
$resultuser = $conn->query($sql);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $title = $_POST["title"];
    $genre = $_POST["genre"];
    $productionName = $_POST["production"];
    $description = $_POST["description"];

    // Handle file uploads
    $videoFileName = $_FILES["video_file"]["name"];
    $imageFileName = $_FILES["image_file"]["name"];

    // Move uploaded files to desired location
    $videoFilePath =  basename($videoFileName);
    $imageFilePath =  basename($imageFileName);
    move_uploaded_file($_FILES["video_file"]["tmp_name"],"uploads/videos/". $videoFilePath);
    move_uploaded_file($_FILES["image_file"]["tmp_name"],"uploads/images/". $imageFilePath);

    // Database connection (similar to the previous code)
    // ...

    // SQL query to insert data into the database with file names
    $sql = "INSERT INTO anime_list (title, description, location, banner_loc, Production_Name, Genre) VALUES (?, ?, ?, ?, ?, ?)";


       // Prepare the SQL statement
       $stmt = $conn->prepare($sql);

       // Bind parameters with values and data types
       $stmt->bind_param("ssssss", $title, $description, $videoFilePath, $imageFilePath, $productionName, $genre);

       if ($stmt->execute()) {
        // echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the prepared statement and database connection
    $stmt->close();
    $conn->close();

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="./style/adminpanel.css">
    
</head>
<body>
     <div class="panel">

        <section class="adPanel">
            <div class="logo">
                    <img src="./images/logo.jpg" >
                    <p>Akaza</p>
            </div>

            <div class="logout"> <a href="adminlogin.php">Log Out </a></div>
        </section>


         <div class="main">

        <section class="div">

            <div class="adAdmin" onclick="openAdd()">
                Admin
            </div>

            <div class="adUser" onclick="openUsers()">
                Users
            </div>


        
            <div class="adVideo" onclick="openAnime()">
                Animes
            </div>

        </section>


        <section class="user" id="user">

            <div class="us1">
                User Details
            </div>

        <div class="us4">

        <table width="100%" border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Password</th>
            <th>Email</th>
        </tr>

        <?php
        // Loop through the fetched data and generate table rows
        while ($row = $resultuser->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['user_id'] . "</td>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>" . $row['password'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "</tr>";
        }
        ?>

    </table>


        </div>

        </section>

        <section class="anime" id="anime">

            <div class="anime1">
                Anime Details
            </div>

            
        <div class="anime4">

        
    <table width="100%" border="1">
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Info</th>
            <th>Delete</th>
            
            
        </tr>

        <?php
while ($row = $result->fetch_assoc()):
?>
<tr>
    <td><?= $row['vid_id'] ?></td>
    <td><img class="img" src="./uploads/images/<?= $row['banner_loc'] ?>"></td>
    <td>
        <form action="editVideo.php" method="post">
            <input type="hidden" name="vid_id" value="<?= $row['vid_id'] ?>">
            <input type="text" name="title" value="<?= $row['title'] ?>">
            <input type="text" name="genre" value="<?= $row['genre'] ?>">
            <input type="text" name="production_name" value="<?= $row['production_name'] ?>">
            <input type="submit" value="Edit">
        </form>
    </td>

    <td>
        
        <a style="margin-left:60px;" href="deleteVideo.php?vid_id=<?= $row['vid_id'] ?>"><img style="width:25px;height:30px;" class="img2" src="./images/delete.png"></a>
    </td>
</tr>
<?php
endwhile;
?>





    </table>


        </div>

        </section>

        <section class="add" id="add">
            <form action="" method="post" enctype="multipart/form-data">

            
                <label id="title" >Title:</label>
                <input type="text" name="title"> <br>
            
                <label id="genre ">Genre:</label>
                <select name="genre">
                    <option value="Action">Action</option>
                    <option value="Romance">Romance</option>
                    <option value="Sports">Sports</option>
                    <option value="Mystery">Mystery</option>
                    <option value="Comedy">Comedy</option>
                    
                </select>

                <label id="name">Production_Name:</label>
                <input type="text" name="production"><br>

                <label id="video">video File:</label>
                <input type="file" name="video_file"><br>

                <label id="image">Image File</label>
                <input type="file" name="image_file">

                <label id="desc">Description:</label>
                <textarea name="description" cols="30" rows="10"></textarea>

                <input type="submit" value="Add" name="add">
            </form>
        </section>

        </div>

    </div>  
    
    <script src="./javascript/option.js"></script>
    
    
</body>
</html>