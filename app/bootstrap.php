<?php
use Slim\Factory\AppFactory;
use DI\Container;

require BASE_DIR . 'vendor/autoload.php';
require BASE_DIR . 'src/Core/functions.php';

$container = new Container();

AppFactory::setContainer($container);
$app = AppFactory::create();

//if (SLIM_APP_BASEPATH) $app->setBasePath(SLIM_APP_BASEPATH);

ORM::configure('mysql:host=localhost;dbname=job_board');
ORM::configure('username', 'root');
ORM::configure('password', '');

require BASE_DIR . 'app/config/container.php';
require BASE_DIR . 'app/config/settings.php';
require BASE_DIR . 'app/config/middleware.php';
require BASE_DIR . 'app/config/errorMiddleware.php';
require BASE_DIR . 'app/config/routes.php';

$app->run();