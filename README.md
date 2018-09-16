Demostración de aplicación de client con Symfony y Twig.

## Instalación

Para instalar el proyecto lo primero que hay que hacer es clonarlo utilizando git.

Una vez descargado el repositorio, y desde la carpeta del proyecto, hay que instalar las dependencias utilizando composer:

```
composer install
```

Después hay que instalar las dependencias del frontend mediante yarn. Con esta aplicación instalada ejecutar lo siguiente:

```
yarn install
yarn encore dev
```

El primer comando instala las dependencias y el segundo compila los assets para poder utilizarlos en desarrollo.

Con las dependencias ya instaladas, se puede levantar un servidor http mediante la console de symfony con:

```
bin/console server:start
```

Este servidor se puede parar con:

```
bin/console server:stop
```

## Utilización

Este repositorio está preparado para funcionar utilizando datos de prueba incluidos en los controladores. Queda como ejercicio para el usuario modificar la implementación para obtener los datos de una instalación de https://github.com/fcastilloes/api-demo.

Para esto será importante crear una aplicación oauth en github y configurarla para que el `Callback Url` couincida con la ruta `auth_callback` definida en el HomeController.

Recuerda que puedes consultar las rutas de la aplicación con el siguiente comando:

```
bin/console debug:router --env prod
```
