<?php

namespace app\models;

use PDO;

require_once __DIR__ . '/../../config/database.php';

class CupomModel
{
    private $pdo;

    public function __construct() {
        $this->pdo = getConnection();
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM coupons");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($cupom) {
        try {
            $min_price = str_replace(['.', ','], ['', '.'], $cupom->min_price);

            $this->pdo->beginTransaction();

            $stmt = $this->pdo->prepare("INSERT INTO coupons (code, discount, min_price, valid_at) 
                                     VALUES (:code, :discount, :min_price, :valid_at)");
            $stmt->bindParam(':code', $cupom->code);
            $stmt->bindParam(':discount', $cupom->discount);
            $stmt->bindParam(':min_price', $min_price);
            $stmt->bindParam(':valid_at', $cupom->valid_at);
            $stmt->execute();

            $productId = $this->pdo->lastInsertId();

            $this->pdo->commit();

            return $productId;
        } catch(\Exception $e) {
            $this->pdo->rollBack();
            throw new \Exception("Erro na transação: " . $e->getMessage());
        }
    }

    public function findCupom($cupom) {
        $stmt = $this->pdo->prepare("SELECT * FROM coupons WHERE code = :cupom");
        $stmt->bindParam(':cupom', $cupom);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}