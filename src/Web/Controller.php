<?php

/**
 * @author Ivan Abashin <juiceworkmail@gmail.com>
 */


namespace Juliaaan1\Blog\Web;


use Juliaaan1\Blog\Blog\Post;
use Juliaaan1\Blog\Version;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Twig\Environment;

class Controller {
    protected Environment $twig;
    protected Post\Repository $postRepository;
    protected Version\Repository $versionRepository;

    function __construct(Environment $twig, Post\Repository $postRepository, Version\Repository $versionRepository) {
        $this->twig = $twig;
        $this->postRepository = $postRepository;
        $this->versionRepository = $versionRepository;
    }

    function blog(Request $request, Response $response, $args): Response {
        $response->getBody()->write($this->twig->render('pages/blog.html.twig'));
        return $response;
    }

    function posts(Request $request, Response $response, $args): Response {
        $posts = $this->postRepository->findBy(array(), array('id' => 'desc'));
        $response->getBody()->write($this->twig->render('components/posts.html.twig', array('posts' => $posts)));
        return $response;
    }

    function version(Request $request, Response $response, $args): Response {
        $versions = $this->versionRepository->findBy(array(), array('id' => 'desc'));
        $response->getBody()->write($this->twig->render('components/version.html.twig', array('versions' => $versions)));
        return $response;
    }
}
