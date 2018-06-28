<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Domain\Model\Entity;

/**
 * Address class
 */
class Address
{
    /**
     * @var string
     */
    private $hash;

    /**
     * Constructor
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
