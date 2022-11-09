<?php

/**
 * @author Ivan Abashin <juiceworkmail@gmail.com>
 */

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Juliaaan1\Blog\Api;
use Juliaaan1\Blog\Web;
use Juliaaan1\Blog\Blog\Post;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$config = ORMSetup::createAttributeMetadataConfiguration(array(dirname(__DIR__) . '/src'), true);
$connection = require_once dirname(__DIR__) . '/config/db.php';

$em = EntityManager::create($connection, $config);

$app = AppFactory::create();

$apiController = new Api\Controller(
        new Post\Service($em)
);

$webController = new Web\Controller(
        new Environment(new FilesystemLoader(dirname(__DIR__) . '/templates')),
        new Post\Repository($em->getRepository(Post\Post::class))
);

$app->get('/', $webController->main(...));

$app->group('/api', function (RouteCollectorProxy $group) use ($app, $apiController) {
    $group->get('/blog/add', $apiController->addPost(...));
});

$app->run();
