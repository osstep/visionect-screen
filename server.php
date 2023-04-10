<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

if (isset($_GET['url'])) {
    $url = $_GET['url'];
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Missing URL parameter']);
    exit();
}

// Используем cURL для получения данных RSS
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
$data = curl_exec($ch);
curl_close($ch);

// Если удалось получить данные RSS, обработаем их и отправим ответ клиенту
if ($data) {
    $xml = simplexml_load_string($data);
    $items = $xml->xpath('//item');
    $result = [];
    foreach ($items as $item) {
        $title = (string) $item->title;
        $link = (string) $item->link;
        $description = (string) $item->description;
        $pubDate = (string) $item->pubDate;
        $result[] = [
            'title' => $title,
            'link' => $link,
            'description' => $description,
            'pubDate' => $pubDate,
        ];
    }
    echo json_encode($result);
} else {
    http_response_code(500);
}