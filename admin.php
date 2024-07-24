<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="assets/css/admin.css">
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="logo-apple"></ion-icon>
                        </span>
                        <span class="title">Endeavors charity</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">Customers</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="chatbubble-outline"></ion-icon>
                        </span>
                        <span class="title">Messages</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="help-outline"></ion-icon>
                        </span>
                        <span class="title">Help</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="settings-outline"></ion-icon>
                        </span>
                        <span class="title">Settings</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="lock-closed-outline"></ion-icon>
                        </span>
                        <span class="title">Password</span>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- ========================= Main ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <div class="search">
                    <label>
                        <input type="text" placeholder="Search here">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>

                <div class="user">
                    <img src="assets/imgs/customer01.jpg" alt="">
                </div>
          </div>
     
                 <!-- ======================= Cards ================== -->
                 <div class="cardBox">
                     <div class="card">
                         <div>
                             <div class="numbers"><span id="userID"></span></div>
                             <div class="cardName">NO OF USERS</div>
                         </div>
     
                         <div class="iconBx">
                             <ion-icon name="eye-outline"></ion-icon>
                         </div>
                     </div>
     
                     <div class="card">
                         <div>
                             <div class="numbers"><span id="id"></span></div>
                             <div class="cardName">No of Donations</div>
                         </div>
     
                         <div class="iconBx">
                             <ion-icon name="cart-outline"></ion-icon>
                         </div>
                     </div>
                     <div class="card">
                         <div>
                             <?php
                             include 'analytics.php'
                             ?>
                             <div class="numbers"><?php echo $totalDonations;?></div>
                             <div class="cardName">amount</div>
                         </div>
     
                         <div class="iconBx">
                             <ion-icon name="cash-outline"></ion-icon>
                         </div>
                     </div>
                 
                     <div class="card">
                         <div>
                             <div class="numbers"><span id="qid"></span></div>
                             <div class="cardName">Queries</div>
                         </div>
     
                         <div class="iconBx">
                             <ion-icon name="chatbubbles-outline"></ion-icon>
                         </div>
                     </div>
                 </div>
                 <!-- ================ Order Details List ================= -->
                 <div class="details">
    <div class="recentOrders">
        <div class="cardHeader">
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

                $query = "SELECT * FROM donation";
                $result = mysqli_query($conn, $query);
            ?>
            <h2>Recent Orders</h2>
            <a href="#" class="btn">View All</a>
        </div>

        <table>
            <thead>
                <tr>
                    <td>ID</td>
                    <td>NAME</td>
                    <td>DONATION</td>
                    <td>Status</td>
                </tr>
            </thead>
            <tbody>
                <?php
                while($row = mysqli_fetch_assoc($result)) {
                    $UserID = $row['id'];
                    $UserName = $row['fullname'];
                    $UserEmail = $row['amount'];
                    $status= $row['pay_status']
                ?>
                <tr>
                    <td><?php echo $UserID ?></td>
                    <td><?php echo $UserName ?></td>
                    <td><?php echo $UserEmail ?></td>
                    <td><span class="status delivered"><?php echo $status ?></span></td>
                </tr>        
                <?php 
                }  
                ?>
            </tbody>
        </table>
    </div>


   



                <!-- ================= New Customers ================ -->
         <div class="recentCustomers">
            <div class="cardHeader">
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
                 
                     $query = "SELECT * FROM details";
                     $result = mysqli_query($conn, $query);
                      ?>
                        <h2>Recent Customers</h2>
                    </div>
            <table>
            <thead>
                <tr>
                    <th >ID</th>
                    <th>NAME</th>
                    <th>E mail</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while($row = mysqli_fetch_assoc($result)) {
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
            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- partial -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    function updateLatestData(data) {
        $("#userID").text(data.ID);
    }

    function fetchLatestData() {
        $.ajax({
            url: 'latest.php', // Replace with your PHP script URL
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                updateLatestData(data);
            },
            error: function(xhr, status, error) {
                console.log("AJAX Error: " + status + " - " + error);
            }
        });
    }

    $(document).ready(function() {
        fetchLatestData();
        setInterval(fetchLatestData, 5000); // Fetch every 5 seconds
    });
   </script>
     <!--donationlatest-->
    <script>
    function updatelatestData(data) {
        $("#id").text(data.id);
    }

    function fetchlatestData() {
        $.ajax({
            url: 'latestdonation.php', // Replace with your PHP script URL
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                updatelatestData(data);
            },
            error: function(xhr, status, error) {
                console.log("AJAX Error: " + status + " - " + error);
            }
        });
    }

    $(document).ready(function() {
        fetchlatestData();
        setInterval(fetchlatestData, 5000); // Fetch every 5 seconds
    });
   </script>
   <!--queries-->
   <script>
    function updatelatestdata(data) {
        $("#qid").text(data.id);
    }

    function fetchlatestdata() {
        $.ajax({
            url: 'latestqueries.php', // Replace with your PHP script URL
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                updatelatestdata(data);
            },
            error: function(xhr, status, error) {
                console.log("AJAX Error: " + status + " - " + error);
            }
        });
    }

    $(document).ready(function() {
        fetchlatestdata();
        setInterval(fetchlatestData, 5000); // Fetch every 5 seconds
    });
   </script>
   </body>

</html>