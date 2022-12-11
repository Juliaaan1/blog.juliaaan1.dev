<?php

/**
 * @author Ivan Abashin <juiceworkmail@gmail.com>
 */

namespace Juliaaan1\Blog\Version;

use Doctrine\ORM\EntityRepository;

class Repository {
    protected EntityRepository $repository;

    function __construct(EntityRepository $repository) {
        $this->repository = $repository;
    }

    function findBy(array $criteria = array(), ?array $orderBy = null, ?int $limit = null, ?int $offset = null): array {
        return $this->repository->findBy($criteria, $orderBy, $limit, $offset);
    }
}