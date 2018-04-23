<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Domain\Model\Entity;

final class Block
{
    public $index;

    public $timestamp;

    public $transactions;

    public $proof;

    public $previousHash;

    public function __construct(int $index, array $transactions, $proof, $previousHash)
    {
        $this->index = $index;
        $this->transactions = $transactions;
        $this->proof = $proof;
        $this->previousHash = $previousHash;

        $this->timestamp = microtime(TRUE);
    }


    public function getIndex(): int
    {
        return $this->index;
    }

    public function getTimestamp(): float
    {
        return $this->timestamp;
    }

    public function getTransactions(): array
    {
        return $this->transactions;
    }

    public function getProof(): int
    {
        return $this->proof;
    }

    public function getPreviousHash(): string
    {
        return $this->previousHash;
    }

}
