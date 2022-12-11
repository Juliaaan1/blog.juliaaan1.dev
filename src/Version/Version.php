<?php

namespace Juliaaan1\Blog\Version;


use DateTime;
use Doctrine\ORM;
use Juliaaan1\Blog\Version\Change\Change;

#[ORM\Mapping\Entity]
#[ORM\Mapping\Table(name: 'versions', schema: 'blog')]
class Version {
    #[ORM\Mapping\Id]
    #[ORM\Mapping\Column(type: 'integer')]
    #[ORM\Mapping\GeneratedValue(strategy: 'IDENTITY')]
    var ?int $id;

    #[ORM\Mapping\Column(type: 'datetime')]
    var DateTime $created;

    #[ORM\Mapping\Column(type: 'string', length: 255)]
    var string $version;

    #[ORM\Mapping\OneToMany(mappedBy: 'version', targetEntity: Change::class)]
    var ORM\PersistentCollection $changes;

    function __construct(?int $id, DateTime $created, string $version, ORM\PersistentCollection $changes) {
        $this->id = $id;
        $this->created = $created;
        $this->version = $version;
        $this->changes = $changes;
    }
}
