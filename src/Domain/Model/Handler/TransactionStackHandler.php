<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Domain\Model\Handler;

use Nbe\PhpBlocks\Domain\Model\Entity\Blockchain;
use Nbe\PhpBlocks\Domain\Model\Entity\Transaction;
use Nbe\PhpBlocks\Domain\Model\Handler\Contract\TransactionStackHandlerInterface;

final class TransactionStackHandler implements TransactionStackHandlerInterface
{
    private $blockchain;

    public function __construct(Blockchain $blockchain)
    {
        $this->blockchain = $blockchain;
    }

    public function addTransactionToStack(Transaction $transaction): int
    {
        $this->blockchain->appendTransactionToStack($transaction);

        $nextIndex = $this->blockchain->getlastBlock()->getIndex() + 1;

        return $nextIndex;
    }

}
