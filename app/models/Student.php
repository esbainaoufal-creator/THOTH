<?php

class Student
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function findByEmail($email)
    {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM students WHERE email = :email LIMIT 1"
        );
        $stmt->execute(['email' => $email]);
        return $stmt->fetch();
    }

    public function create($name, $email, $password)
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->pdo->prepare(
            "INSERT INTO students (name, email, password)
             VALUES (:name, :email, :password)"
        );

        return $stmt->execute([
            'name' => $name,
            'email' => $email,
            'password' => $hash
        ]);
    }

    public function authenticate($email, $password)
    {
        $student = $this->findByEmail($email);

        if (!$student) {
            return false;
        }

        if (!password_verify($password, $student['password'])) {
            return false;
        }

        return $student;
    }
    
}
