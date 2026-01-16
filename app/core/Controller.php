<?php

class Controller
{
    protected function view($view, $data = [])
    {
        extract($data);
        require "../app/views/" . $view . ".php";
    }

    protected function redirect($path)
    {
        header("Location: /lms/login");
exit;
    }
}
