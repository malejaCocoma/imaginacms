<?php

use Illuminate\Routing\Router;


$router->group(['prefix' => '/notification/v1'], function (Router $router) {
  
  //====== Notifications
  require_once('ApiRoutes/notificationRoutes.php');
  
  //====== Providers
  require_once('ApiRoutes/providerRoutes.php');
  
  //====== Rules
  require_once('ApiRoutes/ruleRoutes.php');
  
  //====== Templates
  require_once('ApiRoutes/templateRoutes.php');
  
});