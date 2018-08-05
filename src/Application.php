<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     3.3.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App;

use Cake\Error\Middleware\ErrorHandlerMiddleware;
use Cake\Http\BaseApplication;
use Cake\Routing\Middleware\RoutingMiddleware;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

/**
 * Aplicación
 */
class Application extends BaseApplication
{
    /**
     * Define las rutas para una aplicación
     *
     * @param \Cake\Routing\RouteBuilder $routes Objeto utilizado para construir rutas
     *
     * @return void
     */
    public function routes($routes)
    {
        /** @noinspection PhpDeprecationInspection */
        $initialized =& Router::$initialized;
        if (!$initialized) {
            $initialized = true;

            $routes->connect('/', 'App::home');
            $routes->fallbacks(DashedRoute::class);
        }
    }

    /**
     * Define las capas de middleware HTTP para una aplicación
     *
     * @param \Cake\Http\MiddlewareQueue $middlewareQueue La cola de middleware
     * para configurar en la clase de aplicación
     *
     * @return \Cake\Http\MiddlewareQueue
     */
    public function middleware($middlewareQueue)
    {
        $middlewareQueue
            ->add(ErrorHandlerMiddleware::class)
            ->add(new RoutingMiddleware($this, '_cake_routes_'));

        return $middlewareQueue;
    }
}
