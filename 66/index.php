<?php
    error_reporting(E_ALL);

    ini_set('ignore_repeated_errors', TRUE);

    ini_set('display_errors', FALSE);

    ini_set('log_errors', TRUE);


    ini_set('error_log', '/var/www/curso/66/php-error.log');
    error_log("hi!, /-|-/-|-/-|-/-|-/-|-/-|-/-|-/-|-/-|-/-|-/-|-/-|-/-|-/-|");

    require_once 'libs/app.php';

    $app = new App();