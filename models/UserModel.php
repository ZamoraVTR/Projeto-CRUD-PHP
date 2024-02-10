<?php
class UserModel {
    private $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function getUsers() {
        return $this->connection->query("SELECT * FROM users");
    }

    public function getUserById($id) {
        $query = "SELECT * FROM users WHERE id = $id";
        return $this->connection->query($query)->fetch(PDO::FETCH_OBJ);
    }

    public function getUserColors($id) {
        $query = "SELECT c.name FROM colors c 
                  JOIN user_colors uc ON c.id = uc.color_id
                  WHERE uc.user_id = $id";
        return $this->connection->query($query)->fetchAll(PDO::FETCH_COLUMN);
    }

    public function updateUser($id, $name, $email, $colors) {
        $query = "UPDATE users SET name = '$name', email = '$email' WHERE id = $id";
        $this->connection->query($query);

        // Limpa vinculações existentes
        $query = "DELETE FROM user_colors WHERE user_id = $id";
        $this->connection->query($query);

        // Vincula cores selecionadas
        foreach ($colors as $colorId) {
            $query = "INSERT INTO user_colors (user_id, color_id) VALUES ($id, $colorId)";
            $this->connection->query($query);
        }
    }

    public function createUser($name, $email, $colors) {
        $query = "INSERT INTO users (name, email) VALUES ('$name', '$email')";
        $this->connection->query($query);

        $lastUserId = $this->connection->getConnection()->lastInsertId();

        // Vincula cores selecionadas
        foreach ($colors as $colorId) {
            $query = "INSERT INTO user_colors (user_id, color_id) VALUES ($lastUserId, $colorId)";
            $this->connection->query($query);
        }
    }

    public function deleteUser($id) {
        $query = "DELETE FROM users WHERE id = $id";
        $this->connection->query($query);

        // Exclui vinculações de cores
        $query = "DELETE FROM user_colors WHERE user_id = $id";
        $this->connection->query($query);
    }
}