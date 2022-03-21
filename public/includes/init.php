<?php

ob_start();

if(!session_id()) {
    session_start();
}

include __DIR__ . '/helpers.php';
include __DIR__ . '/config.php';

spl_autoload_register(function ($class) {
    include __DIR__ . '/../classes/' . $class . '.php';
});