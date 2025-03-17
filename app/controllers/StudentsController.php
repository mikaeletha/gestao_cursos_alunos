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

        if ($this->model->create($data)) {
            $this->setMessage('success', 'Aluno casdrado com sucesso!');
        } else {
            $this->setMessage('danger', 'Erro ao cadastrar aluno. Tente novamente.');
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
            $this->setMessage('success', 'Aluno atualizado com sucesso!');
        } else {
            $this->setMessage('danger', 'Erro ao atualizar aluno. Tente novamente.');
        }

        header("Location: ../students");
        exit();
    }
    public function destroy($id)
    {
        if ($this->model->delete($id)) {
            header("Location: ../students?success=delete");
            exit();
        } else {
            header("Location: ../students?error=delete");
            exit();
        }
    }

    public function setMessage($type, $text)
    {
        $_SESSION['message'] = ['type' => $type, 'text' => $text];
    }
}
