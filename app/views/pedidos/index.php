<?php

require_once('./app/controllers/PedidosController.php');;

use app\controllers\PedidosController;

if($_SERVER['REQUEST_METHOD'] != 'POST'){
    $controller = new PedidosController();
    $pedidos = $controller->findAll();
}

?>

<?php include './app/components/alert.php'; ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card box-shadow">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <span>Lista de Pedidos</span>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="/pedidos/cadastrar" type="button" class="btn btn-sm btn-success">Novo Pedido</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th class="text-center">Produto</th>
                                <th class="text-center">Qtd</th>
                                <th class="text-center">Valor Unit</th>
                                <th class="text-center">Subtotal</th>
                                <th class="text-center">Frete</th>
                                <th class="text-center">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($pedidos as $pedido): ?>
                            <tr>
                                <td class="text-center"><?= $pedido['name'] ?></td>
                                <td class="text-center"><?= $pedido['quantity'] ?></td>
                                <td class="text-center"><?= number_format($pedido['sell_price'], 2, ',', '.') ?></td>
                                <td class="text-center"><?= number_format($pedido['subtotal'], 2, ',', '.') ?></td>
                                <td class="text-center"><?= number_format($pedido['frete'], 2, ',', '.') ?></td>
                                <td class="text-center"><?= number_format($pedido['total'], 2, ',', '.') ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<style scoped>
    div.box-shadow {
       box-shadow: 0 5px 10px #e1e1e1; 
    }
</style>