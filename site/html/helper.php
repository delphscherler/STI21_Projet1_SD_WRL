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
