<?php

namespace App\Models;

use CodeIgniter\Model;

class HomeModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    #Clean Data
    public function cleanString($rawData)
    {
        return htmlspecialchars($rawData, ENT_QUOTES, 'UTF-8');
    }

    # Send Mail
    public function SendMailNotification($Nsubject, $Nemail, $Nname, $NmailMessage)
    {
        if (!filter_var($Nemail, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else if (filter_var($Nemail, FILTER_VALIDATE_EMAIL)) {
            $mail = \Config\Services::email();
            $to = 'nilebridgehotel@gmail.com';
            $mail->setTo($to);
            $mail->setSubject($Nsubject);
            $mail->setFrom('buzen.mailer@gmail.com', 'NILE BRIDGE HOTEL WEBSITE');

            #Custom message
            $body = "<b>Name</b>: " . $Nname . "<br/><b>Email</b>: " . $Nemail . "<br/>" . $NmailMessage;

            #Custom Template
            $template = view("frontend/home/email-template", [
                'name' => "Website Contact",
                'body' => $body
            ]);

            #Set Message
            $mail->setMessage($template);

            if ($mail->send()) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }
}