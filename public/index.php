<?php

declare(strict_types=1);

use FastRoute\RouteCollector;
use PHPQuiz\Controller\MainController;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

$container = require __DIR__ . '/../src/bootstrap.php';

$whoops = new Run();
$whoops->pushHandler(new PrettyPageHandler());
$whoops->register();

$dispatcher = FastRoute\simpleDispatcher(function (RouteCollector $r): void {
    $r->addRoute('GET', '/', [MainController::class, 'showStart']);
    $r->addRoute('GET', '/{id:\d+}', [MainController::class, 'showQuestion']);
});

$route = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

switch ($route[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
        echo '404 Not Found';
        break;

    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        header($_SERVER["SERVER_PROTOCOL"] . ' 405 Method Not Allowed');
        echo '405 Method Not Allowed';
        break;

    case FastRoute\Dispatcher::FOUND:
        /** @var callable $controller */
        $controller = $route[1];
        /** @var array<string, string> $parameters */
        $parameters = $route[2];

        /** @psalm-suppress UncaughtThrowInGlobalScope */
        $container->call($controller, $parameters);
        break;
}
