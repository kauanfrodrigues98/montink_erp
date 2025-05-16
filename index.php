<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MONTINK ERP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <?php 
        session_start();

        $method = $_SERVER['REQUEST_METHOD'];

        include './app/views/layouts/admin.php';
        $pagina = $_SERVER['REQUEST_URI'] ?? '/';

        $pagina = parse_url($pagina, PHP_URL_PATH);

        $arquivo = match ($pagina) {
            '/'                     => './app/views/home.php',
            '/produtos'             => './app/views/produtos/index.php',
            '/produtos/cadastrar'   => './app/views/produtos/cadastrar.php',
            '/produtos/atualizar'   => './app/views/produtos/atualizar.php',
            '/cupom'                => './app/views/cupom/index.php',
            '/cupom/cadastrar'      => './app/views/cupom/cadastrar.php',
            '/pedidos'              => './app/views/pedidos/index.php',
            '/pedidos/cadastrar'    => './app/views/pedidos/cadastrar.php',
            '/estoque'              => './app/views/estoque/index.php',
            '/estoque/cadastrar'    => './app/views/estoque/cadastrar.php',
            default                 => 'paginas/404.php',
        };
    ?>
        <main>
            <?php include './app/components/breadcrumb.php'; ?>

            <?php include $arquivo; ?>
        </main>
    <?php include 'includes/footer.php'; ?>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.monetario').mask("#.##0,00", {reverse: true});
        });
    </script>
</body>
</html>
