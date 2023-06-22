<?php
$tokens_data = json_decode(file_get_contents('../secure/tokens.json'), true);
$active_tokens = 0;
foreach($tokens_data as $token) {
    if (time() - $token['timestamp'] <= 300) {
        $active_tokens++;
    }
}
$total_tokens = count($tokens_data);
$image_files = glob('../uploads/*.jpg');
$image_size_bytes = 0;
foreach ($image_files as $image) {
    $image_size_bytes += filesize($image);
}
$image_size = formatBytes($image_size_bytes);

$response = array(
    "active tokens" => $active_tokens,
    "total tokens" => $total_tokens,
    "image storage" => [$image_size, $image_size_bytes]
);

echo json_encode($response);
function formatBytes($size) {
    $units = array('B', 'KB', 'MB', 'GB', 'TB');
    for ($i = 0; $size >= 1024 && $i < count($units) - 1; $i++) {
        $size /= 1024;
    }
    return round($size, 2) . ' ' . $units[$i];
}
?>