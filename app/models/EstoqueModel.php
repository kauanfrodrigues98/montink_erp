<?php

namespace app\models;

use PDO;

require_once __DIR__ . '/../../config/database.php';

class EstoqueModel {
    private $pdo;

    public function __construct() {
        $this->pdo = getConnection();
    }

    public function getAll(): array
    {
        $stmt = $this->pdo->query("SELECT uuid, name, sell_price FROM products");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @throws \Exception
     */
    public function create($estoque) {
        try {
            $this->pdo->beginTransaction();

            $stmt = $this->pdo->prepare("INSERT INTO stock (product_id, quantity) VALUES (:produto_id, :quantidade)");
            $stmt->bindParam(':produto_id', $estoque->produto_id);
            $stmt->bindParam(':quantidade', $estoque->quantidade);
            $stmt->execute();

            $this->pdo->commit();

            return true;
        } catch(\Exception $e) {
            $this->pdo->rollBack();
            throw new \Exception("Erro na transação: " . $e->getMessage());
        }
    }

    private function generateUUIDv4() {
        $data = random_bytes(16);

        // Ajusta os bits conforme o padrão UUID v4
        $data[6] = chr((ord($data[6]) & 0x0f) | 0x40); // versão 4
        $data[8] = chr((ord($data[8]) & 0x3f) | 0x80); // variante RFC 4122

        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }
}