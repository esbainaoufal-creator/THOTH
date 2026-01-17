<?php
require_once __DIR__ . '/../models/Student.php';
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

        header("Location: /lms/dashboard");
        exit;
    }
    public function registration()
    {
        require '../app/views/student/register.php';
    }

    public function registrationPost()
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $studentModel = new Student();
        $studentModel->create($name, $email, $password);

        header("Location: /lms/login");
        exit;
    }
    
}
