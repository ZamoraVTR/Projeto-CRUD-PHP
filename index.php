<?php
require 'includes/connection.php';
require 'models/UserModel.php';
require 'models/ColorModel.php';
require 'controllers/UserController.php';

$connection = new Connection();
$userModel = new UserModel($connection);
$colorModel = new ColorModel($connection);
$userController = new UserController($userModel, $colorModel);

$userController->index();
?>