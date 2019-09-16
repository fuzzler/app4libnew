<?php

// funzione che esamina il testo della pagina

function findOccurrence(string $url) :array {

    $return = [
        'titolo' => '',
        'autore' => '',
        'prezzo' => '',
        'sconto' => '',
        'usato' => '',
        'ebook' => ''
    ];

    $text = file_get_contents($url);
    $text = strip_tags($text);
    $text = trim($text);

    // stampa di debug di $text
    echo "<br><hr> $text <br><hr><hr>";

    $return['titolo'] = strstr($text,'-',true);

    $text4autore = strstr($text,'-');
    $return['autore'] = strstr($text4autore,'Libro',true);
    $return['autore'] = str_replace('-','',$return['autore']);

    return $return;
}