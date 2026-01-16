<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get("/","Home::index");


$routes->match(['get','post'],  "/agents",              "AgentsController::index");
$routes->match(['get','post'],  "/agents/create",       "AgentsController::create");
$routes->match(['get','post'],  "/agents/view/(:num)",  "AgentsController::view/$1");
$routes->match(['get','post'],  "/agents/update/(:num)","AgentsController::update/$1");
$routes->match(['get','post'],  "/agents/delete/(:num)","AgentsController::delete/$1");


$routes->match(['get','post'],  "/clients",              "ClientsController::index");
$routes->match(['get','post'],  "/clients/create",       "ClientsController::create");
$routes->match(['get','post'],  "/clients/view/(:num)",  "ClientsController::view/$1");
$routes->match(['get','post'],  "/clients/update/(:num)","ClientsController::update/$1");
$routes->match(['get','post'],  "/clients/delete/(:num)","ClientsController::delete/$1");


$routes->match(['get','post'],  "/issues",              "IssuesController::index");
$routes->match(['get','post'],  "/issues/create",       "IssuesController::create");
$routes->match(['get','post'],  "/issues/view/(:num)",  "IssuesController::view/$1");
$routes->match(['get','post'],  "/issues/update/(:num)","IssuesController::update/$1");
$routes->match(['get','post'],  "/issues/delete/(:num)","IssuesController::delete/$1");


$routes->match(['get','post'],  "/projects",              "ProjectsController::index");
$routes->match(['get','post'],  "/projects/create",       "ProjectsController::create");
$routes->match(['get','post'],  "/projects/view/(:num)",  "ProjectsController::view/$1");
$routes->match(['get','post'],  "/projects/update/(:num)","ProjectsController::update/$1");
$routes->match(['get','post'],  "/projects/delete/(:num)","ProjectsController::delete/$1");

$routes->match(['get','post'],  "/tasks",              "TasksController::index");
$routes->match(['get','post'],  "/tasks/create",       "TasksController::create");
$routes->match(['get','post'],  "/tasks/view/(:num)",  "TasksController::view/$1");
$routes->match(['get','post'],  "/tasks/update/(:num)","TasksController::update/$1");
$routes->match(['get','post'],  "/tasks/delete/(:num)","TasksController::delete/$1");

$routes->match(['get','post'],  "/users",              "UsersController::index");
$routes->match(['get','post'],  "/users/create",       "UsersController::create");
$routes->match(['get','post'],  "/users/view/(:num)",  "UsersController::view/$1");
$routes->match(['get','post'],  "/users/update/(:num)","UsersController::update/$1");
$routes->match(['get','post'],  "/users/delete/(:num)","UsersController::delete/$1");

$routes->match(["get","post"],  "/users/login", "UsersController::login");
$routes->match(["get","post"],  "/users/logout","UsersController::logout");

$routes->get("clients/(:num)","ClientsController::projects/$1");

return $routes;
