<?php 
    require_once("connection.php");
    $query = "SELECT * FROM details";
    $result = mysqli_query($con, $query);
?>

<?php while ($row = mysqli_fetch_assoc($result)): ?>
    <tr>
        <td><?php echo $row['ID']; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['email']; ?></td>
        
    </tr>
<?php endwhile; ?>
