<?php
    if(isset($_POST['reset'])) {
        $email = $_POST['email'];
    }
    else {
        exit();
    }

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    require 'mail/Exception.php';
    require 'mail/PHPMailer.php';
    require 'mail/SMTP.php';
    
    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);
    
    try {
        //Server settings
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'sanjayb.ec21@bitsathy.ac.in';                     // SMTP username
        $mail->Password   = 'Sanjay@2003';                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
    
        //Recipients
        $mail->setFrom('sanjayb.ec21@bitsathy.ac.in', 'Admin');
        $mail->addAddress($email);     // Add a recipient

        $code = substr(str_shuffle('1234567890QWERTYUIOPASDFGHJKLZXCVBNM'),0,10);
    
        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Password Reset';
        $mail->Body    = 'To reset your password click <a href="http://localhost/details/change_password.php?code='.$code.'">here </a>. </br>Reset your password in 30 seconds.';

        $conn = new mySqli('localhost', 'root', '', 'signin');

        if($conn->connect_error) {
            die('Could not connect to the database.');
        }

        $verifyQuery = $conn->query("SELECT * FROM details WHERE email = '$email'");

        if($verifyQuery->num_rows) {
            $codeQuery = $conn->query("UPDATE details SET code = '$code' WHERE email = '$email'");   
            $mail->send();
            echo 'Message has been sent, check your email';
        }
        else
        {
            echo 'Please enter the regiestered email id ';
        }
        $conn->close();
    
    } catch (Exception $e) {
        echo "Message could not be sent. kindly enter a mail id | Mailer Error: {$mail->ErrorInfo}";
    }    
?>