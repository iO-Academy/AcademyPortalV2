<?php

namespace Portal\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * Controllers can extend this class to access some helpful redirection methods.
 */
abstract class Controller
{

    abstract public function __invoke(Request $request, Response $response): Response;

    protected function redirect(Response $response, string $url): Response
    {
        return $response->withHeader('Location', $url)->withStatus(301);
    }

    /**
     * Redirects with an error appended as a query string
     */
    protected function redirectWithError(
        Response $response,
        string $url,
        string $message,
        string $key = 'error'
    ): Response {
        return $response->withHeader('Location', "$url?$key=$message")->withStatus(301);
    }
}
