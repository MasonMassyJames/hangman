<?php

require_once dirname(__DIR__) . '/bootstrap.php';

if ($lang == 'it') {
    $fileTxt = '60000_parole_italiane.txt';
} else {
    $fileTxt = '60000_english_words.txt';
}

$words = file($fileTxt, FILE_IGNORE_NEW_LINES);
$i = rand(0, (count($words)) - 1);

$word =  $words[$i];
$word = mb_strtoupper($word);
$letterCount = mb_strlen($word);
$arrayWord = array();


for ($i = 0; $i < $letterCount; $i++) {
  
    $arrayWord[$i] = mb_substr($word, $i);
 
}

$lines = array();
for ($i = 0; $i < $letterCount; $i++) {
  $lines[$i] = "_";
}

$_SESSION["word"] = $word;
$_SESSION["lines"] = $lines;
$_SESSION["arrayWord"] = $arrayWord;
$_SESSION["letterCount"] = $letterCount;
$_SESSION["tries"] = 8;
$_SESSION["player"] = $trans['player one'][$lang];