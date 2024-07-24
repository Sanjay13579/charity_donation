<?php
require_once("connection.php");

if(isset($_GET['id'])) {
    $userID = $_GET['id'];
    $query = "SELECT * FROM details WHERE ID = '$userID'";
    $result = mysqli_query($con, $query);

    if(mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        $name = $row['name'];
        $email = $row['email'];
    } else {
        echo "User not found.";
        exit();
    }
} else {
    echo "Invalid request.";
    exit();
}

if(isset($_POST['update'])) {
    $newName = $_POST['name'];
    $newEmail = $_POST['email'];

    $updateQuery = "UPDATE details SET name = '$newName', email = '$newEmail' WHERE ID = '$userID'";
    mysqli_query($con, $updateQuery);

    header("Location: your_page.php"); // Redirect back to the main page
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <!-- ... (your existing head content) ... -->
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col m-auto">
                <div class="card mt-5">
                    <form method="POST">
                        <div class="form-group">
                            <input type="text" name="name" value="<?php echo $name; ?>" required>
                            <input type="email" name="email" value="<?php echo $email; ?>" required>
                            <button type="submit" name="update">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
