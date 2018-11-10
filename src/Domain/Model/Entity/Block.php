<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Domain\Model\Entity;

use Nbe\PhpBlocks\Domain\Config\ProofOfWork;
use Nbe\PhpBlocks\Domain\Config\GenesisBlock;

/**
 * Class Block
 *
 * @package Nbe\PhpBlocks\Domain\Model\Entity
 */
class Block
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
    private $proof = GenesisBlock::PROOF;

    /**
     * @var string
     */
    private $hash = GenesisBlock::HASH;

    /**
     * @var string
     */
    private $previousHash;

    /**
     * Block constructor.
     * @param int $index
     * @param array $transactions
     * @param string $previousHash
     * @param float|null $timestamp
     */
    public function __construct(int $index, array $transactions, string $previousHash, float $timestamp = null)
    {
        $this->index = $index;
        $this->transactions = $transactions;
        $this->previousHash = $previousHash;

        $this->timestamp = $timestamp ?? microtime(true);
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
     * @param int $proof
     *
     * @return \Nbe\PhpBlocks\Domain\Model\Entity\Block
     */
    public function setProof(int $proof): Block
    {
        $this->proof = $proof;

        return $this;
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
     *
     * @return \Nbe\PhpBlocks\Domain\Model\Entity\Block
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

    /**
     * @return string
     */
    public function getHeader(): string
    {
        return (string)$this->getTimestamp() . $this->getIndex() . ProofOfWork::DIFFICULTY;
    }

}
