<?php
require_once(__DIR__ . '/../config/Database.php');

class Student
{
    private $db;

    public function __construct()
    {
        $conn = new Database();
        $this->db = $conn->getConnection();
    }

    public function getAll($page = 1, $perPage = 5)
    {
        try {
            $offset = ($page - 1) * $perPage;
            $sql = "SELECT id, name, birth_date, user_login FROM students ORDER BY name ASC LIMIT :limit OFFSET :offset";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':limit', $perPage, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Erro ao buscar alunos: " . $e->getMessage());
            return [];
        }
    }

    public function getTotalCount()
    {
        try {
            $sql = "SELECT COUNT(id) AS total FROM students";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total'];
        } catch (Exception $e) {
            error_log("Erro ao contar alunos: " . $e->getMessage());
            return 0;
        }
    }

    public function getById($id)
    {
        try {
            $sql = "SELECT id, name, birth_date, user_login FROM students WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Erro ao buscar aluno por ID: " . $e->getMessage());
            return null;
        }
    }

    public function create($data)
    {
        if ($this->existsByNameOrLogin($data['name'], $data['user_login'])) {
            return false;
        }

        try {
            $sql = "INSERT INTO students (name, birth_date, user_login) VALUES (:name, :birth_date, :user_login)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':name', $data['name'], PDO::PARAM_STR);
            $stmt->bindValue(':birth_date', $data['birth_date'], PDO::PARAM_STR);
            $stmt->bindValue(':user_login', $data['user_login'], PDO::PARAM_STR);
            return $stmt->execute();
        } catch (Exception $e) {
            error_log("Erro ao criar aluno: " . $e->getMessage());
            return false;
        }
    }

    public function update($id, $data)
    {
        if ($this->existsByNameOrLogin($data['name'], $data['user_login'], $id)) {
            return false;
        }

        try {
            $sql = "UPDATE students SET name = :name, birth_date = :birth_date, user_login = :user_login WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':name', $data['name'], PDO::PARAM_STR);
            $stmt->bindValue(':birth_date', $data['birth_date'], PDO::PARAM_STR);
            $stmt->bindValue(':user_login', $data['user_login'], PDO::PARAM_STR);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (Exception $e) {
            error_log("Erro ao atualizar aluno: " . $e->getMessage());
            return false;
        }
    }

    public function delete($id)
    {
        try {
            $sql = "DELETE FROM students WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (Exception $e) {
            error_log("Erro ao excluir aluno: " . $e->getMessage());
            return false;
        }
    }

    private function existsByNameOrLogin($name, $user_login, $id = null)
    {
        $sql = "SELECT COUNT(*) FROM students WHERE (name = :name OR user_login = :user_login)";

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
