<?php
// $pageTitle = "Cadastrar Aluno";
$pageTitle = isset($student) ? "Editar Aluno" : "Cadastrar Aluno";
include_once('./app/views/includes/header.php');

// ??
$isEditing = isset($student);
// $actionUrl = $isEditing ? "update/{$student['id']}" : "store";
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
    <h2><?= $isEditing ? "Editar Aluno" : "Cadastrar Aluno"; ?></h2>
  
    <form method="POST" action="<?= isset($student) ? "update" : "store"; ?>">
        <?php if ($isEditing): ?>
            <input type="hidden" name="id" value="<?= $student['id']; ?>">
        <?php endif; ?>

        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control" id="name" name="name"
                value="<?= $isEditing ? htmlspecialchars($student['name']) : ''; ?>"
                minlength="3" required>
        </div>
        <div class="mb-3">
            <label for="birth_date" class="form-label">Data de Nascimento</label>
            <input type="date" class="form-control" id="birth_date" name="birth_date"
                value="<?= $isEditing ? $student['birth_date'] : ''; ?>" required>
        </div>
        <div class="mb-3">
            <label for="user_login" class="form-label">Login</label>
            <input type="text" class="form-control" id="user_login" name="user_login"
                value="<?= $isEditing ? htmlspecialchars($student['user_login']) : ''; ?>" required>
        </div>

        <?php if (isset($student)): ?>
            <input type="hidden" name="id" value="<?= htmlspecialchars($student['id']); ?>">
        <?php endif; ?>


        <button type="submit" class="btn btn-primary"><?= $isEditing ? "Atualizar" : "Cadastrar"; ?></button>
        <a href="/gestao_cursos_alunos/students" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php include('./app/views/includes/footer.php'); ?>