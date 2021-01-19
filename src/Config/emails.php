<?php
namespace App\Config;

Class Emails {

    public function GetEmails(){
        $emailsArr = array();
        $stream = fopen("../../Emails/emails.txt", "r");
        while(($line=fgets($stream))!==false) { array_push($emailsArr, $line); }
        return $emailsArr;
    }

}


?>
