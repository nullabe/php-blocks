<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Domain\Model\Handler;

use Nbe\PhpBlocks\Domain\Model\Entity\Blockchain;
use Nbe\PhpBlocks\Domain\Model\Entity\Transaction;
use Nbe\PhpBlocks\Domain\Model\Handler\Contract\TransactionStackHandlerInterface;

/**
 * Class TransactionStackHandler
 *
 * @package Nbe\PhpBlocks\Domain\Model\Handler
 */
final class TransactionStackHandler implements TransactionStackHandlerInterface
{

    /**
     * @var \Nbe\PhpBlocks\Domain\Model\Entity\Blockchain
     */
    private $blockchain;

    /**
     * TransactionStackHandler constructor.
     *
     * @param \Nbe\PhpBlocks\Domain\Model\Entity\Blockchain $blockchain
     */
    public function __construct(Blockchain $blockchain)
    {
        $this->blockchain = $blockchain;
    }

    /**
     * @param \Nbe\PhpBlocks\Domain\Model\Entity\Transaction $transaction
     *
     * @return int
     */
    public function addTransactionToStack(Transaction $transaction): int
    {
        $this->blockchain->appendTransactionToStack($transaction);

        $nextIndex = $this->blockchain->getNextIndex();

        return $nextIndex;
    }

}
