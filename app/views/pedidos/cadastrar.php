<?php

use app\controllers\CupomController;
use app\controllers\PedidosController;
use app\controllers\ProdutosController;

require_once('./app/controllers/CupomController.php');
require_once('./app/controllers/ProdutosController.php');
require_once('./app/controllers/PedidosController.php');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pedidosController = new PedidosController();

    $pedido = new stdClass();
    $pedido->produtos = $_SESSION['carrinho'];
    $pedido->frete = $_POST['frete_hidden'];
    $pedido->subtotal = $_POST['subtotal_hidden'];
    $pedido->total = $_POST['total_hidden'];

    $response = $pedidosController->create($pedido);
}

$produtosController = new ProdutosController();

$produtos = $produtosController->getAllProductForOrder();

if(isset($_GET['limpar_carrinho']) && $_GET['limpar_carrinho'] === 'true') {
    $_SESSION['carrinho'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['cupom'])) {
    $cupom = $_GET['cupom'];
    $$cep = $_GET['cep'];

    $cupomController = new CupomController();
    $cupomController->findCupom($cupom);
    $cupomLocalizado = $cupomController->findCupom($cupom);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['add'])) {
    $id = $_GET['id'];
    $uuid = $_GET['add'];
    $name = $_GET['name'];
    $sell_price = $_GET['sell_price'];

    // Criar objeto produto
    $addProduto = new stdClass();
    $addProduto->id = $id;
    $addProduto->uuid = $uuid;
    $addProduto->name = $name;
    $addProduto->sell_price = $sell_price;
    $addProduto->quantity = 1;

    // Iniciar o carrinho se ainda não existir
    if (!isset($_SESSION['carrinho'])) {
        $_SESSION['carrinho'] = [];
    }

    // Verificar se já tem esse produto no carrinho
    $produtoExiste = false;
    foreach ($_SESSION['carrinho'] as $item) {
        if ($item->uuid === $uuid) {
            $produtoExiste = true;
            break;
        }
    }

    // Adicionar somente se não existir ainda
    if (!$produtoExiste) {
        $_SESSION['carrinho'][] = $addProduto;
    }

    // Redirecionar
    header("Location: /pedidos/cadastrar");
    exit;
}
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-9">
            <div class="card box-shadow">
                <div class="card-header">
                    Listagem de Produtos
                </div>
                <div class="card-body" style="overflow: auto; min-height: 70vh; max-height: 70vh;">
                    <div class="row">
                        <?php foreach($produtos as $produto): ?>
                            <div class="col-md-3 mb-3">
                                <div class="card box-shadow" style="width: 18rem;">
                                    <div class="card-body">
                                        <h5 class="card-title"><?= $produto['name'] ?></h5>
                                        <h6 class="card-subtitle mb-2 text-body-secondary">R$ <?= number_format($produto['sell_price'], 2, ',', '.') ?></h6>
                                        <p class="card-text"><?= $produto['description'] ?></p>
                                        <a href="?add=<?= $produto['uuid'] ?>&name=<?= $produto['name'] ?>&sell_price=<?= $produto['sell_price'] ?>&id=<?= $produto['id'] ?>" class="btn btn-sm btn-success">Comprar</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card box-shadow">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <span class="font-bold text-lg text-start">Carrinho</span>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="?limpar_carrinho=true" class="btn btn-sm btn-danger text-end">
                                Limpar Carrinho
                            </a>
                        </div>
                    </div>
                </div>
                <form action="" method="POST">
                    <div class="card-body" style="max-height: 70vh; overflow: auto;">
                        <table class="table table-sm table-striped" style="max-height: 300px; overflow: auto;">
                            <thead>
                            <tr>
                                <th>Produto</th>
                                <th>Prç Unit</th>
                                <th>Qtd</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $subtotal = 0; ?>
                                <?php foreach($_SESSION['carrinho'] as $item): $subtotal = $subtotal + ($item->quantity * $item->sell_price); ?>
                                    <tr>
                                        <td><?= $item->name ?></td>
                                        <td><?= number_format($item->sell_price, 2, ',', '.') ?></td>
                                        <td><?= $item->quantity ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
    
                        <div class="row mb-3">
                            <div class="col-md-12 mb-3">
                                <label for="">CEP</label>
                                <input type="text" id="cep" name="cep" class="form-control form-control-sm" onkeyup="getCep(this.value)" maxlength="8">
                            </div>
                            <div class="col-md-12 mb-3">
                                <small id="endereco"></small>
                            </div>
                            <!-- <div class="col-md-12 mb-3">
                                <label for="">Cupom</label>
                                <input type="text" id="cupom" name="cupom" class="form-control form-control-sm">
                            </div>
                            <div class="col-md-12 mb-3">
                                <button class="btn btn-sm btn-primary" onclick="aplicarCupom()">Aplicar Cupom</button>
                            </div> -->
                            <div class="col-md-12 mb-3">
                                <input type="hidden" id="subtotal_hidden" name="subtotal_hidden" value="<?= $subtotal ?>">
                                <span>Subtotal: R$ <?= number_format($subtotal, 2, ',', '.') ?></span>
                            </div>
                            <div class="col-md-12">
                                <input type="hidden" id="frete_hidden" name="frete_hidden">
                                <span id="spanFrete">Frete: R$ 0,00</span>
                            </div>
                            <div class="col-md-12">
                                <input type="hidden" id="total_hidden" name="total_hidden">
                                <span id="spanTotal">Total: R$ 0,00</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-sm btn-success" style="width: 100%;">Finalizar Pedido</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style scoped>
    div.box-shadow {
       box-shadow: 0 5px 10px #e1e1e1; 
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    const axiosViaCep = axios.create({
        baseURL: 'https://viacep.com.br/ws/'
    })

    const getCep = async (cep) => {
        if(cep.length < 8) return;

        axiosViaCep.get(`${cep}/json`)
            .then(response => {
                document.getElementById('endereco').innerHTML = `${response.data.logradouro}, ${response.data.bairro}, ${response.data.localidade} - ${response.data.uf}`

                calcularFrete()
            })
            .catch(error => {
                alert('Houve um erro ao consultar o CEP informado. Verifique e tente novamente.')
            })
    }

    const aplicarCupom = () => {
        const cupom = document.getElementById('cupom').value
        const cep = document.getElementById('cep').value
    
        if(cupom.length < 3) return;
    
        window.location.href = `/pedidos/cadastrar?cupom=${cupom}&cep=${cep}`
    }

    /**
     *  Caso o subtotal do pedido tenha entre R$52,00 e R$166,59, o frete do pedido deve ser R$15,00.
     *  Caso o subtotal seja maior que R$200,00, frete grátis. Para outros valores, o frete deve custar R$20,00.
     */
    const calcularFrete = () => {
        let subtotal = document.getElementById('subtotal_hidden').value;
        let frete = 0

        if(subtotal >= 52 && subtotal <= 166.59) {
            frete = 15
        } else if(subtotal < 52) {
            frete = 20

        } else if(subtotal > 200) {
            frete = 0
        }

        subtotal = parseFloat(subtotal) + parseFloat(frete)

        document.getElementById('frete_hidden').value = frete
        document.getElementById('total_hidden').value = subtotal

        let subtotalFormat = new Intl.NumberFormat('pt-BR', {
            style: 'currency',
            currency: 'BRL'
        }).format(subtotal)

        let freteFormat = new Intl.NumberFormat('pt-BR', {
            style: 'currency',
            currency: 'BRL'
        }).format(frete)

        document.getElementById('spanFrete').innerHTML = `Frete: R$ ${freteFormat}`
        document.getElementById('spanTotal').innerHTML = `Total: R$ ${subtotalFormat}`
    }
</script>