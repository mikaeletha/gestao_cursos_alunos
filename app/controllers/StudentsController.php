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
        require_once './app/views/students/create_edit.php';
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
        //         header("Location: ?error=duplicate");
        //         exit();
        //     }

        // $this->model->create($data);

        // if ($this->model->create($data)) {
        //     header("Location: ../students?success=1");
        //     exit();
        // } else {
        //     header("Location: ../students?error=1");
        //     exit();
        // }

        if ($this->model->create($data)) {
            $_SESSION['message'] = ['type' => 'success', 'text' => 'Aluno casdrado com sucesso!'];
        } else {
            $_SESSION['message'] = ['type' => 'danger', 'text' => 'Erro ao cadastrar aluno. Tente novamente.'];
        }

        header("Location: ../students");
        exit();
    }

    public function edit($id)
    {
        $student = $this->model->getById($id);

        if ($student) {
            require_once './app/views/students/create_edit.php';
        } else {
            echo "Aluno não encontrado.";
        }
    }
    public function update()
    {
        $id = $_POST['id'];
        $data = [
            'name' => $_POST['name'],
            'birth_date' => date('Y-m-d', strtotime($_POST['birth_date'])),
            'user_login' => $_POST['user_login']
        ];

        if ($this->model->update($id, $data)) {
            $_SESSION['message'] = ['type' => 'success', 'text' => 'Aluno atualizado com sucesso!'];
        } else {
            $_SESSION['message'] = ['type' => 'danger', 'text' => 'Erro ao atualizar aluno. Tente novamente.'];
        }

        header("Location: ../students");
        exit();
    }
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
