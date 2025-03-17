<?php
require_once(__DIR__ . '/../models/Student.php');

class StudentsController
{
    private $model;

    public function __construct()
    {
        $this->model = new Student();
    }

    public function index() {}
    public function create() {}
    public function store()
    {
        $data = [
            'name' => $_POST['name'],
            'birth_date' => date('Y-m-d', strtotime($_POST['birth_date'])),
            'user_login' => $_POST['user_login']
        ];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Verifica se já existe um aluno com o mesmo nome ou login
            if ($this->model->existsByNameOrLogin($data['name'], $data['user_login'])) {
                header("Location: ../views/user_create.php?error=duplicate");
                exit();
            }

            $this->model->create($data);

            if ($this->model->create($data)) {
                header("Location: ../views/user_list.php?success=1");
                exit();
            } else {
                header("Location: ../views/user_create.php?error=1");
                exit();
            }
        }
    }
    public function edit($id) {}
    public function update($id) {}
    public function delete($id) {}
}
