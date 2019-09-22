<?php
//error_reporting(E_ALL);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception; 
require 'vendor/autoload.php';
function sendemail($toid,$subject,$message)
{
	
    $mail = new PHPMailer(true);                            
    try {
        //Server settings
        $mail->isSMTP();                                     
        $mail->Host = 'mail.secondopinion.co.in';                      
        $mail->SMTPAuth = true;                             
        $mail->Username = 'admin@secondopinion.co.in';     
        $mail->Password = 'admin@123';             
        $mail->SMTPOptions = array(
            'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
            )
        );                         
        $mail->SMTPSecure = 'tls';                           
        $mail->Port = 26;                                   

        //Send Email
        $mail->setFrom('admin@secondopinion.co.in');
        
        //Recipients
        $mail->addAddress($toid);                       
        $mail->addReplyTo('admin@secondopinion.co.in');
        
        //Content
        $mail->isHTML(true);                                  
        $mail->Subject = $subject;
        $mail->Body    = $message;

        $mail->send();
        
       //echo 'Message has been sent';
	   return 1;
       
    } catch (Exception $e) {
      //echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
	  return 0;
       
    }
}

function mailCheck($toid,$subject,$message)
{ 

	$mail = new PHPMailer(true);                            
    try {
        //Server settings
        $mail->isSMTP();                                     
        $mail->Host = 'mail.secondopinion.co.in';                      
        $mail->SMTPAuth = true;                             
        $mail->Username = 'admin@secondopinion.co.in';     
        $mail->Password = 'admin@123';             
        $mail->SMTPOptions = array(
            'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
            )
        );                         
        $mail->SMTPSecure = 'tls';                           
        $mail->Port = 26;                                   

        //Send Email
        $mail->setFrom('admin@secondopinion.co.in');
        
        //Recipients
        $mail->addAddress('saiprasad.b@thresholdsoft.com');              
        $mail->addReplyTo('admin@secondopinion.co.in');
        
        //Content
        $mail->isHTML(true);                                  
        $mail->Subject = $subject;
        $mail->Body    = $message;

        $mail->send();
        
       //echo 'Message has been sent';
       
    } catch (Exception $e) {
      //echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo;
       
    }
}


?>
