<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Domain\Model\Entity;

use Nbe\PhpBlocks\Domain\Model\Entity\Contract\BlockchainInterface;
use Nbe\PhpBlocks\Domain\Model\Entity\Contract\BlockInterface;
use Nbe\PhpBlocks\Domain\Model\Entity\Contract\TransactionInterface;

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

        $genesisBlock = new Block(1, [], 100, "1");
        $this->appendBlockToChain($genesisBlock);
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

    public function getLastBlock(): BlockInterface
    {
        return $this->lastBlock;
    }

    public function appendBlockToChain(BlockInterface $block): BlockInterface
    {
        array_push($this->chain, $block);
        $this->lastBlock = $block;

        return $block;
    }

    public function appendTransactionToStack(TransactionInterface $transaction): TransactionInterface
    {
        array_push($this->transactionStack, $transaction);

        return $transaction;
    }

    public function resetTransactionStack(): BlockchainInterface
    {
        $this->transactionStack = [];

        return $this;
    }

}
