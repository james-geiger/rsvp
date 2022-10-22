<?php

namespace App\States\Response;

class Pending extends ResponseState
{

    public static $name = 'pending';

    public function display(): string
    {
        return 'Pending';
    }

    public function classes(): string
    {
        return 'text-indigo-800 bg-indigo-100';
    }
}
?>