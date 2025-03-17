<?php
require_once(__DIR__ . '/../config/Database.php');

class Enrollment
{
    private $db;

    public function __construct()
    {
        $conn = new Database();
        $this->db = $conn->getConnection();
    }

    public function getAll($page = 1, $itemsPerPage = 5)
    {
        try {
            $offset = ($page - 1) * $itemsPerPage;

            $sql = "SELECT 
                    e.id AS enrollment_id, 
                    e.class_id, 
                    c.name AS class_name, 
                    c.description AS class_description, 
                    c.type AS class_type, 
                    e.student_id,     
                    s.id AS student_id, 
                    s.name AS student_name
                FROM enrollments AS e
                JOIN classes AS c ON e.class_id = c.id
                JOIN students AS s ON e.student_id = s.id
                ORDER BY c.name ASC, s.name ASC
                LIMIT :limit OFFSET :offset";

            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':limit', $itemsPerPage, PDO::PARAM_INT);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Erro ao buscar matrículas: " . $e->getMessage());
            return [];
        }
    }

    public function getTotalCount()
    {
        try {
            $sql = "SELECT COUNT(id) AS total FROM classes";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total'];
        } catch (Exception $e) {
            error_log("Erro ao contar alunos: " . $e->getMessage());
            return 0;
        }
    }


    public function create($data)
    {
        if ($this->exists($data['student_id'], $data['class_id'])) {
            return false;
        }

        try {
            $sql = "INSERT INTO enrollments (student_id, class_id) VALUES (:student_id, :class_id)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':student_id', $data['student_id'], PDO::PARAM_INT);
            $stmt->bindValue(':class_id', $data['class_id'], PDO::PARAM_INT);
            return $stmt->execute();
        } catch (Exception $e) {
            error_log("Erro ao realizar matrícula: " . $e->getMessage());
            return false;
        }
    }

    private function exists($student_id, $class_id)
    {
        $sql = "SELECT COUNT(*) FROM enrollments WHERE (student_id = :student_id AND class_id = :class_id)";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':student_id', $student_id, PDO::PARAM_STR);
        $stmt->bindParam(':class_id', $class_id, PDO::PARAM_STR);

        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }
}
