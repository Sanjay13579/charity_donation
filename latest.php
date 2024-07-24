<?php
// Replace with your database connection code
$con = mysqli_connect("localhost", "root", "", "signin");

$query = "SELECT * FROM details ORDER BY ID DESC LIMIT 1";
$result = mysqli_query($con, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    $latestData = array(
        'ID' => $row['ID'],
        // Add more fields as needed
    );

    header('Content-Type: application/json');
    echo json_encode($latestData);
} else {
    echo json_encode(array('error' => 'No data found'));
}

mysqli_close($con);
?>
