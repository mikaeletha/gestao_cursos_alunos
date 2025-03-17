<?php
$pageTitle = isset($classe) ? "Editar turma" : "Cadastrar turma";
include_once('./app/views/includes/header.php');

$isEditing = isset($classe);
?>

<?php if (isset($_GET['error'])): ?>
    <div class="alert alert-danger" role="alert">
        <?php
        $errorMessage = 'Erro ao cadastrar turma.';
        if ($_GET['error'] == 'duplicate') {
            $errorMessage = 'Já existe um turma com o mesmo nome e login. Por favor, escolha outro nome ou login.';
        }
        echo $errorMessage;
        ?>
    </div>
<?php endif; ?>

<div class="container mt-5">
    <h2><?= $isEditing ? "Editar Turma" : "Cadastrar Turma"; ?></h2>

    <form method="POST" action="<?= isset($classe) ? "update" : "store"; ?>">
        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control" id="name" name="name"
                value="<?= $isEditing ? htmlspecialchars($classe['name']) : ''; ?>"
                minlength="3" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Descrição</label>
            <input type="text" class="form-control" id="description" name="description"
                value="<?= $isEditing ? htmlspecialchars($classe['description']) : ''; ?>"
                minlength="3" required>
        </div>
        <div class="mb-3">
        <label for="type" class="form-label">Modalidade</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="type" id="presencial" value="presencial">
                <label class="form-check-label" for="presencial">Presencial</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="type" id="remoto" value="remoto">
                <label class="form-check-label" for="remoto">Remoto</label>
            </div>
        </div>

        <?php if (isset($classe)): ?>
            <input type="hidden" name="id" value="<?= htmlspecialchars($classe['id']); ?>">
        <?php endif; ?>


        <button type="submit" class="btn btn-primary"><?= $isEditing ? "Atualizar" : "Cadastrar"; ?></button>
        <a href="/gestao_cursos_turmas/students" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php include('./app/views/includes/footer.php'); ?>