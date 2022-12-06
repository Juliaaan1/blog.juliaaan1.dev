<?php

/**
 * @author Ivan Abashin <juiceworkmail@gmail.com>
 */


namespace Juliaaan1\Blog\User;


use Doctrine\ORM;

#[ORM\Mapping\Entity]
#[ORM\Mapping\Table(name: 'users', schema: 'blog')]
class User {
    #[ORM\Mapping\Id]
    #[ORM\Mapping\Column(type: 'integer')]
    #[ORM\Mapping\GeneratedValue(strategy: 'IDENTITY')]
    var ?int $id;

    #[ORM\Mapping\Column(type: 'string', length: 255)]
    var string $login;

    #[ORM\Mapping\Column(type: 'string', length: 255)]
    var string $hash;

    function __construct(?int $id, string $login, string $hash) {
        $this->id = $id;
        $this->login = $login;
        $this->hash = $hash;
    }
}
