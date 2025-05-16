<?php
namespace app\controllers;

use app\services\ProdutosService;

require_once('./app/services/ProdutosService.php');;

class EstoqueController {
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
}