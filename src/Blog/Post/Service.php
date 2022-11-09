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

    function add(): void {
        $this->em->persist(new Post(null, 'Title', 'Long long text'));
        $this->em->flush();
    }
}
