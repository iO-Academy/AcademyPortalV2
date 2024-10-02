<?php

namespace Portal\Controllers;

use Portal\Models\ApplicantsModel;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\PhpRenderer;

class ViewApplicantPageController
{
    private PhpRenderer $renderer;
    private ApplicantsModel $applicantsModel;

    public function __construct(PhpRenderer $renderer, ApplicantsModel $applicantsModel)
    {
        $this->renderer = $renderer;
        $this->applicantsModel = $applicantsModel;
    }

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $id = $args['id'];

        $applicant = $this->applicantsModel->getById($id);

        return $this->renderer->render($response, 'singleApplicant.phtml', ['applicant' => $applicant]);
    }
}
