<?php

namespace Portal\Controllers;

use Portal\Models\ApplicantsModel;
use Portal\Services\AuthService;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\PhpRenderer;

class ApplicantsPageController
{
    private PhpRenderer $renderer;
    private ApplicantsModel $applicantsModel;

    public function __construct(PhpRenderer $renderer, ApplicantsModel $applicantsModel)
    {
        $this->renderer = $renderer;
        $this->applicantsModel = $applicantsModel;
    }

    public function __invoke(Request $request, Response $response): Response
    {
        if (!AuthService::isLoggedIn()) {
            return $response->withHeader('Location', './')->withStatus(301);
        }

        $data = $request->getQueryParams();

        $page = $data['page'] ?? 1;

        $applicants = $this->applicantsModel->getAll($page);
        $applicantsTotalCount = $this->applicantsModel->getCount();

        return $this->renderer->render($response, 'applicants.phtml', [
            'applicants' => $applicants,
            'currentPage' => $page,
            'previousPage' => $page - 1,
            'nextPage' => $page + 1,
            'pageCount' => ceil($applicantsTotalCount / 20)
        ]);
    }
}
