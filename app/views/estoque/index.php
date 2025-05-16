<?php

require_once('./app/controllers/EstoqueController.php');;

use app\controllers\EstoqueController;

if($_SERVER['REQUEST_METHOD'] != 'POST'){
    $controller = new EstoqueController();
    $estoques = $controller->getAll();
}

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card box-shadow">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <span>Consulta de Estoque</span>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th class="text-center">Produto</th>
                                <th class="text-center">Quantidade</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($estoques as $estoque): ?>
                            <tr>
                                <td class="text-center"><?= $estoque['name'] ?></td>
                                <td class="text-center"><?= $estoque['quantity'] ?></td>
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