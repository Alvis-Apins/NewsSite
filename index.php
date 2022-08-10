<?php

use App\Repositories\ArticlesRepository;
use App\Repositories\NewsDataApiRepository;
use App\Views\View;
use Dotenv\Dotenv;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require 'vendor/autoload.php';

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
  $r->addRoute('GET', '/', 'App\Controllers\AllArticlesController_getAllArticles');
  $r->addRoute('GET', '/police-news', 'App\Controllers\PoliceArticlesController_getAllArticles');
  $r->addRoute('GET', '/fireman-news', 'App\Controllers\FiremanArticlesController_getAllArticles');
  $r->addRoute('GET', '/environment-news', 'App\Controllers\EnvironmentArticlesController_getAllArticles');
  $r->addRoute('GET', '/add-article', 'App\Controllers\AddArticleController_addArticleView');
  $r->addRoute('POST', '/add-article', 'App\Controllers\AddArticleController_addArticle');
  $r->addRoute('GET', '/my-articles', 'App\Controllers\MyArticleController_getMyArticles');
});

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

if (false !== $pos = strpos($uri, '?')) {
  $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);
$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
  case FastRoute\Dispatcher::NOT_FOUND:
    echo "404 Not Found";
    break;
  case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
    $allowedMethods = $routeInfo[1];
    echo "405 Method Not Allowed";
    break;
  case FastRoute\Dispatcher::FOUND:
    $handler = $routeInfo[1];
    $vars = $routeInfo[2];

    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    [$controller, $method] = explode('_', $handler);

    $container = new DI\Container();
    $container->set(ArticlesRepository::class, \DI\create(NewsDataApiRepository::class));

    /** @var View $view */
    $view = ($container->get($controller))->$method();

    $loader = new FilesystemLoader('app/Views');
    $twig = new Environment($loader);

    if ($view instanceof View) {
      echo $twig->render($view->getTemplatePath(), $view->getData());
    }
    break;
}
