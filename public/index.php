<?php

require __DIR__ . '/includes/init.php';

$file = __DIR__ . '/homepage.php';

$page = getValue('page');

if (null !== $page) {
    $file = __DIR__ . '/' . $page . '.php';
}

if (!file_exists($file)) {
    die('Pagina nu exista');
}

include __DIR__ . '/includes/header.php';

include $file;

include __DIR__ . '/includes/footer.php';



    

