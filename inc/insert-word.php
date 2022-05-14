<?php 


if (isset($_POST['ins'])) {

    $word = $_POST['word'] ?? '';

    if (
        strpos($word, ' ') !== false
        || !$word
        || preg_match('/[\'^£$%&*()}§{@#~?><>,|=_+¬-]/', $word)
        || preg_match('~[0-9]+~', $word)
    ) {
        echo json_encode(['status' => 'error', 'message' => $trans['insert a word with letter only'][$lang]]);
    } else {
        $word = mb_strtoupper($word);
        $letterCount = mb_strlen($word);
        $letterCount2 = mb_strlen($word);
        $arrayWord = array();

        for ($i = 0; $i < $letterCount; $i++) {
            $arrayWord[$i] = mb_substr($word, $i);
        }

        $lines = array();
        for ($i = 0; $i < $letterCount; $i++) {
            $lines[$i] = "_";
        }

        $tries = 0;
        $_SESSION["word"] = $word;
        $_SESSION["lines"] = $lines;
        $_SESSION["arrayWord"] = $arrayWord;
        $_SESSION["letterCount"] = $letterCount;
        $_SESSION["tries"] = 8;
        $_SESSION["player"] = $trans['player two'][$lang];

        echo json_encode(['status' => 'success']);
    }
} else {
    http_response_code(404);
    die();
}