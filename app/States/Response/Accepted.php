<?php

namespace App\States\Response;

class Accepted extends ResponseState
{

    public static $name = 'accepted';

    public function display(): string
    {
        return 'Accepted';
    }

    public function classes(): string
    {
        return 'text-yellow-800 bg-yellow-100';
    }
}
?>