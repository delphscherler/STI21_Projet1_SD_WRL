<?php

const MINLENGTH = 8;
const MAXLENGTH = 64;

function verifyPassword($password) {
    return strlen($password) >= MINLENGTH && strlen($password) <= MAXLENGTH;
}
