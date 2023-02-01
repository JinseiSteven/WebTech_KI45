<?php

define("SERVER_CSRF_SEED", 'jadiald2di1d9sahc2d19dnsjak21jmsaldirifbqdu');

// upon first starting the website, user receives a session seed
if (empty($_SESSION['seed'])) {
    $_SESSION['seed'] = $random_seed = bin2hex(random_bytes(10));
}

function generate_csrf() {
    $current_time = time();
    $hash = hash_hmac(
        'sha256',
        $current_time . $_SESSION['seed'],
        SERVER_CSRF_SEED
    );
    $csrf_token = $hash . '|' . $current_time . '|' . $_SESSION['seed'];

    return token_encode($csrf_token);
}

// function for validating csrf-tokens before altering the database
function validate_csrf($token) {
    $csrf_list = explode('|', token_decode($token));
    if (count($csrf_list) === 3) {
        $hash = hash_hmac(
            'sha256',
            $csrf_list[1] . $csrf_list[2],
            SERVER_CSRF_SEED
        );
        if (hash_equals($hash, $csrf_list[0])) {
            return true;
        }
    }
    return false;
}

function token_encode($token) {
    return rtrim(strtr(base64_encode($token), '+/', '-_'), '=');
}

function token_decode($token) {
    return base64_decode(strtr($token, '-_', '+/'));
}