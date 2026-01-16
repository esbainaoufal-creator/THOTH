<?php

class Router
{
    public function run()
    {

        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri = str_replace('/lms', '', $uri);


        if ($uri === '/' || $uri === '') {
            (new HomeController())->index();
            return;
        }

        if ($uri === '/login') {
            (new StudentController())->login();
            return;
        }

        if ($uri === '/register') {
            (new StudentController())->register();
            return;
        }

        if ($uri === '/student/dashboard') {
            (new StudentController())->dashboard();
            return;
        }

        echo '404';
    }
}
