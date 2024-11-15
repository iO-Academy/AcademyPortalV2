<?php
declare(strict_types=1);

use App\Controllers\CoursesAPIController;
use Slim\App;

return function (App $app) {
    $container = $app->getContainer();

    $app->get('/', \Portal\Controllers\Pages\LoginPageController::class);
    $app->post('/login', \Portal\Controllers\FormActions\LoginActionController::class);

    $app->get('/admin', \Portal\Controllers\Pages\AdminPageController::class);
    $app->get('/admin/applicants', \Portal\Controllers\Pages\ApplicantsPageController::class);
    $app->get('/admin/applicants/{id}', \Portal\Controllers\Pages\SingleApplicantPageController::class);
    $app->get('/admin/courses', \Portal\Controllers\Pages\CoursesPageController::class);
    $app->get('/admin/courses/add', \Portal\Controllers\Pages\AddCoursePageController::class);
    $app->post('/admin/courses/add', \Portal\Controllers\FormActions\AddCourseActionController::class);
    $app->get('/admin/cohorts', \Portal\Controllers\Pages\CohortsPageController::class);
};
