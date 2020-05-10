<?php

function generate_money_code() {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString1 = '';
    $randomString2 = '';
    $randomString3 = '';
    for ($i = 0; $i < 5; $i++) {
            $randomString1 .= $characters[rand(0, $charactersLength - 1)];
    }
    for ($i = 0; $i < 5; $i++) {
            $randomString2 .= $characters[rand(0, $charactersLength - 1)];
    }
    for ($i = 0; $i < 5; $i++) {
            $randomString3 .= $characters[rand(0, $charactersLength - 1)];
    }
    $key = $randomString1 . "-" . $randomString2 . "-" . $randomString3;
    return $key;
}

?>