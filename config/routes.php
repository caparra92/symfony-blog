<?php

use App\Controller\BlogController;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

return function (RoutingConfigurator $routes) {
    $routes->add('home', '/')
        ->controller([BlogController::class, 'index']);
    
    $routes->add('blog_login', '/login')
        ->controller([BlogController::class, 'login']);
    
    $routes->add('blog_register', '/register')
        ->controller([BlogController::class, 'register']);

    $routes->add('blog_home', '/home')
        ->controller([BlogController::class, 'home']);
}
?>