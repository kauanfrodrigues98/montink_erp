<?php
namespace app\controllers;

use app\services\ProdutosService;

require_once('./app/services/ProdutosService.php');;

class ProdutosController {
    private ProdutosService $produtosService;

    public function __construct() {
        $this->produtosService = new ProdutosService();
    }

    public function getAll() {
        try {
            return $this->produtosService->getAll();
        } catch(\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function create($dados) {
        try {
            return $this->produtosService->create($dados);
        } catch(\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getAllProductForOrder() {
        try {
            return $this->produtosService->getAllProductForOrder();
        } catch(\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function findOne($uuid) {
        try {
            return $this->produtosService->findOne($uuid);
        } catch(\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function update($produto) {
        try {
            return $this->produtosService->update($produto);
        } catch(\Exception $e) {
            echo $e->getMessage();
        }  
    }
}