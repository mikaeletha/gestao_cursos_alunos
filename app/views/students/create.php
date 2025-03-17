<?php
$pageTitle = "Cadastrar Aluno";
include_once('./app/views/includes/header.php');
?>

<?php if (isset($_GET['error'])): ?>
    <div class="alert alert-danger" role="alert">
        <?php
        $errorMessage = 'Erro ao cadastrar aluno.';
        if ($_GET['error'] == 'duplicate') {
            $errorMessage = 'Já existe um aluno com o mesmo nome e login. Por favor, escolha outro nome ou login.';
        }
        echo $errorMessage;
        ?>
    </div>
<?php endif; ?>

<div class="container mt-5">
    <h2>Cadastrar Aluno</h2>
    <form method="POST" action="../students/store">
        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control" id="name" name="name" minlength="3" required>
        </div>
        <div class="mb-3">
            <label for="birth_date" class="form-label">Data de Nascimento</label>
            <input type="date" class="form-control" id="birth_date" name="birth_date" required>
        </div>
        <div class="mb-3">
            <label for="user_login" class="form-label">Login</label>
            <input type="text" class="form-control" id="user_login" name="user_login" required>
        </div>
        <input type="hidden" name="action" value="store">
        <button type="submit" class="btn btn-primary">Cadastrar</button>
        <a href="/gestao_cursos_alunos/students" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php include('./app/views/includes/footer.php'); ?>
