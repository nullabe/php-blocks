<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Domain\Model\Entity;

/**
 * Block class
 */
final class Block
{
    /**
     * @var int
     */
    private $index;

    /**
     * @var float
     */
    private $timestamp;

    /**
     * @var array
     */
    private $transactions;

    /**
     * @var int
     */
    private $proof;

    /**
     * @var string
     */
    private $hash;

    /**
     * @var string
     */
    private $previousHash;

    /**
     * Constructor
     *
     * @param integer $index
     * @param array $transactions
     * @param integer $proof
     * @param string $previousHash
     */
    public function __construct(int $index, array $transactions, int $proof, string $previousHash)
    {
        $this->index = $index;
        $this->transactions = $transactions;
        $this->proof = $proof;
        $this->previousHash = $previousHash;

        $this->timestamp = microtime(TRUE);
        $this->hash = '';
    }

    /**
     * @return integer
     */
    public function getIndex(): int
    {
        return $this->index;
    }

    /**
     * @return float
     */
    public function getTimestamp(): float
    {
        return $this->timestamp;
    }

    /**
     * @return array
     */
    public function getTransactions(): array
    {
        return $this->transactions;
    }

    /**
     * @return integer
     */
    public function getProof(): int
    {
        return $this->proof;
    }

    /**
     * @return string
     */
    public function getHash(): string
    {
        return $this->hash;
    }

    /**
     * @param string $hash
     * @return Block
     */
    public function setHash(string $hash): Block
    {
        $this->hash = $hash;

        return $this;
    }

    /**
     * @return string
     */
    public function getPreviousHash(): string
    {
        return $this->previousHash;
    }

}
