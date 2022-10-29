<?php

/**
 * @author Ivan Abashin <juiceworkmail@gmail.com>
 */


namespace Juliaaan1\Blog\Blog\Post;


use Doctrine\ORM\EntityRepository;

class Repository {
    protected EntityRepository $repository;

    function __construct(EntityRepository $repository) {
        $this->repository = $repository;
    }

    function findAll(): array {
        return $this->repository->findAll();
    }
}
