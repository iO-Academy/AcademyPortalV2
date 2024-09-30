<?php

namespace Portal\Controllers;

use Portal\Models\UsersModel;
use Portal\Services\AuthService;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class LoginActionController
{
    private UsersModel $usersModel;

    public function __construct(UsersModel $usersModel)
    {
        $this->usersModel = $usersModel;
    }


    public function __invoke(Request $request, Response $response): Response
    {
        $errorMessage = "Email or password is incorrect";

        $body = $request->getParsedBody();

        $email = $body['userEmail'];
        $password = $body['password'];

        $user = $this->usersModel->getByEmail($email);

        if (!$user) {
            return $response->withHeader('Location', "./?error=$errorMessage")->withStatus(301);
        }

        if (!password_verify($password, $user['password'])) {
            return $response->withHeader('Location', "./?error=$errorMessage")->withStatus(301);
        }

        AuthService::login();

        return $response->withHeader('Location', "./admin")->withStatus(301);
    }

}