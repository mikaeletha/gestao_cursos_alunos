<?php

// Carregar os controladores
require_once('./app/controllers/ClassesController.php');
require_once('./app/controllers/EnrollmentsController.php');
require_once('./app/controllers/StudentsController.php');

// Função para gerenciar o roteamento
function handleRoute($url)
{
    $id = $_GET['id'] ?? null;
    switch ($url) {
    //STUDENTS
        case '':
        case 'students':
            $controller = new StudentsController();
            $controller->index();
            break;

        case 'students/create':
            $controller = new StudentsController();
            $controller->create();
            break;

        case 'students/store':
            $controller = new StudentsController();
            $controller->store();
            break;

        case 'students/edit':
            if ($id) {
                $controller = new StudentsController();
                $controller->edit($id);
            } else {
                echo "ID do aluno não fornecido.";
            }
            break;
        
        case 'students/update':
                $controller = new StudentsController();
                $controller->update();
           
            break;

        case 'students/destroy':
            if ($id) {
                $controller = new StudentsController();
                $controller->destroy($id);
            } else {
                echo "ID do aluno não fornecido.";
            }
            break;
    // CLASSES
        case 'classes':
            $controller = new ClassesController();
            $controller->index();
            break;

        case 'classes/create':
            $controller = new ClassesController();
            $controller->create();
            break;

        case 'classes/store':
            $controller = new ClassesController();
            $controller->store();
            break;

        // case 'enrollments':
        //     $controller = new EnrollmentsController();
        //     $controller->index();
        //     break;

        // case 'enrollments/create':
        //     $controller = new EnrollmentsController();
        //     $controller->create();
        //     break;

        // case 'enrollments/store':
        //     $controller = new EnrollmentsController();
        //     $controller->store();
        //     break;

        // default:
        //     // Se a URL não corresponder a nenhum caso, mostramos uma página de erro
        //     echo "Página não encontrada!";
        //     break;
        default:
            header("HTTP/1.0 404 Not Found");
            echo "Erro 404 - Página não encontrada!";
            break;
    }

    // $url = trim($url, '/');

    // // Definir as rotas
    // if ($url == '' || $url == 'home') {
    //     // Página inicial ou home
    //     echo "Bem-vindo à página inicial!";
    // } elseif ($url == 'alunos') {
    //     $controller = new AlunoController();
    //     $controller->index();
    // } elseif ($url == 'alunos/create') {
    //     $controller = new AlunoController();
    //     $controller->create();
    // } elseif ($url == 'alunos/store') {
    //     $controller = new AlunoController();
    //     $controller->store();
    // } elseif (preg_match('/alunos\/edit\/(\d+)/', $url, $matches)) {
    //     $controller = new AlunoController();
    //     $controller->edit($matches[1]);
    // } elseif ($url == 'turmas') {
    //     $controller = new TurmaController();
    //     $controller->index();
    // } elseif ($url == 'matriculas') {
    //     $controller = new MatriculaController();
    //     $controller->index();
    // } else {
    //     // Caso não seja uma URL válida
    //     echo "Página não encontrada!";
    // }
}
