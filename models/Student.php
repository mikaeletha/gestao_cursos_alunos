<?php
require_once(__DIR__ . '/../config/ConnectionDatabase.php');

class Student
{
    private $db;

    public function __construct()
    {
        $conn = new ConnectionDatabase();
        $this->db = $conn->getConnection();
    }

    public function getAllStudents()
    {
        try {
            $sql = "SELECT id, name, birth_date, user_login FROM students ORDER BY name ASC";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Erro ao buscar alunos: " . $e->getMessage());
            return [];
        }
    }


    public function create($data)
    {
        $name = $data['name'];
        $birth_date = $data['birth_date'];
        $user_login = $data['user_login'];

        $sql = "INSERT INTO students (name, birth_date, user_login)
                VALUES (:name, :birth_date, :user_login)";
        $stmt = $this->db->prepare($sql);


        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':birth_date', $birth_date, PDO::PARAM_STR);
        $stmt->bindValue(':user_login', $user_login, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function existsByNameOrLogin($name, $user_login, $id = null)
    {
        $sql = "SELECT COUNT(*) FROM students WHERE (name = :name AND user_login = :user_login)";

        if ($id) {
            $sql .= " AND id != :id";
        }

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':user_login', $user_login, PDO::PARAM_STR);
        if ($id) {
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        }

        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }
}
