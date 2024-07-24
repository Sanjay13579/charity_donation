<?php 
require_once("connection.php");
// Delete data from the table
if(isset($_GET['delete'])) {
    $deleteID = $_GET['delete'];

    $deleteQuery = "DELETE FROM details WHERE ID = '$deleteID'";
    mysqli_query($con, $deleteQuery);
}

$query = "SELECT * FROM details";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- ... (your existing head content) ... -->
</head>
<body class="bg-dark">
    <div class="container">
        <div class="row">
            <div class="col m-auto">
                <div class="card mt-5">
                    <table id="userTable" class="table table-bordered">
                        <tr>
                            <td> User id </td>
                            <td> User name </td>
                            <td> User email </td>
                            <td> Actions </td>
                        </tr>
                        <?php 
                            while ($row = mysqli_fetch_assoc($result)) {
                                $UserID = $row['ID'];
                                $UserName = $row['name'];
                                $UserEmail = $row['email'];
                        ?>
                        <tr>
                            <td><?php echo $UserID ?></td>
                            <td><?php echo $UserName ?></td>
                            <td><?php echo $UserEmail ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $UserID ?>">Edit</a>
                                <a href="?delete=<?php echo $UserID ?>">Delete</a>
                            </td>
                        </tr>
                        <?php 
                            }  
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
