<?php
require_once(__DIR__ . '/../models/Classe.php');

class ClassesController
{
    private $model;

    public function __construct()
    {
        $this->model = new Classe();
    }

    public function index()
    {
        $students = $this->model->getAll();
        include('./app/views/classes/index.php');
    }
    public function create()
    {
        include('./app/views/classes/create_edit.php');
    }
    public function store()
    {
        $data = [
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'type' => $_POST['type']
        ];

        // if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //     if ($this->model->existsByNameAndType($data['name'], $data['type'])) {
        //         $_SESSION['message'] = ['type' => 'danger', 'text' => 'Erro ao turma aluno. Tente novamente.'];
                
        //         header("Location: ../students");
        //         exit();
        //     }
        // }

        if ($this->model->create($data)) {
            $_SESSION['message'] = ['type' => 'success', 'text' => 'Turma casdrada com sucesso!'];
        } else {
            $_SESSION['message'] = ['type' => 'danger', 'text' => 'Erro ao cadastrar turma. Tente novamente.'];
        }

        header("Location: ../classes");
        exit();
    }
    public function edit($id)
    {
        
    }
    public function update($id)
    {
        
    }
    public function delete($id)
    {
        
    }
}