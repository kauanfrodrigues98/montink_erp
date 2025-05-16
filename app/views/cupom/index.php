<?php

require_once('./app/controllers/CupomController.php');;

use app\controllers\CupomController;

if($_SERVER['REQUEST_METHOD'] != 'POST'){
    $controller = new CupomController();
    $cupons = $controller->getAll();
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
                            <span>Cupons Cadastrados</span>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="/cupom/cadastrar" type="button" class="btn btn-sm btn-success">Adicionar</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th class="text-center">Cupom</th>
                                <th class="text-center">Validade</th>
                                <th class="text-center">Valor Desconto (%)</th>
                                <th class="text-center">Valor Minimo</th>
                                <th class="text-center">Status</th>
                                <th class="text-center"></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($cupons as $cupom): ?>
                            <tr>
                                <td class="text-center"><?= $cupom['code'] ?></td>
                                <td class="text-center"><?= Datetime::createFromFormat('Y-m-d', $cupom['valid_at'])->format('d/m/Y') ?></td>
                                <td class="text-center"><?= number_format($cupom['discount'], 2, ',', '.') ?></td>
                                <td class="text-center"><?= number_format($cupom['min_price'], 2, ',', '.') ?></td>
                                <td class="text-center"><?= $cupom['active'] ? '<span class="badge text-bg-success">Ativo</span>' : '<span class="badge text-bg-danger">Inativo</span>' ?></td>
                                <td class="text-center"><button type="button" class="btn btn-sm btn-primary">Detalhes</button></td>
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