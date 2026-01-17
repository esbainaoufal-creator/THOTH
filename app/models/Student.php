<?php



require_once __DIR__ . '/../core/Database.php';

class Student
{
    private $db;

    public function __construct()
    {
        $this->db = new Database('localhost', 'thoth_lms', 'root', 'rif50'); // adjust credentials
    }

    public function create($name, $email, $password)
    {
        $stmt = $this->db->getConnection()->prepare(
            "INSERT INTO students (name, email, password) VALUES (:name, :email, :password)"
        );
        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':password' => password_hash($password, PASSWORD_DEFAULT)
        ]);
        return $this->db->getConnection()->lastInsertId();
    }

    public function findByEmail($email)
    {
        $stmt = $this->db->getConnection()->prepare("SELECT * FROM students WHERE email = :email");
        $stmt->execute([':email' => $email]);
        return $stmt->fetch();
    }
}

