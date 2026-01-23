<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
    $routes->match(["get","post"],  "/users/login", "UsersController::login");
    $routes->match(["get","post"],  "/users/logout","UsersController::logout");

    $routes->group('', ['filter' => 'auth'], function ($routes) {

        $routes->get("/","HomeController::index");


        $routes->match(['get','post'],  "/agents",              "AgentsController::index", ['filter' => 'auth']);
        $routes->match(['get','post'],  "/agents/create",       "AgentsController::create");
        $routes->match(['get','post'],  "/agents/update/(:num)","AgentsController::update/$1");
        $routes->match(['get','post'],  "/agents/delete/(:num)","AgentsController::delete/$1");


        $routes->match(['get','post'],  "/clients",              "ClientsController::index");
        $routes->match(['get','post'],  "/clients/create",       "ClientsController::create");
        $routes->match(['get','post'],  "/clients/update/(:num)","ClientsController::update/$1");
        $routes->match(['get','post'],  "/clients/delete/(:num)","ClientsController::delete/$1");


        $routes->match(['get','post'],  "/issues",              "IssuesController::index");
        $routes->match(['get','post'],  "/issues/create",       "IssuesController::create");
        $routes->match(['get','post'],  "/issues/update/(:num)","IssuesController::update/$1");
        $routes->match(['get','post'],  "/issues/delete/(:num)","IssuesController::delete/$1");


        $routes->match(['get','post'],  "/projects",              "ProjectsController::index");
        $routes->match(['get','post'],  "/projects/create",       "ProjectsController::create");
        $routes->match(['get','post'],  "/projects/update/(:num)","ProjectsController::update/$1");
        $routes->match(['get','post'],  "/projects/delete/(:num)","ProjectsController::delete/$1");

        $routes->match(['get','post'],  "/tasks",              "TasksController::index");
        $routes->match(['get','post'],  "/tasks/create",       "TasksController::create");
        $routes->match(['get','post'],  "/tasks/update/(:num)","TasksController::update/$1");
        $routes->match(['get','post'],  "/tasks/delete/(:num)","TasksController::delete/$1");

        $routes->match(['get','post'],  "/teams",              "TeamsController::index");
        $routes->match(['get','post'],  "/teams/create",       "TeamsController::create");
        $routes->match(['get','post'],  "/teams/update/(:num)","TeamsController::update/$1");
        $routes->match(['get','post'],  "/teams/delete/(:num)","TeamsController::delete/$1");

        $routes->match(['get','post'],  "/tickets",              "TicketsController::index");
        $routes->match(['get','post'],  "/tickets/create",       "TicketsController::create");
        $routes->match(['get','post'],  "/tickets/update/(:num)","TicketsController::update/$1");
        $routes->match(['get','post'],  "/tickets/delete/(:num)","TicketsController::delete/$1");

        $routes->match(['get','post'],  "/users",              "UsersController::index");
        $routes->match(['get','post'],  "/users/create",       "UsersController::create");
        $routes->match(['get','post'],  "/users/update/(:num)","UsersController::update/$1");
        $routes->match(['get','post'],  "/users/delete/(:num)","UsersController::delete/$1");

        $routes->get('/get_tickets',"TicketsController::getTickets");
        $routes->get('/get_agents',"AgentsController::getAgents");

        $routes->get("/get-data","HomeController::index");
    });

// return $routes;
