<?php
require 'includes/connection.php';
require 'models/UserModel.php';
require 'models/ColorModel.php';
require 'controllers/UserController.php';

$connection = new Connection();
$userModel = new UserModel($connection);
$colorModel = new ColorModel($connection);
$userController = new UserController($userModel, $colorModel);

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Pega informações do usuário
    $user = $userController->getUserModel()->getUserById($id);

    if (!$user) {
        echo "Usuário não encontrado.";
        exit();
    }

    // Pega as cores vinculadas ao usuário
    $userColors = $userController->getUserModel()->getUserColors($id);

    // Pega a lista de cores disponíveis
    $colors = $userController->getColorModel()->getColors();

    ?>
    <!DOCTYPE html>
    <html lang='pt-br'>

    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Editar Usuário</title>
        <!-- Link CSS do Bootstrap -->
        <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
    </head>

    <body>

    <div class='container mt-5'>
        <h2 class='mb-4'>Editar Usuário</h2>
        <form method='post' action='../process.php' class='mb-4'>
            <input type='hidden' name='id' value='<?= $user->id ?>'>
            <div class='mb-3'>
                <label class='form-label'>Nome:</label>
                <input type='text' name='name' value='<?= $user->name ?>' class='form-control' required>
            </div>
            <div class='mb-3'>
                <label class='form-label'>Email:</label>
                <input type='email' name='email' value='<?= $user->email ?>' class='form-control' required>
            </div>
            <div class='mb-3'>
                <label class='form-label'>Cores:</label><br>
                <?php foreach ($colors as $color): ?>
                    <?php $checked = in_array($color->name, $userColors) ? 'checked' : ''; ?>
                    <div class='form-check form-check-inline'>
                        <input type='checkbox' name='colors[]' value='<?= $color->id ?>' class='form-check-input' <?= $checked ?>>
                        <label class='form-check-label' style='color: <?= $color->name ?>;'><?= $color->name ?></label>
                    </div>
                <?php endforeach; ?>
            </div>
            <button type='submit' class='btn btn-primary'>Salvar Alterações</button>
        </form>

        <a href='../index.php' class='btn btn-secondary'>Voltar</a>
    </div>

    <!-- Scripts JS do Bootstrap -->
    <script src='https://code.jquery.com/jquery-3.3.1.slim.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js'></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js'></script>
    </body>

    </html>
    <?php
}
?>