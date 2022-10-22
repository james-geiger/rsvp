<?php

namespace App\States\Response;

use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;

abstract class ResponseState extends State
{
    public static function config(): StateConfig
    {
        return parent::config()
            ->default(Pending::class)
			->allowTransition(Pending::class, Pending::class)
			->allowTransition(Accepted::class, Accepted::class)
			->allowTransition(Declined::class, Declined::class)
            ->allowTransition(Pending::class, Accepted::class, PendingToAccepted::class)
            ->allowTransition(Pending::class, Declined::class, PendingToDeclined::class)
            ->allowTransition(Declined::class, Accepted::class, DeclinedToAccepted::class)
            ->allowTransition(Accepted::class, Declined::class, AcceptedToDeclined::class)
        ;
    }
}

?>