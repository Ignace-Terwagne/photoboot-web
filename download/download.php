<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tokens_data = json_decode(file_get_contents('../secure/tokens.json'), true);
    $token = $_POST['token'];
    $path = "../" . $tokens_data[$token]['path'];

    if (file_exists($path)) {
        echo '<img src="'.$path.'" >';

        $filename = 'photoboot_' . date('Ymd_His') . '.jpg';

        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Content-Length: ' . filesize($path));

        ob_clean();
        flush();

        $file = fopen($path, 'rb');
        while (!feof($file)) {
            echo fread($file, 4096);
        }
        fclose($file);

        exit;
    } else {
        echo "File not found.";
    }
}
?>
