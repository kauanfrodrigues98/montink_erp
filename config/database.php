<?php
// Define constantes do banco
define('DB_HOST', 'localhost');
define('DB_USER', 'kauan');
define('DB_PASS', 'aquario98');
define('DB_NAME', 'montink_erp');

// Função para retornar a conexão PDO
function getConnection() {
    try {
        $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch(PDOException $e) {
        echo "Erro na conexão: " . $e->getMessage();
        die();
    }
}