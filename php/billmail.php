<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//required files
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if (isset($_POST["send"])) {

  $mail = new PHPMailer(true);

    //Server settings
    $mail->isSMTP();                              //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';       //Set the SMTP server to send through
    $mail->SMTPAuth   = true;             //Enable SMTP authentication
    $mail->Username   = 'gaglanijeet@gmail.com';   //SMTP write your email
    $mail->Password   = 'hvthptqfwjnadkbq';      //SMTP password
    $mail->SMTPSecure = 'ssl';            //Enable implicit SSL encryption
    $mail->Port       = 465;                                    

    //Recipients
    $mail->setFrom($_POST["email"], $_POST["name"]); // Sender Email and name
    $mail->addAddress('gaglanijeet@gmail.com');     //Add a recipient email  
    $mail->addReplyTo($_POST["email"], $_POST["name"]); // reply to sender email

    //Content
    $mail->isHTML(true);               //Set email format to HTML
    $mail->Subject = "Thank you for your purchase!";   // email subject headings

    // Email body
    $message = "Dear Jeet Gaglani,\n\nThank you for your recent purchase with ADS VIZION! 
    We truly appreciate your business and the trust you've placed in us. As a token of our appreciation, 
    we have attached the invoice for your purchase. Please take a moment to review it.
    \n\nIf you have any questions or concerns about your purchase, please don't hesitate to contact our customer 
    service team at infoadsvizion@gmail.com. We're here to help!\n\nOnce again, thank you for choosing ADS VIZION. 
    We look forward to serving you again in the future.\n\nBest regards,\nDhaval Maru\nTechnical Head\nADS VIZION";

    $mail->Body = $message;

    // Attachment
    $invoice_file = "invoice.pdf"; // Path to your invoice PDF
    $mail->addAttachment($invoice_file, "invoice.pdf"); 

    try {
        // Success sent message alert
        $mail->send();
        echo

        //the name of the invoice pdf will be attached in the below mentioned script and make sure that this file lies in the same directory
        
        " 
        <script> 
         alert('Message was sent successfully!');
         document.location.href = 'index.php'; 
        </script>
        ";

    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

