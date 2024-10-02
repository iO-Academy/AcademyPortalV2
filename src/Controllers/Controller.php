<?php

namespace Portal\Controllers;

use Psr\Http\Message\ResponseInterface as Response;

class Controller
{
    protected function redirect(Response $response, string $url): Response
    {
        return $response->withHeader('Location', $url)->withStatus(301);
    }

    protected function redirectWithError(
        Response $response,
        string $url,
        string $message,
        string $key = 'error'
    ): Response {
        return $response->withHeader('Location', "$url?$key=$message")->withStatus(301);
    }
}
