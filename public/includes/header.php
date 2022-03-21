<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Biblioteca</title>
    <link rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css"
          integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M"
          crossorigin="anonymous">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <style>
        /* Show it is fixed to the top */
        body {
            min-height: 75rem;
            padding-top: 4.5rem;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="/">Biblioteca</a>
    <button class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarCollapse"
            aria-controls="navbarCollapse"
            aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item <?php echo getValue('page') == 'index' || getValue('page') === null ? 'active' : '' ?>">
                <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item <?php echo getValue('page') == 'authors' ? 'active' : '' ?>">
                <a class="nav-link" href="?page=authors">Autori</a>
            </li>
            <li class="nav-item <?php echo getValue('page') == 'books' ? 'active' : '' ?>">
                <a class="nav-link" href="?page=books">Carti</a>
            </li>
            <li class="nav-item <?php echo getValue('page') == 'customers' ? 'active' : '' ?>">
                <a class="nav-link" href="?page=customers">Clienti</a>
            </li>
            <li class="nav-item <?php echo getValue('page') == 'loans' ? 'active' : '' ?>">
                <a class="nav-link" href="?page=loans">Imprumuturi</a>
            </li>
        </ul>
    </div>
</nav>
<div class="container-fluid">
    <?php
    displayFlash();
    ?>
