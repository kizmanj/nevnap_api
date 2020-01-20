<?php

/*
ini_set('display_errors', true);
error_reporting(E_ALL);
*/

use Illuminate\Events\Dispatcher;
use Illuminate\Routing\Router;
use Illuminate\Routing\Route;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Nameday\Model\NameDay;

$reqStartTime = microtime(true);
require __DIR__ . '/../../common.php';

$dispatcher = new Dispatcher;
$router = new Router($dispatcher);

$request = Request::createFromGlobals();

$router->get('nameday/{year}-{month}-{day}', function (int $year, int $month, int $day) {
    $rows = NameDay::where('month', $month)->where('day', $day)->get();

    return json_encode($rows);
});

try {
    $response = $router->dispatch($request);
} catch (\Exception $e) {
    $response = new Response("", 412);
}

$response->send();