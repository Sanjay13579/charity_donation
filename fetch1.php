<?php 
    require_once("connection.php");

    // Add data to the table
    if(isset($_POST['add'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];

        $addQuery = "INSERT INTO details (name, email) VALUES ('$name', '$email')";
        mysqli_query($con, $addQuery);
         // Redirect to a different page to prevent form re-submission on refresh
        header("Location: users_list.php");
        exit(); // Make sure to exit after the redirection
    }



    $query = "SELECT * FROM details";
    $result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Example</title>
    <!-- ... (your existing head content) ... -->
</head>
<body class="bg-dark">
    <div class="container">
        <div class="row">
            <div class="col m-auto">
                <div class="card mt-5">
                    <form method="POST">
                        <div class="form-group">
                            <input type="text" name="name" placeholder="Name" required>
                            <input type="email" name="email" placeholder="Email" required>
                            <button type="submit" name="add">Add</button>
                        </div>
                    </form>
                    <table id="userTable" class="table table-bordered">
                        <tr>
                            <td> User id </td>
                            <td> User name </td>
                            <td> User email </td>
                            
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
                            
                        </tr>
                        <?php 
                            }  
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Include jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // Function to update table content using AJAX
        function updateTable() {
            $.ajax({
                url: "get_updated_data.php",
                success: function(data) {
                    $("#userTable").find("tr:gt(0)").remove(); // Remove all rows except header
                    $("#userTable").append(data); // Append new rows
                }
            });
        }

        // Call the updateTable function every 5 seconds (adjust as needed)
        setInterval(updateTable, 5000); // 5000 milliseconds = 5 seconds
    </script>
</body>
</html>
