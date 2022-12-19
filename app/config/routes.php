<?php
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

$app->get('/', [\App\Controllers\PageController::class, 'index']);
$app->get('/jobs', [\App\Controllers\PageController::class, 'jobs']);
$app->get('/jobs/{id}', [\App\Controllers\PageController::class, 'job_details']);
$app->post('/job_handler', [\App\Controllers\PageController::class, 'job_handler']);