<?php 
namespace App\Content;

class Creative 
{

    public function UsernameFromEmail($email) {
        $s = explode("@",$email);
        array_pop($s); #remove last element.
        $s = implode($s);
        return $s;
    }
}

?>

