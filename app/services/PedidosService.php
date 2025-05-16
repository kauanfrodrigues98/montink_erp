<?php

namespace app\services;

include './app/models/PedidosModel.php';

use app\models\PedidosModel;

class PedidosService
{
    private PedidosModel $pedidosModel;

    public function __construct()
    {
        $this->pedidosModel = new PedidosModel();
    }

    public function create($pedido) {
        foreach($pedido->produtos as $item) {
            $objPedido = new \stdClass();
            $objPedido->product_id = $item->id;
            $objPedido->quantity = $item->quantity;
            $objPedido->subtotal = $pedido->subtotal;
            $objPedido->frete = $pedido->frete;
            $objPedido->total = $pedido->total;

            $this->pedidosModel->create($objPedido);
        }

        return true;
    }

    public function findAll() {
        return $this->pedidosModel->findAll();
    }

    public function sendEmail($email) {
        $to = $email;
        $subject = "Confirmação de Pedido";
        $message = "Seu pedido foi recebido com sucesso! Em breve você receberá mais informações.";
        $headers = "From: kauanfrodrigues98@gmail.com";

        return mail($to, $subject, $message, $headers);
    }
}