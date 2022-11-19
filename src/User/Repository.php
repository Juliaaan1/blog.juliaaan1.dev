<?php

/**
 * @author Ivan Abashin <juiceworkmail@gmail.com>
 */


namespace Juliaaan1\Blog\User;


use Doctrine\ORM\EntityRepository;

class Repository {
    protected EntityRepository $repository;

    function __construct(EntityRepository $repository) {
        $this->repository = $repository;
    }

    function findByLogin(string $login): ?User {
        /** @var ?User $user */
        $user = $this->repository->findOneBy(array('login' => $login));
        return $user;
    }
}
