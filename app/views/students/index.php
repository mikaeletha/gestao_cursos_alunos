<?php
$pageTitle = "Alunos";
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
    <h2>Lista de Alunos</h2>
    <a href="students/create" class="btn btn-success mb-3">Cadastrar Novo Aluno</a>

    <?php if (empty($students)): ?>
        <p>Nenhum aluno encontrado.</p>
    <?php else: ?>
        <table class="table rounded-2 overflow-hidden table-bordered table-hover text-center">
            <thead class="table-secondary">
                <tr>
                    <th>Nome</th>
                    <th>Data de Nascimento</th>
                    <th>Login</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($students as $student): ?>
                    <tr>
                        <td><?php echo ucwords(strtolower($student['name'])); ?></td>
                        <td><?php echo date('d/m/Y', strtotime($student['birth_date'])); ?></td>
                        <td><?php echo strtoupper($student['user_login']); ?></td>
                        <td>
                            <a href="students/edit?id=<?php echo $student['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="students/destroy?id=<?php echo $student['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
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