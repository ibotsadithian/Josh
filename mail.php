<?php

require 'PHPMailer-master/PHPMailerAutoload.php';


$fromEmail = 'nandhagopal4920@mail.com';
$fromName = 'Josh Trust Contact Form';

$sendToEmail = 'nandhagopal4920@mail.com';
$sendToName = 'Josh Trust Contact Form';

$subject = 'New message from Joshian.in contact form';

$fields = array('name' => 'Name', 'phone' => 'Phone', 'email' => 'Email', 'batch' => 'Batch', 'subject' => 'Subject', 'message' => 'Message');

$okMessage = 'We have received your inquiry. Stay tuned, we’ll get back to you very soon.';

$errorMessage = 'There was an error while submitting the form. Please try again later';

error_reporting(E_ALL & ~E_NOTICE);

try
{
    
    if(count($_POST) == 0) throw new \Exception('Form is empty');
    
    $emailTextHtml .= "<table>";
    
    foreach ($_POST as $key => $value) {
        if (isset($fields[$key])) {
            $emailTextHtml .= "<tr><th>$fields[$key]</th><td>$value</td></tr>";
        }
    }
    $emailTextHtml .= "</table>";
    
    $mail = new PHPMailer;
    
    $mail->setFrom($fromEmail, $fromName);
    $mail->addAddress($sendToEmail, $sendToName); 
    $mail->AddCC('nandhagopal04092000@gmail.com', 'Josh Trust Contact Form');
    $mail->addReplyTo($from);
    
    $mail->isHTML(true);
    
    $mail->Subject = $subject;
    $mail->msgHTML($emailTextHtml); 
    
    
    if(!$mail->send()) {
        throw new \Exception('I could not send the email.' . $mail->ErrorInfo);
    }
    
    $responseArray = array('type' => 'success', 'message' => $okMessage);
}
catch (\Exception $e)
{
     $responseArray = array('type' => 'danger', 'message' => $e->getMessage());
}

if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $encoded = json_encode($responseArray);
    
    header('Content-Type: application/json');
    
    echo $encoded;
}

else {
    //   header('Location: ../contact.php');

   $message = "We have received your inquiry. Stay tuned, we’ll get back to you very soon !!";

    
     
}
   
   ?>



<?php
if(isset($_POST['submit'])){
  
    echo "<div class='woocommerce-message grve-woo-message grve-bg-red' role='alert'>".$message."</div>";
}

?>