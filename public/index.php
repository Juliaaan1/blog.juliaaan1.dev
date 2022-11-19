<?php

/**
 * @author Ivan Abashin <juiceworkmail@gmail.com>
 */

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Juliaaan1\Blog\Api;
use Juliaaan1\Blog\Auth;
use Juliaaan1\Blog\Web;
use Juliaaan1\Blog\Blog\Post;
use Juliaaan1\Blog\User;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$config = ORMSetup::createAttributeMetadataConfiguration(array(dirname(__DIR__) . '/src'), true);
$connection = require_once dirname(__DIR__) . '/config/db.php';

$em = EntityManager::create($connection, $config);

$app = AppFactory::create();
$app->addBodyParsingMiddleware();

$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($request, $handler) {
    $response = $handler->handle($request);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});

$apiController = new Api\Controller(
        new Post\Service($em)
);

$webController = new Web\Controller(
        new Environment(new FilesystemLoader(dirname(__DIR__) . '/templates')),
        new Post\Repository($em->getRepository(Post\Post::class))
);

$app->get('/', $webController->main(...));

$app->group('/api', function (RouteCollectorProxy $group) use ($app, $apiController) {
    $group->post('/blog/add', $apiController->addPost(...));
})->addMiddleware(
        new Tuupola\Middleware\HttpBasicAuthentication(array(
            'realm' => 'Protected',
            'authenticator' => new Auth\Database(
                    new User\Repository(
                            $em->getRepository(User\User::class)
                    )
            )
        ))
);

$app->run();
