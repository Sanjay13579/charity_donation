<?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $donorName = $_POST['name'];
        
        echo'.$email';
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
        $mail->setFrom('sanjayb.ec21@bitsathy.ac.in', 'ENDEAVOURS CHARITY');
        $mail->addAddress($email);     // Add a recipient
        $status='mail sent';
        $charityName='ENDEAVOURS CHARITY';
    
        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = "Making Dreams Come True: Your Impactful Gift to ENDEAVOURS FOUNDATION";
        $mail->Body    = "<h3>Dear $donorName,</h3>

       <p> Greetings! I trust this message finds you well and in high spirits. I am writing to express our heartfelt appreciation for your recent donation to $charityName. Your generosity is a source of inspiration for all of us.<br>
        
        At $charityName, we are dedicated to providing healthcare access to vulnerable communities, promoting environmental conservation. It is because of kind-hearted individuals like you that we are able to move closer to realizing our vision of a better world.<br>
        
        Your donation not only contributes to the immediate needs of those we serve but also symbolizes a shared belief in the power of positive change. We are committed to utilizing your gift wisely and efficiently to bring about tangible improvements.<br>
        
        In recognition of your support, we will keep you updated on the impact your donation is creating. It's important to us that you can see firsthand the lives you are touching through your kindness.<br>
        
        Once again, thank you for your generosity and for being a beacon of hope for us. If you ever wish to visit our projects, have any questions, or want to be more involved, please feel free to contact us</p>
        
        <h4>Warm regards,<br> Admin,<br> CEO,<br> ENDEAVOURS CHARITY,<br>endeavourscharity@gmail.com.</h4>
        
       <p> P.S. Stay connected with us on social media handles to stay informed about the remarkable transformations you are helping us achieve!</p>";;

        $conn = new mySqli('localhost', 'root', '', 'signin');

        if($conn->connect_error) {
            die('Could not connect to the database.');
        }

        $verifyQuery = $conn->query("SELECT * FROM donation WHERE email = '$email'");

        if($verifyQuery->num_rows) {
            $codeQuery = $conn->query("UPDATE donation SET status = '$status' WHERE email = '$email'");   
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