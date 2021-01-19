<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function



use App\Config\Emails;
use App\Content\Creative;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;


// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);
// Insrantiat emails class
$Emails = new Emails();
// Insrantiat Creative class
$Creative = new Creative();
// $email = "laruos2121@gmail.com";

// Retrieve the email template required
$message = file_get_contents('content/index.html');
// Rerieve the emails
$EmailArr = $Emails->GetEmails();


    try {
    $mail->SMTPOptions = [
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true,
        ]
    ];

    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'localhost';                    // Set the SMTP server to send through    
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'Admin@komiis.com';                     // SMTP username
    $mail->Password   = 'AJ7VHyoeNXibD1i3EBPNJA';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 1025;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('Admin@komiis.com', '=?UTF-8?B?RXhvZHVzRWZmZWN0?=');
    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    // $mail->Body =  $message;
    $mail->msgHTML($message);
    $mail->AltBody = strip_tags($message);

    foreach ($EmailArr as $email) {
        try {
            $mail->Subject = "Hi {$Creative->UsernameFromEmail($email)} =?UTF-8?B?VGhlIEV4b2R1cyBFZmZlY3Q=?=";
            $mail->addAddress($email);     // Add a recipient

            $mail->send(); // send to recipient

            $mail->ClearAllRecipients(); // Clear all the recipients
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}



