<?php

$arr_route = explode('/', $_SERVER['REQUEST_URI']);
$count_routes = count($arr_route);
$idx = 0;

?>

<div class="container">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <?php foreach($arr_route as $route){ $idx++; ?>
          <li class="breadcrumb-item <?= (array_key_last($arr_route) == $idx) ? 'active' : '' ?> text-capitalize" <?= (array_key_last($arr_route) == $idx) ? 'aria-current="page"' : '' ?>><?= trim(parse_url($route, PHP_URL_PATH), '/') ?></li>
        <?php }; ?>
      </ol>
    </nav>
</div>