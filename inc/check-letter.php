<?php

if (isset($_POST['l'])) {

    $response = [];

    $tries = (int) $_POST['tries'];
    $lines = json_decode($_POST['lines']);
    $word = $_SESSION['word'];

    $letter = mb_strtoupper($_POST['letter']);
    // $letter = $_POST['letter'];

    if (mb_strlen($letter) != 1) {
        echo '<script> alert(LANG["insert one letter"][lang]); </script>';
    }

    $pos = strpos($word, $letter);
    if ($pos !== FALSE) {
        while ($pos !== FALSE) {
            $lines[$pos] = $letter;
            $pos = strpos($word, $letter, $pos + 1);
        }
    } else {
        $tries--;
    }

    $response = 
    [
        'tries' => $tries,
        'lines' => $lines,
        'word' => $word,
    ];

    if ($tries == 0) {
        $tryToGuess_or_hanged_msg = $trans['you were hanged'][$lang];
        $wordToGuess_or_wordWas_msg = $trans['word was'][$lang];
        session_destroy();
        $sentences = [
            'tryToGuess_or_hanged_msg' => $tryToGuess_or_hanged_msg,
            'wordToGuess_or_wordWas_msg' => $wordToGuess_or_wordWas_msg,
            'word' => $word,
        ];
        $response = array_merge($response, $sentences);
    } 

    echo json_encode($response);
}
