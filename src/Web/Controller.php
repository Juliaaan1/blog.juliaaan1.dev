<?php

/**
 * @author Ivan Abashin <juiceworkmail@gmail.com>
 */


namespace Juliaaan1\Blog\Web;


use Juliaaan1\Blog\Blog\Post;
use Juliaaan1\Blog\Blog\TagCloud;
use Juliaaan1\Blog\Version;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Twig\Environment;

class Controller {
    protected Environment $twig;
    protected Post\Repository $postRepository;
    protected TagCloud\Repository $tagCloudRepository;
    protected Version\Repository $versionRepository;

    function __construct(
            Environment $twig,
            Post\Repository $postRepository,
            TagCloud\Repository $tagCloudRepository,
            Version\Repository $versionRepository
    ) {
        $this->twig = $twig;
        $this->postRepository = $postRepository;
        $this->tagCloudRepository = $tagCloudRepository;
        $this->versionRepository = $versionRepository;
    }

    function blog(Request $request, Response $response, $args): Response {
        $queryParams = $request->getQueryParams();

        $response->getBody()->write(
                $this->twig->render('pages/blog.html.twig', array(
                        'activeTag' => $queryParams['tag'] ?? ''
                ))
        );

        return $response;
    }

    function posts(Request $request, Response $response, $args): Response {
        $queryParams = $request->getQueryParams();
        $activeTag = $queryParams['tag'] ?? '';

        if ($activeTag) {
            $posts = $this->postRepository->findBy(array('tag' => $activeTag), array('id' => 'desc'));
        } else {
            $posts = $this->postRepository->findBy(array(), array('id' => 'desc'));
        }

        $tags = $this->tagCloudRepository->findAll();

        $response->getBody()->write(
                $this->twig->render('components/posts.html.twig', array(
                        'posts' => $posts,
                        'tags' => $tags,
                        'activeTag' => $activeTag
                ))
        );
        return $response;
    }

    function version(Request $request, Response $response, $args): Response {
        $versions = $this->versionRepository->findBy(array(), array('id' => 'desc'));
        $response->getBody()->write($this->twig->render('components/version.html.twig', array('versions' => $versions)));
        return $response;
    }
}
