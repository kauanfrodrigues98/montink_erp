<?php

namespace app\services;

include './app/models/EstoqueModel.php';

use app\models\EstoqueModel;

class EstoqueService
{
    private EstoqueModel $estoqueModel;

    public function __construct() {
        $this->estoqueModel = new EstoqueModel();
    }

    public function getAll() {
        return $this->estoqueModel->getAll();
    }

    public function create($produto) {
        return $this->estoqueModel->create($produto);
    }
}