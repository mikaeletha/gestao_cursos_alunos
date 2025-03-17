<?php
$pageTitle = "Turmas";
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
    <h2>Lista de Turmas</h2>
    <a href="classes/create" class="btn btn-success mb-3">Cadastrar Nova Turma</a>

    <?php if (empty($classes)): ?>
        <p>Nenhum aluno encontrado.</p>
    <?php else: ?>
        <table class="table rounded-2 overflow-hidden table-bordered table-hover text-center">
            <thead class="table-secondary">
                <tr>
                    <th>Nome</th>
                    <th>Tipo</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($classes as $classe): ?>
                    <tr>
                        <td><?php echo ucwords(strtolower($classe['name'])); ?></td>
                        <td><?php echo strtoupper($classe['type']); ?></td>
                        <td>
                            <a href=" classes/edit?id=<?php echo $classe['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="classes/destroy?id=<?php echo $classe['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <nav>
            <ul class="pagination justify-content-center">
                <li class="page-item <?= $page <= 1 ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?page=<?= $page - 1; ?>">Anterior</a>
                </li>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?= $i == $page ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a>
                    </li>
                <?php endfor; ?>

                <li class="page-item <?= $page >= $totalPages ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?page=<?= $page + 1; ?>">Próximo</a>
                </li>
            </ul>
        </nav>
    <?php endif; ?>
</div>

<?php
include('./app/views/includes/footer.php');
?>