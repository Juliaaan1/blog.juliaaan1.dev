<?php

/**
 * @author Ivan Abashin <juiceworkmail@gmail.com>
 */


namespace Juliaaan1\Blog\Web;


use Juliaaan1\Blog\Blog\Post;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Twig\Environment;

class Controller {
    protected Environment $twig;
    protected Post\Repository $postRepository;

    function __construct(Environment $twig, Post\Repository $postRepository) {
        $this->twig = $twig;
        $this->postRepository = $postRepository;
    }

    function main(Request $request, Response $response, $args): Response {
        $posts = $this->postRepository->findBy(array(), array('id' => 'desc'));
        $response->getBody()->write($this->twig->render('main.html.twig', array('posts' => $posts)));
        return $response;
    }
}
