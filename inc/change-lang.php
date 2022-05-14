<?php 

require_once dirname(__DIR__) . '/bootstrap.php';

if (isset($_POST['lang']) && $_POST['lang'] == 'it') {
    $_SESSION['lang'] = 'it';
} else {
    $_SESSION['lang'] = 'en';
}

echo json_encode($_SESSION['lang']);