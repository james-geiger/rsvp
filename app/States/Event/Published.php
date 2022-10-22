<?php

namespace App\States\Event;

class Published extends EventState
{

    public static $name = 'published';

    public function display(): string
    {
        return 'Published';
    }

	public function public(): bool
	{
		return true;
	}
	
}
?>