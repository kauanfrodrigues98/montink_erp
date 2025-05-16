<?php

namespace app\controllers;

require './app/services/PedidosService.php';

use app\services\PedidosService;

class PedidosController
{
    private PedidosService $pedidosService;

    public function __construct() {
        $this->pedidosService = new PedidosService();
    }

    public function create($pedido) {
        try {
            $this->pedidosService->create($pedido);
            $this->pedidosService->sendEmail($pedido->email);
            return true;
        } catch(\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function findAll() {
        try {
            return $this->pedidosService->findAll();
        } catch(\Exception $e) {
            echo $e->getMessage();
        }
    }
}