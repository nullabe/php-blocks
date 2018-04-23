<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Domain\Model\Entity;

final class Address
{
    public $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    function getId(): string
    {
        return $this->id;
    }

}
