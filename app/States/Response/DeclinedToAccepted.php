<?php

namespace App\States\Response;

use Spatie\ModelStates\Transition;

use App\Models\Response;

class DeclinedToAccepted extends Transition
{
    private Response $response;

    private string $message;

    public function __construct(Response $response, string $message)
    {
        $this->response = $response;

        $this->message = $message;
    }

    public function handle(): Response
    {
        $this->response->response_state = new Accepted($this->response);
        $this->response->response_date = now();
        $this->response->response_message = $this->message;

        $this->response->save();

        return $this->response;
    }
}

?>