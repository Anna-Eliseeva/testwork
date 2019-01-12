<?php

if(!array_key_exists('col', $_GET)) {
    $response = [
        'statusCode' => 0,
        'message' => 'Не были переданны все необходимые данные на сервер!',
    ];
    header('Status: 400 Bad Request');
    echo json_encode($response);
    exit();
}

define('DB_HOST', 'localhost');
define('DB_NAME', 'testcount');
define('DB_USER', 'root');
define('DB_PASS', 'lancer52662699');
define('DB_CHARSET', 'utf8');

$dsn = sprintf('mysql:host=%s;dbname=%s;charset=%s', DB_HOST, DB_NAME, DB_CHARSET);
try {
    $productCount = (int)$_GET['col'];
    $dbh = new PDO($dsn, DB_USER, DB_PASS);

    // Проверяем на существовании записи в бд по ip
    $query = 'SELECT `id`, COUNT(*) AS `count` FROM `cart` WHERE `ip` = INET_ATON(:ip)';
    $stmt = $dbh->prepare($query);
    $stmt->execute([':ip' => $_SERVER['REMOTE_ADDR']]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if($result['count']) {
        // Удаляем существующую запись
        $query = 'DELETE FROM `cart` WHERE `id` = :id';
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':id', $result['id'], PDO::PARAM_INT);
        $stmt->execute();
    }

    // Добавляем новую запись
    $query = 'INSERT INTO `cart` (`ip`, `count`) VALUES (INET_ATON(:ip), :count);';
    $stmt = $dbh->prepare($query);
    $stmt->bindParam(':ip', $_SERVER['REMOTE_ADDR']);
    $stmt->bindParam(':count', $productCount, PDO::PARAM_INT);
    $stmt->execute();
    $dbh = null;
} catch(\Exception $e) {
    $response = [
        'statusCode' => 0,
        'message' => 'произошла ошибка при подключении к БД!',
    ];
    $dbh = null;
    header('Status: 502 Bad Gateway');
    echo json_encode($response);
    exit();
}

header('Status: 200 OK');
$response = [
    'statusCode' => 1,
    'message' => 'Товар добавлен в корзину.',
];
echo json_encode($response);
exit();
