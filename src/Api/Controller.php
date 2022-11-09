<?php

/**
 * @author Ivan Abashin <juiceworkmail@gmail.com>
 */


namespace Juliaaan1\Blog\Api;


use Juliaaan1\Blog\Blog\Post;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class Controller {
    protected Post\Service $service;

    function __construct(Post\Service $service) {
        $this->service = $service;
    }

    function addPost(Request $request, Response $response, $args): Response {
        $response->getBody()->write(print_r($request->getParsedBody(), true));

        return $response;
    }
}
