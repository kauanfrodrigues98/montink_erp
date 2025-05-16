<?php

use app\controllers\ProdutosController;

require_once('./app/controllers/ProdutosController.php');

$produtosController = new ProdutosController();

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $produto = new stdClass();
    $produto->uuid = $_POST['uuid'];
    $produto->nome = $_POST['nome'];
    $produto->descricao = $_POST['descricao'];
    $produto->preco_venda = $_POST['preco_venda'];
    $produto->adicionar_estoque = $_POST['adicionar_estoque'];

    $response = $produtosController->update($produto);

    $_SESSION['response_status'] = $response;

    if($response) {
        $_SESSION['response'] = 'Produto atualizado com sucesso!';
    } else {
        $_SESSION['response'] = 'Houve um problema ao atualizar o produto.';
    }

    header('Location: /produtos');
    exit;
}

if($_SERVER['REQUEST_METHOD'] == 'GET') {
    $produto = $produtosController->findOne($_GET['uuid']);
}

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card box-shadow">
                <div class="card-header">
                    Cadastro de produtos
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <input type="hidden" name="uuid" value="<?= $_GET['uuid'] ?>">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="">Nome do produto <span class="text-danger">*</span></label>
                                    <input type="text" id="nome" name="nome" class="form-control form-control-sm" required value="<?= $produto['name'] ?>">
                                </div>
        
                                <div class="col-md-6">
                                    <label for="">Descrição</label>
                                    <input type="text" id="descricao" name="descricao" class="form-control form-control-sm" value="<?= $produto['description'] ?>">
                                </div>
                            </div>
        
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="">Preço de Venda <span class="text-danger">*</span></label>
                                    <input type="text" id="preco_venda" name="preco_venda" class="form-control form-control-sm monetario" placeholder="0,00" required value="<?= $produto['sell_price'] ?>">
                                </div>
                                <!-- <div class="col-md-4">
                                    <label for="">Variações</label>
                                    <input type="text" id="variacoes" name="variacoes" class="form-control form-control-sm" value="<?= $produto['variacoes'] ?>">
                                </div> -->
        
                                <div class="col-md-4">
                                    <label for="">Adicionar ao estoque <span class="text-danger">*</span></label>
                                    <input type="number" id="adicionar_estoque" name="adicionar_estoque" class="form-control form-control-sm" placeholder="0" required value="<?= $produto['quantity'] ?>">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-between">
                                <a href="/produtos" class="btn btn-danger btn-sm">Cancelar</a>
                                <button type="submit" class="btn btn-success btn-sm">Salvar Alterações</button>
                            </div>
                        </div>
                    </form>
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