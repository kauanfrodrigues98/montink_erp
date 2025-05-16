<?php

namespace app\models;

use PDO;

require_once __DIR__ . '/../../config/database.php';

class PedidosModel
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = getConnection();
    }

    public function create($pedido) {
        try {
            $this->pdo->beginTransaction();

            $stmt = $this->pdo->prepare("INSERT INTO orders (product_id, quantity, subtotal, frete, total) 
                                     VALUES (:product_id, :quantity, :subtotal, :frete, :total)");
            $stmt->bindParam(':product_id', $pedido->product_id);
            $stmt->bindParam(':quantity', $pedido->quantity);
            $stmt->bindParam(':subtotal', $pedido->subtotal);
            $stmt->bindParam(':frete', $pedido->frete);
            $stmt->bindParam(':total', $pedido->total);
            $stmt->execute();

            $productId = $this->pdo->lastInsertId();

            $this->pdo->commit();

            return $pedido;
        } catch(\Exception $e) {
            $this->pdo->rollBack();
            throw new \Exception("Erro na transação: " . $e->getMessage());
        }
    }

    public function findAll() {
        $stmt = $this->pdo->query("SELECT o.subtotal, o.frete, o.total, o.quantity, p.name, p.sell_price FROM orders as o JOIN products as p ON o.product_id = p.id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}