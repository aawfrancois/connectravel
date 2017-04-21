<?php

// Flash message middleware
$app->add(function (\Slim\Http\Request $request, \Slim\Http\Response $response, $next) {
    $this->view->offsetSet('flash', $this->flash);

    return $next($request, $response);
});
