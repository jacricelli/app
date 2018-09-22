<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.8
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Cache\Cache;
use Cake\Console\ConsoleErrorHandler;
use Cake\Core\Configure;
use Cake\Database\Type;
use Cake\Datasource\ConnectionManager;
use Cake\Error\ErrorHandler;
use Cake\Log\Log;
use Cake\Utility\Security;

/**
 * Definir las rutas de acceso
 */
require __DIR__ . '/paths.php';

/**
 * Requerir script de arranque de CakePHP
 */
require CORE_PATH . 'config' . DS . 'bootstrap.php';

/**
 * Cargar el archivo de configuración
 */
try {
    Configure::load('app', 'default', false);
} catch (Exception $e) {
    exit($e->getMessage() . "\n");
}

/**
 * Configurar el manejo de errores y excepciones
 */
if (PHP_SAPI !== 'cli') {
    (new ErrorHandler(Configure::read('Error')))->register();
} else {
    (new ConsoleErrorHandler(Configure::read('Error')))->register();

    Configure::write('Log.debug.file', 'cli-debug');
    Configure::write('Log.error.file', 'cli-error');
}

/**
 * Establecer la URL base
 */
if (!Configure::read('App.fullBaseUrl')) {
    $s = null;
    if (env('HTTPS')) {
        $s = 's';
    }

    $httpHost = env('HTTP_HOST');
    if (isset($httpHost)) {
        Configure::write('App.fullBaseUrl', 'http' . $s . '://' . $httpHost);
    }
    unset($httpHost, $s);
}

/**
 * Establecer la duración de la caché de metadatos y rutas
 */
if (Configure::read('debug')) {
    Configure::write('Cache._cake_model_.duration', '+2 minutes');
    Configure::write('Cache._cake_core_.duration', '+2 minutes');
    Configure::write('Cache._cake_routes_.duration', '+5 seconds');
}

/**
 * Establecer la zona horaria predeterminada
 */
date_default_timezone_set(Configure::read('App.defaultTimezone'));

/**
 * Establecer la codificación de caracteres interna
 */
mb_internal_encoding(Configure::read('App.encoding'));

/**
 * Establecer la localidad predeterminada
 */
ini_set('intl.default_locale', Configure::read('App.defaultLocale'));

/**
 * Configuración de la caché
 */
Cache::setConfig(Configure::consume('Cache'));

/**
 * Configuración de las conexiones a bases de datos
 */
ConnectionManager::setConfig(Configure::consume('Datasources'));

/**
 * Configuración del registro de mensajes
 */
Log::setConfig(Configure::consume('Log'));

/**
 * Configuración de seguridad
 */
Security::setSalt(Configure::consume('Security.salt'));

/**
 * Habilitar objetos de tiempo inmutables en el ORM
 */
/* @noinspection PhpUndefinedMethodInspection */
Type::build('time')
    ->useImmutable();
/* @noinspection PhpUndefinedMethodInspection */
Type::build('date')
    ->useImmutable();
/* @noinspection PhpUndefinedMethodInspection */
Type::build('datetime')
    ->useImmutable();
/* @noinspection PhpUndefinedMethodInspection */
Type::build('timestamp')
    ->useImmutable();
