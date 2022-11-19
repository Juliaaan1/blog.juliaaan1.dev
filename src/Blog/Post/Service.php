<?php

/**
 * @author Ivan Abashin <juiceworkmail@gmail.com>
 */


namespace Juliaaan1\Blog\Blog\Post;


use Doctrine\ORM\EntityManager;

class Service {
    protected EntityManager $em;

    function __construct(EntityManager $em) {
        $this->em = $em;
    }

    function add(Post $post): int {
        $this->em->persist($post);
        $this->em->flush();

        return $post->id;
    }
}
