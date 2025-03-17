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

        if ($this->model->create($data)) {
            $this->setMessage('success','Turma casdrada com sucesso!');
        } else {
            $this->setMessage('danger','Erro ao cadastrar turma. Tente novamente.');
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
            $this->setMessage('success','Turma atualizado com sucesso!');
        } else {
            $this->setMessage('danger','Erro ao atualizar turma. Tente novamente.');
        }

        header("Location: ../classes");
        exit();
    }

    public function destroy($id)
    {
        if ($this->model->delete($id)) {
            $this->setMessage('success', 'Turma deletada com sucesso!');
        } else {
            $this->setMessage('danger', 'Erro ao deletar turma. Tente novamente.');
        }

        header("Location: ../classes");
        exit();
    }

    public function setMessage($type, $text)
    {
        $_SESSION['message'] = ['type' => $type, 'text' => $text];
    }
}
