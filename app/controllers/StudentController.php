<?php

class StudentController
{
    public function login()
    {
        require '../app/views/student/login.php';
    }

    public function register()
    {
        require '../app/views/student/register.php';
    }

    public function dashboard()
    {
        require '../app/views/student/dashboard.php';
    }
    public function loginPost()
    {
        if (
            empty($_POST['email']) ||
            empty($_POST['password'])
        ) {
            echo "Missing fields";
            return;
        }

        $studentModel = new Student();
        $student = $studentModel->authenticate(
            $_POST['email'],
            $_POST['password']
        );

        if (!$student) {
            echo "Invalid credentials";
            return;
        }

        session_start();
        $_SESSION['student_id'] = $student['id'];
        $_SESSION['student_name'] = $student['name'];

        header("Location: /lms/student/dashboard");
        exit;
    }
    
}
