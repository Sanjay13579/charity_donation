<?php
// Establish a database connection
$servername = "localhost";
$username = "root"; // Replace with your database username
$password = "";     // Replace with your database password
$dbname = "signin"; // Replace with your database name

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: ".$conn->connect_error);
}

// Process form data when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name1"];
    $email = $_POST["email1"];
    $subject = $_POST["subject1"];
    $message = $_POST["message1"];
    
    $insert_query = "INSERT INTO queries (name,email, subject,message) VALUES ('$name', '$email', '$subject','$message')";
        if ($conn->query($insert_query) === true) {
            echo "<script>setTimeout(\"location.href = 'message.html';\",10);</script>";
            exit();
        } else {
            echo "Error: " . $insert_query . "<br>" . $conn->error;
        }
    }
// Close the database connection
$conn->close();
?>
