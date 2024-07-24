<?php
$conn = new mysqli("localhost", "root", "", "signin");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to retrieve donation data
$sql = "SELECT city, SUM(amount) AS total_amount FROM donation GROUP BY city";
$result = $conn->query($sql);

$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = array($row["city"], (int)$row["total_amount"]);
    }
}

$conn->close();
echo json_encode($data);
?>
