<?php

require 'includes/connection.php';
require 'models/UserModel.php';
require 'models/ColorModel.php';

class Tests {

    public function testDatabaseConnection() {
        $connection = new Connection();
        $pdoInstance = $connection->getConnection();

        if ($pdoInstance instanceof PDO) {
            echo "Teste 1: Conexão com o banco de dados está funcionando corretamente.\n";
        } else {
            echo "Teste 1: Falha na conexão com o banco de dados.\n";
        }
    }

    public function testGetUsers() {
        $connection = new Connection();
        $userModel = new UserModel($connection);

        $users = $userModel->getUsers();

        if (!empty($users)) {
            echo "Teste 2: Método getUsers retorna um resultado não vazio.\n";
        } else {
            echo "Teste 2: Falha no método getUsers.\n";
        }
    }

    public function testGetColors() {
        $connection = new Connection();
        $colorModel = new ColorModel($connection);

        $colors = $colorModel->getColors();

        if (!empty($colors)) {
            echo "Teste 3: Método getColors retorna um resultado não vazio.\n";
        } else {
            echo "Teste 3: Falha no método getColors.\n";
        }
    }
}

$tests = new Tests();
$tests->testDatabaseConnection();
$tests->testGetUsers();
$tests->testGetColors();
?>