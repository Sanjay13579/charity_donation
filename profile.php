
<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("location: test.html");
    exit;
}

$user_id = $_SESSION["user_id"];
$user_name = $_SESSION["user_name"];
$user_email = $_SESSION["user_email"];
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
</head>
<body>
    <h1>User Profile</h1>
    <p><strong>ID:</strong> <?php echo $user_id; ?></p>
    <p><strong>Name:</strong> <?php echo $user_name; ?></p>
    <p><strong>Email:</strong> <?php echo $user_email; ?></p>
    <a href="edit_profile.php">edit</a>
    <a href="logout.php">Logout</a>
    <!-- Add more profile information as needed -->
</body>
</html>