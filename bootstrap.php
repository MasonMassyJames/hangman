<?php 

//  If session is not set, start it
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Set default lang
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'en';
    $lang = 'en';
} else {
    $lang = $_SESSION['lang'];
}

// Get translation, put them in session and create js array
require_once __DIR__ . '/inc/translation.php';

