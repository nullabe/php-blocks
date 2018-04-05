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

    public function addNewBlockToChain(int $proof, string $previousHash = NULL): BlockInterface
    {
        $previousHash = $previousHash ?? self::hash();
        $block = new Block(count($this->getChain()) + 1, $this->getTransactionStack(), $proof, $previousHash);

        array_push($this->chain, $block);
        $this->transactionStack = [];

        $this->lastBlock = $block;
        
        return $this->lastBlock;
    }

    public function addTransactionToStack($transaction): int
    {
        array_push($this->transactionStack, $transaction);

        $nextIndex = ($this->lastBlock instanceof Block) ? $this->lastBlock->getIndex() + 1 : 0;

        return $nextIndex;
    }

    public static function hash(): string
    {
        return "";
    }

}