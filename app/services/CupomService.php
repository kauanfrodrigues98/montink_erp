<?php

namespace app\services;

use app\models\CupomModel;

require_once './app/models/CupomModel.php';

class CupomService
{
    private CupomModel $cupomModel;

    public function __construct() {
        $this->cupomModel = new CupomModel();
    }

    public function getAll() {
        return $this->cupomModel->getAll();
    }

    public function create($cupom) {
        return $this->cupomModel->create($cupom);
    }

    public function findCupom($cupom) {
        return $this->cupomModel->findCupom($cupom);
    }
}