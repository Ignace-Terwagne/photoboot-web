<?php
$config_data = json_decode(file_get_contents('../secure/config.json'), true);
$config_data['expiration'] = true;
file_put_contents('../secure/config.json', $config_data);
?>