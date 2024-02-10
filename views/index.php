<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Usuários</title>
    <!-- ink CSS do Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>

<?php
$connection = new Connection();
$userModel = new UserModel($connection);
$colorModel = new ColorModel($connection);
$userController = new UserController($userModel, $colorModel);

$users = $userModel->getUsers();
?>

<div class="container">
    <h2 class="mb-4">Lista de Usuários</h2>

    <!-- Formulário de criação de usuário -->
    <form method="post" action="process.php" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <label class="form-label">Nome:</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Email:</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Cores:</label><br>

                <!-- Lista de cores disponíveis -->
                <?php
                $colors = $colorModel->getColors();
                foreach ($colors as $color) {
                    echo "<div class='form-check form-check-inline'>
                            <input class='form-check-input' type='checkbox' name='colors[]' value='{$color->id}'>
                            <label class='form-check-label' style='color: {$color->name};'>{$color->name}</label>
                        </div>";
                }
                ?>
            </div>
            <div class="col-md-12 mt-2">
                <button type="submit" class="btn btn-primary">Criar Usuário</button>
            </div>
        </div>
    </form>

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Cores</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($users as $user) {
                echo "<tr>
                          <td>{$user->id}</td>
                          <td>{$user->name}</td>
                          <td>{$user->email}</td>
                          <td>";

                // Pega as cores associadas ao usuário
                $userColors = $userModel->getUserColors($user->id);
                foreach ($userColors as $color) {
                    echo "<span class='badge badge-pill' style='background-color: {$color};'>$color</span>&nbsp;";
                }

                echo "</td>
                          <td>
                               <a href='views/edit.php?id={$user->id}' class='btn btn-warning btn-sm'>Editar</a>
                               <a href='process.php?action=delete&id={$user->id}' class='btn btn-danger btn-sm'>Excluir</a>
                          </td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Scripts JS do Bootstrap -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>

</html>