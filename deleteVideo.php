<?php


$conn = new mysqli("localhost", "root", "", "akaza");


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_GET['vid_id'])) {
   
    $vid_id = $_GET['vid_id'];

   
    $sql = "DELETE FROM anime_list WHERE vid_id = ?";
    $stmt = $conn->prepare($sql);

   
    $stmt->bind_param("i", $vid_id);
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
