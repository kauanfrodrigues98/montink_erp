<?php

namespace app\services;

include './app/models/ProdutosModel.php';
include './app/models/EstoqueModel.php';

use app\models\EstoqueModel;
use app\models\ProdutosModel;
use stdClass;

class ProdutosService
{
    private ProdutosModel $produtosModel;
    private EstoqueModel $estoqueModel;

    public function __construct() {
        $this->produtosModel = new ProdutosModel();
        $this->estoqueModel = new EstoqueModel();
    }

    public function getAll() {
        return $this->produtosModel->getAll();
    }

    public function create($produto) {
        $produto_id = $this->produtosModel->create($produto);

        $estoque = new stdClass();
        $estoque->produto_id = $produto_id;
        $estoque->quantidade = $produto->adicionar_estoque;

        return $this->estoqueModel->create($estoque);
    }
    public function getAllProductForOrder() {
        return $this->produtosModel->getAllProductForOrder();
    }

    public function findOne($uuid) {
        return $this->produtosModel->findOne($uuid);
    }

    public function update($produto) {
        return $this->produtosModel->update($produto);
    }
}