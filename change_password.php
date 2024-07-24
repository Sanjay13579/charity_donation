<?php include 'change_password_process.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="change.css">

</head>
<body>
    <div class="container p-3  rounded-3" style="width: 40%;margin-top:270px;font-family: Arial, Helvetica, sans-serif;background-image: url('https://i.postimg.cc/Bny61rm1/istockphoto-1271787791-612x612.jpg');
    background-size: 2000px 1000px;">
        <h1 class="display-6 text-center p-2 bg-light">
            Change Password
        </h1>
        <form action="" method="post">
            <div class="row mb-3 justify-content-md-center"style="color:white";>
                <label for="inputEmail" class="col-4 col-form-label">Email</label>
                <div class="col-lg-auto">
                    <input type="email" placeholder="Enter your email id" name="email" id="inputEmail" class="form-control" required>
                </div>
            </div>
            <div class="row mb-3 justify-content-md-center"style="color:white";>
                <label for="inputPassword" class="col-4 col-form-label">New Password</label>
                <div class="col-lg-auto">
                    <input type="password" placeholder="Enter new password" name="new_password" id="inputPassword" class="form-control" required>
                </div>
            </div>
            <div class="row mb-3 justify-content-md-center">
                <div class="col-8">
                    <button type="submit" class="btn btn-primary" name="change"style="text-decoration:underline;">change</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>