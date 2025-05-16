<?php

require_once('./app/controllers/ProdutosController.php');;

use app\controllers\ProdutosController;

$controller = new ProdutosController();

if($_SERVER['REQUEST_METHOD'] != 'POST'){
    $produtos = $controller->getAll();
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
                            <span>Produtos Cadastrados</span>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="/produtos/cadastrar" type="button" class="btn btn-sm btn-success">Adicionar</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th class="text-center">Produto</th>
                                <th class="text-center">Preço Venda</th>
                                <th class="text-center">Qtd Estoque</th>
                                <th class="text-center"></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($produtos as $produto): ?>
                            <tr>
                                <td class="text-center"><?= $produto['name'] ?></td>
                                <td class="text-center">R$ <?= number_format($produto['sell_price'], 2, ',', '.') ?></td>
                                <td class="text-center"><?= $produto['quantity'] ?></td>
                                <td class="text-center"><a href="/produtos/atualizar?uuid=<?= $produto['uuid'] ?>" type="button" class="btn btn-sm btn-primary">Detalhes</button></td>
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

<script>
    function mascara(value) {
        const novoValor = new Intl.NumberFormat('pt-BR', {
            style: 'currency',
            currency: 'BRL'
        }).format(value)

        document.getElementById('preco_compra').value = novoValor;
    }
</script>