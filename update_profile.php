<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["user_id"])) {
    $new_name = $_POST["name"];
    $new_email = $_POST["email"];
    
    $conn = new mysqli("localhost", "root", "", "signin");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $user_id = $_SESSION["user_id"];
    
    // Update name and email
    $sql = "UPDATE details SET name = '$new_name', email = '$new_email' WHERE id = '$user_id'";
    
    if ($conn->query($sql) === TRUE) {
        // Update the session variables with new data
        $_SESSION["user_name"] = $new_name;
        $_SESSION["user_email"] = $new_email;

        if (!empty($_FILES["profile_photo"]["name"])) {
            $target_dir = "profile_photos/";
            $file_name = basename($_FILES["profile_photo"]["name"]);
            $target_path = $target_dir . $file_name;
    
            // Move the uploaded file to the target directory
            if (move_uploaded_file($_FILES["profile_photo"]["tmp_name"], $target_path)) {
                // Update the database with the new profile photo path
                $sql = "UPDATE details SET profile_photo = '$target_path' WHERE id = '$user_id'";
                if ($conn->query($sql) === TRUE) {
                    echo "Profile photo uploaded successfully.";
                } else {
                    echo "Error updating profile photo: " . $conn->error;
                }
            } else {
                echo "Error uploading profile photo.";
            }
        }

        header("location: profile.php");  // Redirect back to the profile page
        exit;
    } else {
        echo "Error updating profile: " . $conn->error;
    }

    $conn->close();
}
?>
