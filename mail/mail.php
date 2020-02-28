<?php
    error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
    require_once "phpmailer/class.phpmailer.php";


    function sendMail($toMail,$subject,$message){
            
        //$message = 'Hello World';
                
        // creating the phpmailer object
        $mail = new PHPMailer(true);

        // telling the class to use SMTP
        $mail->IsSMTP();

        // enables SMTP debug information (for testing) set 0 turn off debugging mode, 1 to show debug result
        $mail->SMTPDebug = 0;

        // enable SMTP authentication
        $mail->SMTPAuth = true;

        // sets the prefix to the server
        $mail->SMTPSecure = 'ssl';

        // sets GMAIL as the SMTP server
        $mail->Host = 'smtp.gmail.com';

        // set the SMTP port for the GMAIL server
        $mail->Port = 465;

        // your gmail address
        $mail->Username = 'nitcreg@gmail.com';

        // your password must be enclosed in single quotes
        $mail->Password = 'Sac@nitc12';

        // add a subject line
        $mail->Subject = $subject;

        // Sender email address and name
        $mail->SetFrom('nitcreg@gmail.com', 'Admin NITC Guest House');

        // reciever address, person you want to send
        $mail->AddAddress($toMail);

        // if your send to multiple person add this line again
        //$mail->AddAddress('tosend@domain.com');

        // if you want to send a carbon copy
        //$mail->AddCC('tosend@domain.com');


        // if you want to send a blind carbon copy
        //$mail->AddBCC('tosend@domain.com');

        // add message body
        $mail->MsgHTML($message);


        // add attachment if any
        //$mail->AddAttachment('time.png');

        try {
                // send mail
                $mail->Send();
                $msg = "Mail send successfully";
            } catch (phpmailerException $e) {
                $msg = $e->getMessage();
            } catch (Exception $e) {
                $msg = $e->getMessage();
        }

        return $msg;
    }

?>