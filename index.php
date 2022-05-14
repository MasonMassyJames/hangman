<?php

require_once __DIR__ . '/bootstrap.php';

if (!isset($_GET['q'])) {
    $_GET['q'] = 'home';
}

switch ($_GET['q']) {
    case '':
    case 'home':
    case 'index':
    case 'start':
        include_once __DIR__ . '/home.php';
        break;

    case 'change-lang':
        include_once __DIR__ . '/inc/change-lang.php';
        break;

    case 'play-multiplayer-insert':
        include_once __DIR__ . '/insert.php';
        break;

    case 'check-letter':
        include_once __DIR__ . '/inc/check-letter.php';
        break;

    case 'insert-word':
        include_once __DIR__ . '/inc/insert-word.php';
        break;

    case 'play-singleplayer':
    case 'play-multiplayer':
        if ($_GET['q'] == 'play-singleplayer' && !$_POST) {
            include __DIR__ . '/inc/createarray.php';
            $player = $_SESSION["player"];
        }

        if (isset($_SESSION["word"])) {

            $word = $_SESSION["word"];
            $lines = $_SESSION["lines"];
            $arrayWord = $_SESSION["arrayWord"];
            $letterCount = $_SESSION["letterCount"];
            $tries = $_SESSION["tries"];
            $player = $_SESSION["player"];

            $sideKickLang = $_SESSION['lang'];

            $_SESSION['lang'] = $sideKickLang;

        }
        
        include_once __DIR__ . '/guess.php';
        break;

    default:
        include_once __DIR__ . '/404.php';
        break;
}
