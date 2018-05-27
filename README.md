# Plantilla de aplicación para proyectos de CakePHP 3

Este repositorio contiene una plantilla de aplicación para comenzar nuevos proyectos de CakePHP 3.

El código fuente del framework se puede encontrar en [cakephp/cakephp](https://github.com/cakephp/cakephp).

## Instalación

1. Descargar [Composer](https://getcomposer.org/doc/00-intro.md) o actualizar `composer self-update`.
2. Ejecutar `php composer.phar create-project --prefer-dist jacricelli/cakephp-app [nombre_app]`.

Si Composer está instalado globalmente, ejecutar

```bash
composer create-project --prefer-dist jacricelli/cakephp-app
```

En caso de querer usar un nombre de directorio de aplicación personalizado (p.e. `/foobar/`):

```bash
composer create-project --prefer-dist jacricelli/cakephp-app foobar
```

Ahora puede usar el servidor web de su máquina para ver la página de inicio predeterminada o iniciar
el servidor web incorporado con:

```bash
bin/cake server -p 8765
```

luego visite `http://localhost:8765` para ver la página de bienvenida.

## Licencia

Consulte el archivo [LICENSE.txt](LICENSE.txt) para más información.
