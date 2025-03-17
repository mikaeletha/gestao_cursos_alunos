<?php
require_once(__DIR__ . '/../models/Enrollment.php');
require_once(__DIR__ . '/../models/Student.php');
require_once(__DIR__ . '/../models/Classe.php');

class EnrollmentsController
{
    private $model;

    public function __construct()
    {
        $this->model = new Enrollment();
    }

    public function index()
    {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = 5;
        $enrollments = $this->model->getAll($page, $perPage);
        $total = $this->model->getTotalCount();
        $totalPages = ceil($total / $perPage);
        include('./app/views/enrollments/index.php');
    }

    public function create()
    {
        $studentModel = new Student();
        $classModel = new Classe();

        $students = $studentModel->getAll();
        $classes = $classModel->getAll();

        include('./app/views/enrollments/create.php');
    }

    public function store()
    {
        $data = [
            'student_id' => $_POST['student_id'],
            'class_id' => $_POST['class_id'],
        ];

        if ($this->model->create($data)) {
            $this->setMessage('success', 'Matrícula realizada com sucesso!');
        } else {
            $this->setMessage('danger', 'Erro ao realizar matrícula. Tente novamente.');
        }

        header("Location: ../enrollments");
        exit();
    }

    public function setMessage($type, $text)
    {
        $_SESSION['message'] = ['type' => $type, 'text' => $text];
    }
}
