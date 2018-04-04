<?php
declare(strict_types=1);

namespace Nullabe\PhpBlocks\Domain\Model;

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
        $this->lastBlock = new Block();
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

    public function addNewBlockToChain(): BlockchainInterface
    {
        array_push($this->chain, new Block());

        return $this;
    }

    public function addTransactionToStack($transaction): BlockchainInterface
    {
        array_push($this->transactionStack, $transaction);

        return $this;
    }

    public static function hashBlock(): string
    {
        // TODO: Implement hashBlock() method.
    }

}