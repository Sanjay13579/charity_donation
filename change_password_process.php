<?php
    if(isset($_GET['code'])) {
        $code = $_GET['code'];

        $conn = new mySqli('localhost', 'root', '', 'signin');
        if($conn->connect_error) {
            die('Could not connect to the database');
        }

        $verifyQuery = $conn->query("SELECT * FROM details WHERE code = '$code' and updated_time >= DATE_SUB(NOW(), INTERVAL 30 SECOND)");


        if($verifyQuery->num_rows == 0) {
            header("Location: index.html");
            exit();
        }

        if(isset($_POST['change'])) {
            $email = $_POST['email'];
            $new_password = password_hash($_POST["new_password"], PASSWORD_DEFAULT);

            $changeQuery = $conn->query("UPDATE details SET password = '$new_password' WHERE email = '$email' and code = '$code' and updated_time >= DATE_SUB(NOW(), INTERVAL 30 SECOND");

            if($changeQuery) {
                header("Location: success.html");
            }
        }
        $conn->close();
    }
    else {
        header("Location: index.html");
        exit();
    }
?>
