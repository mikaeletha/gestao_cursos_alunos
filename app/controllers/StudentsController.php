<?php
require_once(__DIR__ . '/../models/Student.php');

class StudentsController
{
    private $model;

    public function __construct()
    {
        $this->model = new Student();
    }


    public function index()
    {
        $students = $this->model->getAll();
        include('./app/views/students/index.php');
    }

    public function create()
    {
        require_once './app/views/students/create.php';
    }
    public function store()
    {
        $data = [
            'name' => $_POST['name'],
            'birth_date' => date('Y-m-d', strtotime($_POST['birth_date'])),
            'user_login' => $_POST['user_login']
        ];

        // if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //     // Verifica se já existe um aluno com o mesmo nome ou login
        //     if ($this->model->existsByNameOrLogin($data['name'], $data['user_login'])) {
        //         header("Location: ../views/user_create.php?error=duplicate");
        //         exit();
        //     }

            // $this->model->create($data);

            if ($this->model->create($data)) {
                header("Location: ../students?success=1");
                exit();
            } else {
                header("Location: ../students?error=1");
                exit();
            }
    }

    public function edit($id) {}
    public function update($id) {}
    public function destroy($id)
    {
        $this->model->delete($id);
        if ($this->model->delete($id)) {
            header("Location: ../students?success=delete");
            exit();
        } else {
            header("Location: ../students?error=delete");
            exit();
        }
    }
}
