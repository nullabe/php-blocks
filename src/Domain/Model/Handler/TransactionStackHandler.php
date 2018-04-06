<?php

namespace Nbe\PhpBlocks\Domain\Model\Handler;

use Nbe\PhpBlocks\Domain\Model\Entity\Contract\BlockchainInterface;
use Nbe\PhpBlocks\Domain\Model\Entity\Contract\TransactionInterface;
use Nbe\PhpBlocks\Domain\Model\Handler\Contract\TransactionStackHandlerInterface;

final class TransactionStackHandler implements TransactionStackHandlerInterface
{
    private $blockchain;

    public function __construct(BlockchainInterface $blockchain)
    {
        $this->blockchain = $blockchain;
    }

    public function addTransactionToStack(TransactionInterface $transaction): int
    {
        $this->blockchain->appendTransactionToStack($transaction);

        $nextIndex = $this->blockchain->getlastBlock()->getIndex() + 1;

        return $nextIndex;
    }

}
