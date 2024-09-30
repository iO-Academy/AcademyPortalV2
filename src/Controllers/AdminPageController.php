<?php

namespace Portal\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\PhpRenderer;

class AdminPageController
{
    private PhpRenderer $renderer;

    public function __construct(PhpRenderer $renderer)
    {
        $this->renderer = $renderer;
    }


    public function __invoke(Request $request, Response $response): Response
    {
        return $this->renderer->render($response, 'admin.phtml');
    }
}