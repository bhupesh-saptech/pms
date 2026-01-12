<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get("/","Home::index");

$routes->get("/agents","AgentsController::index");
$routes->get("/agents/create","AgentsController::create");
$routes->post("/agents/create","AgentsController::create");
$routes->get("/agents/edit/(:num)","AgentssController::edit/$1");
$routes->get("/agents/view/(:num)","AgentssController::view/$1");
$routes->get("/agents/delete/(:num)","AgentssController::delete/$1");

$routes->get("/clients","ClientsController::index");
$routes->get("/clients/create","ClientsController::create");
$routes->post("/clients/create","ClientsController::create");
$routes->get("/clients/edit/(:num)","ClientsController::edit/$1");
$routes->get("/clients/view/(:num)","ClientsController::view/$1");
$routes->get("/clients/delete/(:num)","ClientsController::delete/$1");

$routes->get("/issues","IssuesController::index");
$routes->get("/issues/create","IssuesController::create");
$routes->post("/issues/create","IssuesController::create");
$routes->get("/issues/edit/(:num)","IssuesController::edit/$1");
$routes->get("/issues/view/(:num)","IssuesController::view/$1");
$routes->get("/issues/delete/(:num)","IssuesController::delete/$1");


$routes->get("/projects","ProjectsController::index");
$routes->get("/projects/create","ProjectsController::create");
$routes->post("/projects/create","ProjectsController::create");
$routes->get("/projects/edit/(:num)","ProjectsController::edit/$1");
$routes->get("/projects/view/(:num)","ProjectsController::view/$1");
$routes->get("/projects/delete/(:num)","ProjectsController::delete/$1");

$routes->get("/tasks","TasksController::index");
$routes->get("/tasks/create","TasksController::create");
$routes->post("/tasks/create","TasksController::create");
$routes->get("/tasks/edit/(:num)","TasksController::edit/$1");
$routes->get("/tasks/view/(:num)","TasksController::view/$1");
$routes->get("/tasks/delete/(:num)","TasksController::delete/$1");


$routes->get("/users","UsersController::index");
$routes->get("/users/login","UsersController::login");
$routes->get("/users/logout","UsersController::logout");
$routes->get("/users/create","UsersController::create");
$routes->get("/users/edit/(:num)","UsersController::edit/$1");
$routes->get("/users/view/(:num)","UsersController::view/$1");
$routes->get("/users/delete/(:num)","UsersController::delete/$1");

return $routes;
