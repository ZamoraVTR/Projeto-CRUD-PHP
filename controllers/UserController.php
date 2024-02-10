<?php
class UserController {
    private $userModel;
    private $colorModel;

    public function __construct($userModel, $colorModel) {
        $this->userModel = $userModel;
        $this->colorModel = $colorModel;
    }

    public function index() {
        $users = $this->userModel->getUsers();
        $colors = $this->colorModel->getColors();

        require 'views/index.php';
    }

    public function edit($id) {
        $user = $this->userModel->getUserById($id);

        if (!$user) {
            echo "Usuário não encontrado.";
            exit();
        }

        $userColors = $this->userModel->getUserColors($id);
        $colors = $this->colorModel->getColors();

        require 'views/edit.php';
    }

    public function saveUser($postData) {
        if (isset($postData['id'])) {
            $this->updateUser($postData);
        } else {
            $this->createUser($postData);
        }

        header("Location: index.php");
        exit();
    }

    private function updateUser($postData) {
        $id = $postData['id'];
        $name = $postData['name'];
        $email = $postData['email'];
        $colors = isset($postData['colors']) ? $postData['colors'] : [];

        $this->userModel->updateUser($id, $name, $email, $colors);
    }

    private function createUser($postData) {
        $name = $postData['name'];
        $email = $postData['email'];
        $colors = isset($postData['colors']) ? $postData['colors'] : [];

        $this->userModel->createUser($name, $email, $colors);
    }
    public function delete($id) {
        $this->userModel->deleteUser($id);

        header("Location: index.php");
        exit();
    }

    public function getColorModel() {
        return $this->colorModel;
    }

    public function getUserModel() {
        return $this->userModel;
    }
}