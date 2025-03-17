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
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Tipo</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($classes as $classe): ?>
                    <tr>
                        <td><?php echo $classe['id']; ?></td>
                        <td><?php echo $classe['name']; ?></td>
                        <td><?php echo $classe['type']; ?></td>
                        <td>
                            <a href="view.php?id=<?php echo $classe['id']; ?>" class="btn btn-info btn-sm">Ver</a>
                            <a href="classes/edit?id=<?php echo $classe['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="classes/destroy?id=<?php echo $classe['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php
// Incluir o footer
include('./app/views/includes/footer.php');
?>