<?php
require_once __DIR__ . '/helper.php';

session_unset();
session_destroy();
redirect('index.php');