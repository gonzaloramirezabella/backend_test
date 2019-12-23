<?php 

namespace App\Service;

class ShoutService {
    static public function shouted(string $string){
        $string = trim($string);
        if (strlen($string) == 0) return '';
        return strtoupper( self::checkLastCharacter($string) . '!');             
    }

    static private function checkLastCharacter($string){
        if (!ctype_alnum($string[-1])) {            
            return substr($string, 0, -1);
        }     
        return $string;       
    }

    
}