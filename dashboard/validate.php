<?php
//This script acts like a security bridge between the front-end changes and the secured folders. 
// This way, the javascript files can't acces, trigger or show the secured scripts. Some actions require another login.
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $action = $_POST['action'];

    // these actions have a large effect and require a login to continue
    $logins = json_decode(file_get_contents('../secure/users.json'), true);
    $password = $_POST['password'];
    $username = $_SESSION['username'];
    if ($logins[$username] == $password) {
        if ($action == 'delete all tokens') {
            include('../secured-scripts/deleteAllTokens.php');
            echo ('all tokens deleted succesfully');
        } else if ($action == 'delete expired tokens') {
            include('../secured-scripts/deleteExpiredTokens.php');
            echo ('expired tokens deleted succesfully');
        } else {
            include('../secured-scripts/deleteAllImages.php');
            echo ('all images deleted succesfully');
        }
    } else {
        echo ('password is incorrect');
    }
}
