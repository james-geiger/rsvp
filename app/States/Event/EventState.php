<?php

namespace App\States\Event;

use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;

abstract class EventState extends State
{
    public static function config(): StateConfig
    {
        return parent::config()
            ->default(Draft::class)
            ->allowTransition(Draft::class, Published::class)
            ->allowTransition(Published::class, Draft::class)
        ;
    }
}

?>