<?php
declare(strict_types=1);

namespace Nullabe\PhpBlocks\Domain\Model;

use Nullabe\PhpBlocks\Domain\Model\Contract\AddressInterface;

final class Address implements AddressInterface
{
    private $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }

    function getId(): string
    {
        return $this->id;
    }

}