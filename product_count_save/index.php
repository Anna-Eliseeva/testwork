<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'testcount');
define('DB_CHARSET', 'utf8');
define('DB_USER', 'root');
define('DB_PASS', 'lancer52662699');
$dsn = sprintf('mysql:dbname=%s;host=%s;charset=%s', DB_NAME, DB_HOST, DB_CHARSET);
try {
    $dbh = new PDO($dsn, DB_USER, DB_PASS);
    $query = 'SELECT `count` FROM `cart` WHERE `ip` = INET_ATON(:ip)';
    $stmt = $dbh->prepare($query);
    $stmt->execute([':ip' => $_SERVER['REMOTE_ADDR']]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result && array_key_exists('count', $result)) {
        $productCount = $result['count'];
    } else {
        $productCount = 0;
    }
} catch (\Exception $e) {
    $productCount = 0;
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="script.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
            integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
            crossorigin="anonymous"></script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<div class="wrapper container">
    <div class="alert" role="alert" style="display: none;">
        <strong class="alert-header"></strong>
        <span class="alert-body"></span>
    </div>
    <form class="row" id="product-form">
        <div class="col-md-3">
            <button type="button" data-type="decrement"
                    class="btn btn-success" <?= $productCount < 1 ? 'disabled' : ''; ?> >-
            </button>
            <input id="product-count" type="number" size="5" min="0" value="<?= $productCount; ?>"/>
            <button type="button" data-type="increment" class="btn btn-success">+</button>
        </div>

        <div>
            <button type="button" id="buy-button" class="btn btn-warning">Купить</button>
        </div>
    </form>
</div>
</body>
</html>