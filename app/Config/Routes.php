<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get("/","Home::index");


$routes->get(                 "/agents",              "AgentsController::index");
$routes->get(                 "/agents/read/(:num)",  "AgentsController::read/$1");
$routes->match(['get','post'],"/agents/create",       "AgentsController::create");
$routes->match(['get','post'],"/agents/update/(:num)","AgentsController::update/$1");
$routes->match(['get','post'],"/agents/delete/(:num)","AgentsController::delete/$1");


$routes->get(                 "/clients",               "ClientsController::index");
$routes->get(                 "/clients/read/(:num)",   "ClientsController::read/$1");
$routes->match(['get','post'],"/clients/create",       "ClientsController::create");
$routes->match(['get','post'],"/clients/update/(:num)","ClientsController::update/$1");
$routes->match(['get','post'],"/clients/delete/(:num)","ClientsController::delete/$1");


$routes->get(                 "/issues",              "IssuesController::index");
$routes->get(                 "/issues/read/(:num)",  "IssuesController::read/$1");
$routes->match(['get','post'],"/issues/create",       "IssuesController::create");
$routes->match(['get','post'],"/issues/update/(:num)","IssuesController::update/$1");
$routes->match(['get','post'],"/issues/delete/(:num)","IssuesController::delete/$1");


$routes->get(                 "/projects",              "ProjectsController::index");
$routes->get(                 "/projects/read/(:num)",  "ProjectsController::read/$1");
$routes->match(['get','post'],"/projects/create",       "ProjectsController::create");
$routes->match(['get','post'],"/projects/update/(:num)","ProjectsController::update/$1");
$routes->match(['get','post'],"/projects/delete/(:num)","ProjectsController::delete/$1");

$routes->get("/tasks",                               "TasksController::index");
$routes->get("/tasks/view/(:num)",                   "TasksController::view/$1");
$routes->match(['get','post'],"/tasks/create",       "TasksController::create");
$routes->match(['get','post'],"/tasks/update/(:num)","TasksController::update/$1");
$routes->match(['get','post'],"/tasks/delete/(:num)","TasksController::delete/$1");

$routes->get(                 "/users",              "UsersController::index");
$routes->get(                 "/users/read/(:num)",  "UsersController::read/$1");
$routes->match(['get','post'],"/users/create",       "UsersController::create");
$routes->match(['get','post'],"/users/update/(:num)","UsersController::update/$1");
$routes->match(['get','post'],"/users/delete/(:num)","UsersController::delete/$1");

$routes->get("/users/login","UsersController::login");
$routes->post("/users/login","UsersController::login");
$routes->get("/users/logout","UsersController::logout");

return $routes;
