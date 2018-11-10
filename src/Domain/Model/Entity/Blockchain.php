<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Domain\Model\Entity;

use Nbe\PhpBlocks\Domain\Config\GenesisBlock;
use Nbe\PhpBlocks\Domain\Model\State\BlockchainState;
use Nbe\PhpBlocks\Domain\Model\ValueObject\Uuid;

/**
 * Class Blockchain
 *
 * @package Nbe\PhpBlocks\Domain\Model\Entity
 */
class Blockchain
{
    use Uuid;

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
     * Blockchain constructor.
     */
    private function __construct()
    {
        $this->chain = [];
        $this->transactionStack = [];
        $this->uuid();

        $genesisBlock = new Block(GenesisBlock::INDEX, $this->transactionStack, GenesisBlock::PREVIOUS_HASH);

        $this->appendBlockToChain($genesisBlock);
    }

    /**
     * @param BlockchainState $state
     * @return Blockchain
     */
    public static function getInstance(BlockchainState $state = null): Blockchain
    {
        if (isset($state)) {
            self::$instance = self::buildInstanceFromState($state);
        }

        if(!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @param BlockchainState $state
     * @return Blockchain
     */
    private static function buildInstanceFromState(BlockchainState $state): Blockchain
    {
        $blockchain = new self();

        $blockchain->chain = $state['chain'];
        $blockchain->uuid = $state['uuid'];
        $blockchain->lastBlock = end($state['uuid']);
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
     * @return \Nbe\PhpBlocks\Domain\Model\Entity\Block
     */
    public function getLastBlock(): Block
    {
        return $this->lastBlock;
    }

    /**
     * @param \Nbe\PhpBlocks\Domain\Model\Entity\Block $block
     *
     * @return \Nbe\PhpBlocks\Domain\Model\Entity\Block
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
     * @param \Nbe\PhpBlocks\Domain\Model\Entity\Transaction $transaction
     *
     * @return \Nbe\PhpBlocks\Domain\Model\Entity\Transaction
     */
    public function appendTransactionToStack(Transaction $transaction): Transaction
    {
        array_push($this->transactionStack, $transaction);

        return $transaction;
    }

    /**
     * @return \Nbe\PhpBlocks\Domain\Model\Entity\Blockchain
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
