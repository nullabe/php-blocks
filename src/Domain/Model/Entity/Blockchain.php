<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Domain\Model\Entity;

use Nbe\PhpBlocks\Domain\Config\GenesisBlock;
use Nbe\PhpBlocks\Domain\Model\Normalizer\BlockNormalizer;
use Nbe\PhpBlocks\Domain\Model\Normalizer\TransactionNormalizer;
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
     * @param BlockchainState|null $state
     * @return Blockchain
     * @throws \Nbe\PhpBlocks\Domain\Exception\BlockDenormalizeException
     * @throws \Nbe\PhpBlocks\Domain\Exception\TransactionDenormalizeException
     */
    public static function getInstance(BlockchainState $state = null): Blockchain
    {
        if (isset($state)) {
            self::$instance = self::buildInstanceFromState($state->getState());
        }

        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @param array $state
     * @return Blockchain
     * @throws \Nbe\PhpBlocks\Domain\Exception\BlockDenormalizeException
     * @throws \Nbe\PhpBlocks\Domain\Exception\TransactionDenormalizeException
     */
    private static function buildInstanceFromState(array $state): Blockchain
    {
        $blockchain = new self();

        foreach ($state['chain'] as $block) {
            $chain[] = BlockNormalizer::denormalize($block);
        }
        foreach ($state['transactionStack'] as $transaction) {
            $transactions[] = TransactionNormalizer::denormalize($transaction);
        }

        $blockchain->uuid = $state['uuid'];
        $blockchain->chain = $chain ?? [];
        $blockchain->transactionStack = $transactions ?? [];
        $blockchain->lastBlock = BlockNormalizer::denormalize($state['lastBlock']);

        return $blockchain;
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
