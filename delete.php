<?php
require_once("connection.php");

if(isset($_GET['delete'])) {
    $deleteID = $_GET['delete'];

    $deleteQuery = "DELETE FROM details WHERE ID = '$deleteID'";
    mysqli_query($con, $deleteQuery);

    header("Location: your_page.php"); // Redirect back to the main page
} else {
    echo "Invalid request.";
}
?>
