<?php
// // Check if form is submitted
// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['vid_id'])) {
//     // Get form data
//     $vid_id = $_POST['vid_id'];
//     $title = $_POST['title'];
//     $genre = $_POST['genre'];
//     $production_name = $_POST['production_name'];

//     // Establish database connection
//     $conn = new mysqli("localhost", "root", "", "akaza");

//     // Check the connection
//     if ($conn->connect_error) {
//         die("Connection failed: " . $conn->connect_error);
//     }

//     // Prepare SQL statement to update the record
//     $sql = "UPDATE anime_list SET title=?, genre=?, production_name=? WHERE vid_id=?";
//     $stmt = $conn->prepare($sql);

//     // Bind parameters and execute the statement
//     $stmt->bind_param("sssi", $title, $genre, $production_name, $vid_id);
//     $stmt->execute();

//     // Close the prepared statement and database connection
//     $stmt->close();
//     $conn->close();

//     // Redirect back to the original page after update
//     header("Location: adminpanel.php");
//     exit();
// } else {
//     // Redirect to an error page if form is not submitted correctly
//     header("Location: error_page.php");
//     exit();
// }




if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_get['vid_id'])) {
    // Get form data
    $vid_id = $_POST['vid_id'];
    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $production_name = $_POST['production_name'];

    
    $conn = new mysqli("localhost", "root", "", "akaza");

 
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    
    $sql = "UPDATE anime_list SET title=?, genre=?, production_name=? WHERE vid_id=?";
    $stmt = $conn->prepare($sql);

    
    $stmt->bind_param("sssi", $title, $genre, $production_name, $vid_id);
    $stmt->execute();

   
    $stmt->close();
    $conn->close();

    
    header("Location: adminpanel.php");
    exit();
} else {
    
    header("Location: error_page.php");
    exit();
}
?>
