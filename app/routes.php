<?php
declare(strict_types=1);

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Hello world!');
        return $response;
    });

    $app->post('/distance/', function($request, $response, $args) {
        $data = $request->getParsedBody();
        if (is_null($data) || !isset($data['sum']) || sizeof($data['sum']) < 2) {
            return null;
        }
        $input = $data['sum'];
        $output = $data['result']['type'] ?? "meters";
        $totalDistance = 0.00;
        foreach ($input as $item){
            $totalDistance += $item['type'] === 'meters' ? $item['value'] : $item ['value'] * 0.95;
        }
        if ($output === "yards"){
            $totalDistance = $totalDistance / 0.95;
        }
        $response->withStatus(200)->getBody()->write(json_encode(['type'=>$output,'totalDistance'=>$totalDistance]));
        return $response;
    });
};
