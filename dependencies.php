<?php
//get instance of container for Dependency Injection
$container = new League\Container\Container;

//PageBuilder object contains the page to be sent in the response to the browser
$page = new Controllers\PageBuilder(NULL);
$dashboardPage = new Controllers\PageBuilder($_SERVER['DOCUMENT_ROOT']."/src/Views/dashboardPageTemplate.php");

//inject dependencies to Controllers via their constructor
$container->add(Controllers\HomeController::class)->addArgument($page);
$container->add(Controllers\SearchController::class)->addArgument($page);
$container->add(Controllers\DashboardController::class)->addArgument($dashboardPage);
