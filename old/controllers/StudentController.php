<?php
// require_once('../models/Student.php');
require_once 'app/models/Student.php';


$action = $_REQUEST['action'];
if (isset($action)) {
    $controller = new StudentController();
    if (method_exists($controller, $action)) {
        $controller->$action();
    } else {
        echo "Ação desconhecida: $action";
    }
}


class StudentController
{
    private $model;

    public function __construct()
    {
        $this->model = new Student();
    }

    public function index()
    {
        // // $students = $this->model->getAllStudents();  
        // // include('../views/user_list.php');
        // $students = $this->model->getAllStudents();  

        // // Teste de saída
        // echo "<pre>";
        // // print_r($students);
        // echo 'mikkkkkkka';
        // echo "</pre>";
        
        // include('../views/user_list.php');

        $message = 'oi';
        require('../views/user_list.php');

    }


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
}
