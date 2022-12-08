<?php

/**
 * @author Ivan Abashin <juiceworkmail@gmail.com>
 */


namespace Juliaaan1\Blog\Blog\Post;


use DateTime;
use Doctrine\ORM;

#[ORM\Mapping\Entity]
#[ORM\Mapping\Table(name: 'post', schema: 'blog')]
class Post {
    #[ORM\Mapping\Id]
    #[ORM\Mapping\Column(type: 'integer')]
    #[ORM\Mapping\GeneratedValue(strategy: 'IDENTITY')]
    var ?int $id;

    #[ORM\Mapping\Column(type: 'string', length: 255)]
    var string $title;

    #[ORM\Mapping\Column(type: 'text')]
    var string $text;

    #[ORM\Mapping\Column(type: 'datetime')]
    var DateTime $created;

    #[ORM\Mapping\Column(type: 'string')]
    var string $tag;

    function __construct(?int $id, string $title, string $text, DateTime $created, string $tag) {
        $this->id = $id;
        $this->title = $title;
        $this->text = $text;
        $this->created = $created;
        $this->tag = $tag;
    }
}
