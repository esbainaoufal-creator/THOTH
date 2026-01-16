<?php
require_once '../app/core/Router.php';
require_once '../app/controllers/HomeController.php';
require_once '../app/controllers/StudentController.php';

$router = new Router();
$router->run();
