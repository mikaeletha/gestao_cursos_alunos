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
        $classes = $this->model->getAll();
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
        $classe = $this->model->getById($id);

        if ($classe) {
            require_once './app/views/classes/create_edit.php';
        } else {
            echo "Turma não encontrada.";
        }
    }

    public function update()
    {
        $id = $_POST['id'];
        $data = [
            'name' => $_POST['name'],
            'description' => $_POST['description'],
            'type' => $_POST['type']
        ];

        if ($this->model->update($id, $data)) {
            $_SESSION['message'] = ['type' => 'success', 'text' => 'Turma atualizado com sucesso!'];
        } else {
            $_SESSION['message'] = ['type' => 'danger', 'text' => 'Erro ao atualizar turma. Tente novamente.'];
        }

        header("Location: ../classes");
        exit();
    }

    public function delete($id)
    {
        
    }
}