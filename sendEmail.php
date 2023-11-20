<?php
global $mysqli;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';


// fcunctie de trimitere invitatie prin email
function sendEmail($to, $subject, $message)
{
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'localhost';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'root';
        $mail->Password   = '';
        $mail->SMTPSecure = 'tls'; // Enable TLS encryption; 'ssl' also accepted
        $mail->Port       = 587; // TCP port to connect to


        // Recipients
        $mail->setFrom('your_email@example.com', 'Your Name');
        $mail->addAddress($to);

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $message;

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

// Get the event ID from the URL parameter
$eventID = $_GET['id'];

// Fetch the email addresses from the database for all users
include("conectare.php");

$emails = array();

if ($result = $mysqli->query("SELECT email FROM users"))
{
    while ($row = $result->fetch_assoc())
    {
        $emails[] = $row['email'];
    }

    $result->free();
}

$mysqli->close();

// Compose the email subject and body
$subject = "Invitation to Event";
$message = "You are invited to the event with ID: $eventID. Please join us!";

// Send email to each user
foreach ($emails as $email)
{
    sendEmail($email, $subject, $message);
}

echo "Invitations sent successfully!";
?>