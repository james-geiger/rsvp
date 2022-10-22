<?php

namespace App\States\Response;

class Declined extends ResponseState
{
    
    public static $name = 'declined';

    public function display(): string
    {
        return 'Declined';
    }

    public function classes(): string
    {
        return '#';
    }
}
?>