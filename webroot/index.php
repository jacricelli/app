<?php
/**
 * The Front Controller for handling every request
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.2.9
 * @license       MIT License (https://opensource.org/licenses/mit-license.php)
 */
use App\Application;
use Cake\Http\Server;

/**
 * Contenido estático
 */
if (PHP_SAPI === 'cli-server') {
    $_SERVER['PHP_SELF'] = '/' . basename(__FILE__);
    if (is_file(__DIR__ . parse_url($_SERVER['REQUEST_URI'])['path'])) {
        return false;
    }
}

/**
 * Cargador de clases de Composer
 */
require __DIR__ . '/../vendor/autoload.php';

/**
 * Enlazar aplicación con el servidor
 */
$server = new Server(
    new Application(__DIR__ . '/../config')
);

/**
 * Ejecutar aplicación y emitir respuesta
 */
$server->emit(
    $server->run()
);
