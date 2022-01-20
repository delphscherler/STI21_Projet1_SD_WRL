<?php
function addFlashMessage($type, $message) {
    $_SESSION['flash'] = [
        'type' => $type,
        'text' => $message,
    ];
}

function redirect($target, $code = 301) {
    header(' ', true, $code);
    header("Location: $target");
    exit();
}

function generateCSRFToken(){
    $_SESSION['csrfmiddlewaretoken'] = md5(uniqid());
}

function checkCSRFToken($token){
        if (!$token || $token !== $_SESSION['csrfmiddlewaretoken']) {
            header($_SERVER['SERVER_PROTOCOL'] . ' 403 Forbidden');
            exit;
        }
}
