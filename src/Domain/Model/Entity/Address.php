<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Domain\Model\Entity;

use Nbe\PhpBlocks\Domain\Model\Entity\Contract\AddressInterface;

final class Address implements AddressInterface
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
