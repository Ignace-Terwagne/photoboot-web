<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tokens_data = json_decode(file_get_contents('secure/tokens.json'),true);
    $token = $_POST['token'];
    $path = $tokens_data[$token]['path'];
    $filename = 'photoboot_' . date('Ymd_His') . '.jpg';
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='. $filename);
    header('Content-Length: ' . filesize($path));

    readfile($path);
    exit;
}
?>