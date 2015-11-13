<?php
  function getWords($text) {
    // REGEX extraction text de l'HTML : (<[a-zA-Z][a-zA-Z0-9]*(([ ]*)([a-zA-Z]+(=("[\w- ]*")*)*)*)*>)([^<]+)(?=<\/[a-zA-Z][a-zA-Z0-9]*>)
    // recuperer le resultat dans le dernier groupe (7)
    // cf. http://regexr.com/3c6mj
    // Version simplifié : <[^>]+>(.*)</[^>]+>

    //echo("<hr/>Texte : ".$text."\n\n");
    //preg_match_all('#<[^>]+>(.*)</[^>]+>#im',$text,$match_arr,PREG_PATTERN_ORDER);
    //var_dump($match_arr);

    preg_match_all('/([a-zA-Z]|\xC3[\x80-\x96\x98-\xB6\xB8-\xBF]|\xC5[\x92\x93\xA0\xA1\xB8\xBD\xBE]){4,}/', $text, $match_arr);
    $words = $match_arr[0];
    //var_dump($words);
    $res = array();
    foreach($words as $word) {
      if (array_key_exists($word,$res))
        $res[$word]++;
      else
        $res[$word] = 1;
    }
    asort($res);
    $res = array_reverse($res);
    $res = array_splice($res,0,5);
    return $res;
  }
?>
