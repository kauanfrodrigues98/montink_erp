<?php

use app\controllers\ProdutosController;

require_once('./app/controllers/ProdutosController.php');;

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $produto = new stdClass();
    $produto->nome = $_POST['nome'];
    $produto->descricao = $_POST['descricao'];
    $produto->preco_venda = $_POST['preco_venda'];
    // $produto->variacoes = $_POST['variacoes'];
    $produto->adicionar_estoque = $_POST['adicionar_estoque'];

    $controller = new ProdutosController();
    $response = $controller->create($produto);

    $_SESSION['response_status'] = $response;

    if($response) {
        $_SESSION['response'] = 'Produto cadastrado com sucesso!';
    } else {
        $_SESSION['response'] = 'Houve um problema ao cadastrar o produto.';
    }
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
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="">Nome do produto <span class="text-danger">*</span></label>
                                    <input type="text" id="nome" name="nome" class="form-control form-control-sm" required>
                                </div>
        
                                <div class="col-md-6">
                                    <label for="">Descrição</label>
                                    <input type="text" id="descricao" name="descricao" class="form-control form-control-sm">
                                </div>
                            </div>
        
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="">Preço de Venda <span class="text-danger">*</span></label>
                                    <input type="text" id="preco_venda" name="preco_venda" class="form-control form-control-sm monetario" placeholder="0,00" required>
                                </div>
                                <!-- <div class="col-md-4">
                                    <label for="">Variações</label>
                                    <input type="text" id="variacoes" name="variacoes" class="form-control form-control-sm">
                                </div> -->
        
                                <div class="col-md-4">
                                    <label for="">Adicionar ao estoque <span class="text-danger">*</span></label>
                                    <input type="number" id="adicionar_estoque" name="adicionar_estoque" class="form-control form-control-sm" placeholder="0" required>
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