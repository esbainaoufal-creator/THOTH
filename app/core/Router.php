<?php

require_once "../app/controllers/HomeController.php";
require_once "../app/controllers/StudentController.php";

class Router
{
    public function run()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $uri = parse_url($uri, PHP_URL_PATH);

        // strip project folder if your LMS is in /lms
        $uri = str_replace('/lms', '', $uri);

        if ($uri === '/' || $uri === '/index.php') {
            $controller = new HomeController();
            $controller->index();
        } elseif ($uri === '/login') {
            $controller = new StudentController();
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller->loginPost();
            } else {
                $controller->login();
            }
        } elseif ($uri === '/register') {
            $controller = new StudentController();
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $controller->registrationPost();
            } else {
                $controller->registration();
            }
        } elseif ($uri === '/dashboard') {
            $controller = new StudentController();
            $controller->dashboard();
        } else {
            echo '404 - Page Not Found';
        }
    }
}
