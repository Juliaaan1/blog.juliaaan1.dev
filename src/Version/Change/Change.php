<?php

/**
 * @author Ivan Abashin <juiceworkmail@gmail.com>
 */

namespace Juliaaan1\Blog\Version\Change;

use Doctrine\ORM;
use Juliaaan1\Blog\Version\Version;

#[ORM\Mapping\Entity]
#[ORM\Mapping\Table(name: 'version_changes', schema: 'blog')]
class Change {
    #[ORM\Mapping\Id]
    #[ORM\Mapping\Column(type: 'integer')]
    #[ORM\Mapping\GeneratedValue(strategy: 'IDENTITY')]
    var ?int $id;

    #[ORM\Mapping\Column(type: 'string', length: 1023)]
    var string $change;

    #[ORM\Mapping\ManyToOne(targetEntity: Version::class, inversedBy: 'change')]
    #[ORM\Mapping\JoinColumn(name: 'version_id', referencedColumnName: 'id')]
    var ?Version $version;

    function __construct(?int $id, string $change, ?Version $version) {
        $this->id = $id;
        $this->change = $change;
        $this->version = $version;
    }
}
