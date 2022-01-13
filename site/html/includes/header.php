<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css"/>
</head>
<body>
<?php if (isset($_SESSION['flash'])): ?>
<div class="alert alert-<?= $_SESSION['flash']['type'] ?>" role="alert">
    <?= $_SESSION['flash']['text'] ?>
</div>
<?php
$_SESSION['flash'] = null;
endif;
?>