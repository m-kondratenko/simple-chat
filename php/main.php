<?php
  require_once 'silex.phar';
  //create application instance
  $app = new Silex\Application();
  //$app['debug'] = true;
  //describe routing
  $app->get('/', function() {
      return new Symfony\Component\HttpFoundation\Response("Одностраничное приложение \"Чат\"");
    });
  $app->run();
?>
