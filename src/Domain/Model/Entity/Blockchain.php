<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Domain\Model\Entity;

use Nbe\PhpBlocks\Domain\Config\GenesisBlock;

/**
 * Blockchain class
 */
final class Blockchain
{
    /**
     * Unique instance of the chain
     * 
     * @var Blockchain
     */
    private static $instance;

    /**
     * Collection of all blocks of the chain
     * 
     * @var array
     */
    private $chain;

    /**
     * Collection of transactions that will be added on the new block
     *
     * @var array
     */
    private $transactionStack;

    /**
     * @var Block
     */
    private $lastBlock;

    /**
     * Constructor
     */
    private function __construct()
    {
        $this->chain = [];
        $this->transactionStack = [];

        $genesisBlock = new Block(GenesisBlock::INDEX, $this->transactionStack, GenesisBlock::PROOF, GenesisBlock::PREVIOUS_HASH);
        $genesisBlock = $genesisBlock->setHash(GenesisBlock::HASH);

        $this->appendBlockToChain($genesisBlock);
    }

    /**
     * Return unique blockchain's instance
     * 
     * @return Blockchain
     */
    public static function getInstance(): Blockchain
    {
        if(!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @return array
     */
    public function getChain(): array
    {
        return $this->chain;
    }

    /**
     * @return array
     */
    public function getTransactionStack(): array
    {
        return $this->transactionStack;
    }

    /**
     * @return Block
     */
    public function getLastBlock(): Block
    {
        return $this->lastBlock;
    }

    /**
     * @param Block $block
     * @return Block
     */
    public function appendBlockToChain(Block $block): Block
    {
        if ($block->getHash() !== '') {
            array_push($this->chain, $block);
            $this->lastBlock = $block;
        }
        
        return $block;
    }

    /**
     * @param Transaction $transaction
     * @return Transaction
     */
    public function appendTransactionToStack(Transaction $transaction): Transaction
    {
        array_push($this->transactionStack, $transaction);

        return $transaction;
    }

    /**
     * @return Blockchain
     */
    public function resetTransactionStack(): Blockchain
    {
        $this->transactionStack = [];

        return $this;
    }

    /**
     * @return integer
     */
    public function getNextIndex(): int
    {
        $nextIndex = $this->getLastBlock()->getIndex() + 1;

        return $nextIndex;
    }

}
