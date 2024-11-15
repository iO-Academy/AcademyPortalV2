<?php

namespace Portal\Controllers\FormActions;

use Exception;
use Portal\Controllers\Controller;
use Portal\Models\UsersModel;
use Portal\Services\AuthService;
use Portal\ValueObjects\EmailAddress;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class LoginActionController extends Controller
{
    private UsersModel $usersModel;
    private AuthService $authService;

    public function __construct(UsersModel $usersModel, AuthService $authService)
    {
        $this->usersModel = $usersModel;
        $this->authService = $authService;
    }

    public function __invoke(Request $request, Response $response): Response
    {
        $body = $request->getParsedBody();

        try {
            $email = new EmailAddress($body['email']);
        } catch (Exception $e) {
            return $this->redirectWithError($response, '/', $e->getMessage(), 'email_error');
        }

        $user = $this->authService->authenticate($email, $body['password']);

        if (!$user) {
            return $this->redirectWithError($response, '/', "Email or password is incorrect");
        }

        $this->authService->login($user);

        return $this->redirect($response, '/admin');
    }
}
