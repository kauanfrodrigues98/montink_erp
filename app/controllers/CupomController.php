<?php

namespace app\controllers;

use app\services\CupomService;

require_once('./app/services/CupomService.php');;

class CupomController
{
    private CupomService $cupomService;

    public function __construct() {
        $this->cupomService = new CupomService();
    }

    public function getAll() {
        try {
            return $this->cupomService->getAll();
        } catch(\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function create($cupom) {
        try {
            return $this->cupomService->create($cupom);
        } catch(\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function findCupom($cupom) {
        try {
            return $this->cupomService->findCupom($cupom);
        } catch(\Exception $e) {
            echo $e->getMessage();
        }
    }
}