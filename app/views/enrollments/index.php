<?php
$pageTitle = "Matrículas";
include_once('./app/views/includes/header.php');
?>

<?php
if (isset($_SESSION['message'])): ?>
    <div class="alert alert-<?= $_SESSION['message']['type']; ?>" role="alert">
        <?= $_SESSION['message']['text']; ?>
    </div>
    <?php unset($_SESSION['message']);
    ?>
<?php endif; ?>

<div class="container mt-5">
    <h2>Lista de Matrículas</h2>
    <a href="enrollments/create" class="btn btn-success mb-3">Nova Matrícula</a>

    <?php if (empty($enrollments)): ?>
        <p>Nenhum aluno encontrado.</p>
    <?php else: ?>
        <div class="container mt-4">
            <table class="table rounded-2 overflow-hidden table-bordered table-hover text-center">
                <thead class="table-secondary">
                    <tr>
                        <th colspan="2">Turma</th>
                        <th colspan="2">Aluno</th>
                    </tr>
                    <tr>
                        <th>Nome</th>
                        <th>Tipo</th>
                        <th>ID</th>
                        <th>Nome</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($enrollments as $enrollment): ?>
                        <tr>
                            <td><?= ucwords(strtolower(htmlspecialchars($enrollment['class_name']))) ?></td>
                            <td><?= strtoupper(htmlspecialchars($enrollment['class_type'])) ?></td>
                            <td><?= htmlspecialchars($enrollment['student_id']) ?></td>
                            <td><?= ucwords(strtolower(htmlspecialchars($enrollment['student_name']))) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    <?php endif; ?>
</div>

<?php
include('./app/views/includes/footer.php');
?>