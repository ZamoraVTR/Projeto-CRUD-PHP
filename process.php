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

    if (isset($_GET['action']) && $_GET['action'] === 'delete') {
        $userController->delete($id);
    } else {
        $userController->edit($id);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userController->saveUser($_POST);
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $userController->index();
}
