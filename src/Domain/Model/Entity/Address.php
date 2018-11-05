<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Domain\Model\Entity;

/**
 * Class Address
 *
 * @package Nbe\PhpBlocks\Domain\Model\Entity
 */
class Address
{
    /**
     * @var string
     */
    private $hash;

    /**
     * Address constructor.
     *
     * @param string $hash
     */
    public function __construct(string $hash)
    {
        $this->hash = $hash;
    }

    /**
     * @return string
     */
    public function getHash(): string
    {
        return $this->hash;
    }

}
