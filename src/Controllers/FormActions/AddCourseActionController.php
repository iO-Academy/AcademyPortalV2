<?php

namespace Portal\Controllers\FormActions;

use Exception;
use Portal\Controllers\Controller;
use Portal\Models\CoursesModel;
use Portal\Services\AuthService;
use Portal\Validators\CourseValidator;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AddCourseActionController extends Controller
{
    private CoursesModel $coursesModel;
    private AuthService $authService;

    public function __construct(CoursesModel $coursesModel, AuthService $authService)
    {
        $this->coursesModel = $coursesModel;
        $this->authService = $authService;
    }

    public function __invoke(Request $request, Response $response): Response
    {
        if (!$this->authService->isLoggedIn()) {
            return $this->redirect($response, '/');
        }

        $courseData = $request->getParsedBody();

        try {
            CourseValidator::validate($courseData);
        } catch (Exception $e) {
            return $this->redirectWithError($response, '/admin/courses/add', $e->getMessage());
        }

        $courseAdded = $this->coursesModel->create(
            $courseData['name'],
            $courseData['shortName'],
            $courseData['remote'] ?? 0
        );

        if (!$courseAdded) {
            return $this->redirectWithError($response, '/admin/courses/add', 'Unexpected Error - try again');
        }

        return $this->redirect($response, '/admin/courses');
    }
}
