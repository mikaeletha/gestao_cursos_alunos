<?php

require_once '../app/controllers/ClassesController.php';
require_once '../app/controllers/EnrollmentsController.php';
require_once '../app/controllers/StudentsController.php';

$controller = isset($_GET['controller']) ? $_GET['controller'] : 'aluno';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

switch ($controller) {
    case 'aluno':
        $controllerInstance = new ClassesController();
        break;
    case 'turma':
        $controllerInstance = new EnrollmentsController();
        break;
    case 'matricula':
        $controllerInstance = new StudentsController();
        break;
    default:
        die("Controlador não encontrado");
}

if (method_exists($controllerInstance, $action)) {
    $controllerInstance->$action();
} else {
    die("Ação não encontrada");
}

?>
