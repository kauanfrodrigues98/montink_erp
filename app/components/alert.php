<?php

$response_alert = $_SESSION['response'];
$_SESSION['response'] = '';

?>

<?php if($response_alert != ''): ?>
    <div class="container">
        <div class="alert <?= $_SESSION['response_status'] ? 'alert-success' : 'alert_danger' ?>">
            <?= $response_alert ?>
        </div>
    </div>
<?php endif; ?>