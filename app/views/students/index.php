<?php
$pageTitle = "Alunos";
include_once('./app/views/includes/header.php');
?>

<?php
if (isset($_SESSION['message'])): ?>
    <div class="alert alert-<?= $_SESSION['message']['type']; ?>" role="alert">
        <?= $_SESSION['message']['text']; ?>
    </div>
    <?php unset($_SESSION['message']); // Remove a mensagem após exibir 
    ?>
<?php endif; ?>

<div class="container mt-5">
    <h2>Lista de Alunos</h2>
    <a href="students/create" class="btn btn-success mb-3">Cadastrar Novo Aluno</a>

    <?php if (empty($students)): ?>
        <p>Nenhum aluno encontrado.</p>
    <?php else: ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Data de Nascimento</th>
                    <th>Login</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <!-- Exibir alunos -->
                <?php foreach ($students as $student): ?>
                    <tr>
                        <td><?php echo $student['id']; ?></td>
                        <td><?php echo $student['name']; ?></td>
                        <td><?php echo $student['birth_date']; ?></td>
                        <td><?php echo $student['user_login']; ?></td>
                        <td>
                            <a href="view.php?id=<?php echo $student['id']; ?>" class="btn btn-info btn-sm">Ver</a>
                            <a href="students/edit?id=<?php echo $student['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                            <!-- <a href="delete.php?id=<?php echo $student['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a> -->
                            <a href="students/destroy?id=<?php echo $student['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>

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