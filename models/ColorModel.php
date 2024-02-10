<?php

class ColorModel {
    private $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function getColors() {
        return $this->connection->query("SELECT * FROM colors");
    }
    
}