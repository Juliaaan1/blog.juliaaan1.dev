<?php

/**
 * @author Ivan Abashin <juiceworkmail@gmail.com>
 */


namespace Juliaaan1\Blog\Api;


use DateTime;
use Juliaaan1\Blog\Blog\Post;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Controller {
    protected Post\Service $service;

    function __construct(Post\Service $service) {
        $this->service = $service;
    }

    function addPost(Request $request, Response $response, $args): Response {
        $body = $request->getParsedBody();

        $post = new Post\Post(null, $body['title'], $body['text'], new DateTime('now'));
        $postId = $this->service->add($post);

        $response->getBody()->write(json_encode(array('id' => $postId)));
        return $response->withHeader('Content-Type', 'application/json');
    }
}
