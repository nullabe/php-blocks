<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Domain\Model\Entity;

use Nbe\PhpBlocks\Domain\Model\Entity\Contract\BlockInterface;

final class Block implements BlockInterface
{
    private $index;

    private $timestamp;

    private $transactions;

    private $proof;

    private $previousHash;

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