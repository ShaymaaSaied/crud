<?php
require_once('vendor/autoload.php');


use Pecee\SimpleRouter\SimpleRouter;
use App\Code\AppRouter;
use App\Core\App;

#-- call app bootstrap
$app = new App();
$app->bootstrap();

#-- Call Routes
AppRouter::init();
AppRouter::callRoutes();
SimpleRouter::start();
