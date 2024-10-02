<?php
declare(strict_types=1);

use App\Controllers\CoursesAPIController;
use Slim\App;
use Slim\Views\PhpRenderer;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $container = $app->getContainer();

    $app->get('/', \Portal\Controllers\LoginPageController::class);
    $app->post('/login', \Portal\Controllers\LoginActionController::class);

    $app->get('/admin', \Portal\Controllers\AdminPageController::class);
    $app->get('/admin/applicants', \Portal\Controllers\ApplicantsPageController::class);
    $app->get('/admin/applicants/{id}', \Portal\Controllers\ViewApplicantPageController::class);
};
