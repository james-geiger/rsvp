<?php

namespace App\States\Event;

class Draft extends EventState
{

    public static $name = 'draft';

    public function display(): string
    {
        return 'Draft';
    }

	public function public(): bool
	{
		return false;
	}

}
?>