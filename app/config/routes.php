<?php
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

$app->get('/', [\App\Controllers\PageController::class, 'index']);
$app->get('/jobs', [\App\Controllers\PageController::class, 'jobs']);