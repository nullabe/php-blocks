<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Domain\Model\Entity;

use Nbe\PhpBlocks\Domain\Model\Entity\Contract\BlockchainInterface;
use Nbe\PhpBlocks\Domain\Model\Entity\Contract\BlockInterface;

final class Blockchain implements BlockchainInterface
{
    private static $instance;

    private $chain;

    private $transactionStack;

    private $lastBlock;

    private function __construct()
    {
        $this->chain = [];
        $this->transactionStack = [];
    }

    public static function getInstance(): BlockchainInterface
    {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getChain(): array
    {
        return $this->chain;
    }

    public function getTransactionStack(): array
    {
        return $this->transactionStack;
    }

    public function getLastBlock(): ? BlockInterface
    {
        return $this->lastBlock;
    }

    public function addNewBlockToChain($block = null): BlockchainInterface
    {
        $block = $block ?? new Block();

        array_push($this->chain, $block);

        $this->lastBlock = $block;

        return $this;
    }

    public function addTransactionToStack($transaction): int
    {
        array_push($this->transactionStack, $transaction);

        $nextIndex = ($this->lastBlock instanceof Block) ? $this->lastBlock->getIndex() + 1 : 0;

        return $nextIndex;
    }

    public static function hashBlock(): string
    {
        // TODO: Implement hashBlock() method.
    }

}