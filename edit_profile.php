<!-- edit_profile.php -->
<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("location: test.html");
    exit;
}

$user_id = $_SESSION["user_id"];
$user_name = $_SESSION["user_name"];
$user_email = $_SESSION["user_email"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Perform data validation and update the user's profile data
    // Update the session variables if needed
    // Redirect back to the profile page
    include 'update_profile.php';
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
</head>
<body>
    <h1>Edit Profile</h1>
    <form method="post" action="">
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo $user_name; ?>"><br>
        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo $user_email; ?>"><br>
        <!-- Add more profile fields as needed -->
        <input type="submit" value="Save">
    </form>
    <a href="profile.php">Back to Profile</a>
</body>
</html>
