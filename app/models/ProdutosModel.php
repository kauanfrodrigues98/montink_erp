<?php

namespace app\models;

use PDO;

require_once __DIR__ . '/../../config/database.php';

class ProdutosModel {
    private $pdo;

    public function __construct() {
        $this->pdo = getConnection();
    }

    public function getAll(): array
    {
        $stmt = $this->pdo->query("SELECT p.uuid, p.name, p.description, p.sell_price, s.quantity FROM products p JOIN stock s ON p.id = s.product_id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @throws \Exception
     */
    public function create($produto) {
        try {
            $preco_venda  = str_replace(['.', ','], ['', '.'], $produto->preco_venda);

            $this->pdo->beginTransaction();

            $stmt = $this->pdo->prepare("INSERT INTO products (name, description, sell_price) 
                                     VALUES (:nome, :descricao, :preco_venda)");
            $stmt->bindParam(':nome', $produto->nome);
            $stmt->bindParam(':descricao', $produto->descricao);
            $stmt->bindParam(':preco_venda', $preco_venda);
            $stmt->execute();

            $productId = $this->pdo->lastInsertId();

            $this->pdo->commit();

            return $productId;
        } catch(\Exception $e) {
            $this->pdo->rollBack();
            throw new \Exception("Erro na transação: " . $e->getMessage());
        }
    }

    public function getAllProductForOrder(): array
    {
        try {
            $stmt = $this->pdo->query("SELECT p.id, p.uuid, p.name, p.description, p.sell_price FROM products p JOIN stock s ON p.id = s.product_id WHERE s.quantity > 0");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(\Exception $e) {
            $this->pdo->rollBack();
            throw new \Exception("Erro na transação: " . $e->getMessage());
        }
    }

    public function findOne($uuid): array
    {
        try {
            $stmt = $this->pdo->prepare("SELECT p.id, p.uuid, p.name, p.description, p.sell_price, s.quantity FROM products p JOIN stock s ON p.id = s.product_id WHERE p.uuid = :uuid");
            $stmt->bindParam('uuid', $uuid);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(\Exception $e) {
            $this->pdo->rollBack();
            throw new \Exception("Erro na transação: " . $e->getMessage());
        }
    }

    public function update($produto)
    {
        try {
            $preco_venda = str_replace(['.', ','], ['', '.'], $produto->preco_venda);

            $this->pdo->beginTransaction();

            $stmt = $this->pdo->prepare("UPDATE products SET name = :nome, description = :descricao, sell_price = :preco_venda WHERE uuid = :uuid");
            $stmt->bindParam(':nome', $produto->nome);
            $stmt->bindParam(':descricao', $produto->descricao); 
            $stmt->bindParam(':preco_venda', $preco_venda);
            $stmt->bindParam(':uuid', $produto->uuid);
            $stmt->execute();

            $stmt = $this->pdo->prepare("UPDATE stock SET quantity = :quantidade WHERE product_id = (SELECT id FROM products WHERE uuid = :uuid)");
            $stmt->bindParam(':quantidade', $produto->adicionar_estoque);
            $stmt->bindParam(':uuid', $produto->uuid);
            $stmt->execute();

            $this->pdo->commit();

            return true;
        } catch(\Exception $e) {
            $this->pdo->rollBack();
            throw new \Exception("Erro na transação: " . $e->getMessage());
        }
    }
}