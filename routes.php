<?php

use Core\Routing\Router;

Router::get('/', [new App\Controller\IndexController(), 'showIndexPage']);

Router::get('/type/:typeName/', [new App\Controller\IndexController(), "showIndexPage"]);

Router::get('/admin/', [new App\Controller\AdminController(), 'showAdminPage']);

Router::get('/admin/login/', [new App\Controller\AuthController(), 'authUser']);

Router::post('/admin/login/check/', [new App\Controller\AuthController(), 'checkUser']);

Router::get('/edit/:objectName/', [new App\Controller\AdminController(), 'editObject']);

Router::post('/edit/update/:objectName/', [new App\Controller\UpdateController(), 'updateEditObject']);

Router::get('/add/:objectName/', [new App\Controller\AdminController(), 'addObject']);

Router::post('/add/update/:objectName/', [new App\Controller\UpdateController(), 'updateAddObject']);

Router::get('/delete/:objectName/', [new App\Controller\AdminController(), 'deleteObject']);