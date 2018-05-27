#!/usr/bin/php -q
<?php
use App\Application;
use Cake\Console\CommandRunner;

/**
 * Requerir el cargador de clases de Composer
 */
require dirname(__DIR__) . '/vendor/autoload.php';

/**
 * Construir el corredor con una aplicación
 */
$runner = new CommandRunner(
    new Application(dirname(__DIR__) . '/config')
);

/**
 * Ejecutar comando
 */
exit(
    $runner->run($argv)
);
