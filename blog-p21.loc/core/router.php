<?php

// маршрутизатор
require_once CONFIG . '/routes.php';

$uri = trim(parse_url($_SERVER["REQUEST_URI"])['path'], '/');

if (
    array_key_exists($uri, $routes) &&
    file_exists(CONTROLLERS . "/{$routes[$uri]}")
) {
    require_once(CONTROLLERS . "/{$routes[$uri]}");
} else {
    abort();
}


//dd();

// if ($uri == 'index' || $uri == '/') {
//     require_once(CONTROLLERS.'/index.php');
// }
// else if ($uri == 'contacts') {
//     require_once(CONTROLLERS.'/contacts.php');
// }
// else {
//     abort();
// }
