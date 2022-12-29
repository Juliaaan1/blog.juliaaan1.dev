<?php

/**
 * @author Ivan Abashin <juiceworkmail@gmail.com>
 */

namespace Juliaaan1\Blog\Blog\TagCloud;

use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Juliaaan1\Blog\Blog\Post\Post;

class Repository {
    protected QueryBuilder $queryBuilder;

    function __construct(QueryBuilder $queryBuilder) {
        $this->queryBuilder = $queryBuilder;
    }

    function findAll(): array {
        $tags = $this->queryBuilder
                ->select('p.tag', 'count(p.id) as cnt')
                ->from(Post::class, 'p')
                ->groupBy('p.tag')
                ->getQuery()
                ->getResult(Query::HYDRATE_ARRAY);

        usort($tags, fn(array $t1, array $t2) => $t1['cnt'] < $t2['cnt']);

        return $tags;
    }
}