<?php
declare(strict_types=1);

use Slim\App;

return function (App $app) {
    $container = $app->getContainer();

    $app->get('/', \Portal\Controllers\Pages\LoginPageController::class);
    $app->post('/login', \Portal\Controllers\FormActions\LoginActionController::class);
    $app->get('/admin', \Portal\Controllers\Pages\AdminPageController::class);

    $app->get('/admin/courses', \Portal\Controllers\Pages\CoursesPageController::class);
    $app->get('/admin/courses/add', \Portal\Controllers\Pages\AddCoursePageController::class);
    $app->post('/admin/courses/add', \Portal\Controllers\FormActions\AddCourseActionController::class);
    $app->get('/admin/cohorts', \Portal\Controllers\Pages\CohortsPageController::class);

    $app->get('/admin/applicants', \Portal\Controllers\Pages\ApplicantsPageController::class);
    $app->get('/admin/applicants/add', \Portal\Controllers\Pages\AddApplicantPageController::class);
    $app->get('/admin/applicants/{id}', \Portal\Controllers\Pages\SingleApplicantPageController::class);
    $app->post('/admin/applicants/add', \Portal\Controllers\FormActions\AddApplicantActionController::class);
    $app->get('/admin/applicants/edit/{id}', \Portal\Controllers\Pages\EditApplicationPageController::class);
    $app->post('/admin/applicants/edit/{id}', \Portal\Controllers\FormActions\EditApplicantActionController::class);
    $app->post('/admin/applicants/archive/{id}', \Portal\Controllers\FormActions\ArchiveApplicantActionController::class);

    $app->get('/admin/archive', \Portal\Controllers\Pages\ArchivePageController::class);
};
