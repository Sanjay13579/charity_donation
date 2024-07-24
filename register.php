<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // Connect to the database
    $conn = new mysqli("localhost", "root", "", "signin");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the email already exists
    $check_query = "SELECT email FROM details WHERE email = '$email'";
    $check_result = $conn->query($check_query);
    if ($check_result->num_rows > 0) {
        echo "email already exists. Please choose a different email.You are being redirected to Sign up";
        echo "<script>setTimeout(\"location.href = 'index.html';\",1800);</script>";
    } else {
        // Insert user data into the table
        $insert_query = "INSERT INTO details (name,email, password) VALUES ('$name', '$email', '$password')";
        if ($conn->query($insert_query) === true) {
            echo "Congratulations:  Registration successful. You are being redirected to Sign in";
            echo "<script>setTimeout(\"location.href = 'index.html';\",1500);</script>";
            exit();
        } else {
            echo "Error: " . $insert_query . "<br>" . $conn->error;
        }
    }

    $conn->close();
}
?>
