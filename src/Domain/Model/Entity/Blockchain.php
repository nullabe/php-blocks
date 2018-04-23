<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Domain\Model\Entity;

final class Blockchain
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

    public static function getInstance(): Blockchain
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

    public function getLastBlock(): Block
    {
        return $this->lastBlock;
    }

    public function appendBlockToChain(Block $block): Block
    {
        array_push($this->chain, $block);
        $this->lastBlock = $block;

        return $block;
    }

    public function appendTransactionToStack(Transaction $transaction): Transaction
    {
        array_push($this->transactionStack, $transaction);

        return $transaction;
    }

    public function resetTransactionStack(): Blockchain
    {
        $this->transactionStack = [];

        return $this;
    }

}
