<?php
session_start();
if (isset($_SESSION['loggedin'])) {
    include("index.html");
} else {
    header("location: ../login");
    exit();
}
?>