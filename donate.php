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
    $full_name = $_POST["fullname"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $city = $_POST["city"];
    $zipcode = $_POST["zipcode"];
    $amount = $_POST["amount"];
    $donation_type= $_POST["individual"];
    $phone_number = $_POST["phone"];
    $payment_mode = $_POST["mode"];
    $country = $_POST["country"];
    // Insert data into the database
    $sql = "INSERT INTO donation (fullname, email, address, city, zipcode, amount, individual, phone, mode, country,pay_status)
            VALUES ('$full_name', '$email', '$address', '$city', '$zipcode', '$amount', '$donation_type', '$phone_number', '$payment_mode', '$country','success')";
    if ($conn->query($sql) === TRUE) {
        echo "Donation data saved successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

