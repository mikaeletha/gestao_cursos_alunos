<?php
$pageTitle = "Nova Matrícula";
include_once('./app/views/includes/header.php');
?>

<div class="container mt-5">
    <h2>Nova Matrícula</h2>

    <form method="POST" action="store">
        <div class="mb-3">
            <label for="student_id" class="form-label">Aluno</label>
            <select class="form-select" id="student_id" name="student_id" required>
                <option value="" selected disabled>Selecione um aluno</option>
                <?php foreach ($students as $student): ?>
                    <option value="<?= htmlspecialchars($student['id']); ?>">
                        <?= $student['id'] . ' - ' . htmlspecialchars($student['name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="class_id" class="form-label">Turma</label>
            <select class="form-select" id="class_id" name="class_id" required>
                <option value="" selected disabled>Selecione uma turma</option>
                <?php foreach ($classes as $class): ?>
                    <option value="<?= htmlspecialchars($class['id']); ?>">
                        <?= htmlspecialchars($class['id']); ?> - <?= htmlspecialchars($class['name']); ?> - <?= htmlspecialchars($class['type']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Cadastrar Matrícula</button>
        <a href="/gestao_cursos_alunos/enrollments" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php include('./app/views/includes/footer.php'); ?>
