<?php

use app\controllers\CupomController;

require_once('./app/controllers/CupomController.php');;

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cupom = new stdClass();
    $cupom->code = $_POST['code'];
    $cupom->discount = $_POST['discount'];
    $cupom->valid_at = $_POST['valid_at'];
    $cupom->min_price = $_POST['min_price'];;

    $controller = new CupomController();
    $response = $controller->create($cupom);

    if($response) {
        $_SESSION['response'] = 'Cupom cadastrado com sucesso!';
    } else {
        $_SESSION['response'] = 'Houve um problema ao cadastrar cupom.';
    }

    header('Location: /cupom');
    exit;
}

?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card box-shadow">
                <div class="card-header">
                    Cadastro de Cupom
                </div>
                <div class="card-body">
                    <form action="" method="post">
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="code">Código <span class="text-danger">*</span></label>
                                    <input type="text" id="code" name="code" class="form-control form-control-sm" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="discount">Valor Desconto (%) <span class="text-danger">*</span></label>
                                    <input type="text" id="discount" name="discount" class="form-control form-control-sm monetario" placeholder="0,00" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="valid_at">Validade <span class="text-danger">*</span></label>
                                    <input type="date" id="valid_at" name="valid_at" class="form-control form-control-sm" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="min_price">Valor Minimo de Compra <span class="text-danger">*</span></label>
                                    <input type="text" id="min_price" name="min_price" class="form-control form-control-sm monetario" placeholder="0,00" required>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-between">
                                <a href="/cupom" class="btn btn-danger btn-sm">Cancelar</a>
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