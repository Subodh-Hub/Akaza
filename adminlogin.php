<?php
include './database/Database.php';

if(isset($_POST['login'])){
    $db = new Database(); 

    $adminName = $_POST['AdminName'];
    $adminPassword = $_POST['AdminPassword'];

    $query = "SELECT * FROM `admin_login` WHERE `Admin_Name`=? AND `ADMIN_PASSWORD`=?";
    $stmt = $db->connection->prepare($query);
    $stmt->bind_param("ss", $adminName, $adminPassword);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows == 1){
        $_SESSION['AdminLoginId'] = $adminName;
        header("location: adminpanel.php");
        exit;
    } else {
        echo "<script>alert('Incorrect Password');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="./style/admin.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,500&display=swap" rel="stylesheet">
</head>
<body>
    <form action="" method="POST">
        
        <div class="admin">
            <img src="./images/logo.jpg">

            <div class="admin1">
                <h2>ADMIN PANEL</h2>
                <p>Control Panel Login</p>
            </div>

            <div class="admin2">
                <img src="./images/user_icon.png" >
                <input type="text" name="AdminName" id="username" required>
            </div>
           
            <div class="admin3">
                <img src="./images/password_icon.png">
                <input type="password" name="AdminPassword" id="pass" required>
            </div>
            
            <button type="submit" name="login">Login</button>
        </div>
    </form>

</body>
</html>