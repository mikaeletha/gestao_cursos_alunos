<?php
require_once(__DIR__ . '/../config/Database.php');

class Classe
{
    private $db;

    public function __construct()
    {
        $conn = new Database();
        $this->db = $conn->getConnection();
    }

    public function getAll()
    {
        try {
            $sql = "SELECT id, name, description, type FROM classes ORDER BY name ASC";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Erro ao buscar turmas: " . $e->getMessage());
            return [];
        }
    }

    public function getById($id)
    {
        try {
            $sql = "SELECT id, name, description, type FROM classes WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Erro ao buscar turma por ID: " . $e->getMessage());
            return null;
        }
    }

    public function create($data)
    {
        if ($this->existsByNameAndType($data['name'], $data['type'])) {
            return false;
        }

        try {
            $sql = "INSERT INTO classes (name, description, type) VALUES (:name, :description, :type)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':name', $data['name'], PDO::PARAM_STR);
            $stmt->bindValue(':description', $data['description'], PDO::PARAM_STR);
            $stmt->bindValue(':type', $data['type'], PDO::PARAM_STR);
            return $stmt->execute();
        } catch (Exception $e) {
            error_log("Erro ao criar turma: " . $e->getMessage());
            return false;
        }
    }

    public function update($id, $data)
    {
        if ($this->existsByNameAndType($data['name'], $data['type'], $id)) {
            return false;
        }

        try {
            $sql = "UPDATE classes SET name = :name, description = :description, type = :type WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':name', $data['name'], PDO::PARAM_STR);
            $stmt->bindValue(':description', $data['description'], PDO::PARAM_STR);
            $stmt->bindValue(':type', $data['type'], PDO::PARAM_STR);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (Exception $e) {
            error_log("Erro ao atualizar turma: " . $e->getMessage());
            return false;
        }
    }

    public function delete($id)
    {
        try {
            $sql = "DELETE FROM classes WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (Exception $e) {
            error_log("Erro ao excluir turma: " . $e->getMessage());
            return false;
        }
    }

    private function existsByNameAndType($name, $type, $id = null)
    {
        $sql = "SELECT COUNT(*) FROM classes WHERE (name = :name and type = :type)";

        if ($id) {
            $sql .= " AND id != :id";
        }

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':type', $type, PDO::PARAM_STR);
        if ($id) {
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        }

        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }
}
