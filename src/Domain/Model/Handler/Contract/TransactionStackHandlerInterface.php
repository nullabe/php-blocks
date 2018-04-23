<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Domain\Model\Handler\Contract;

use Nbe\PhpBlocks\Domain\Model\Entity\Transaction;

interface TransactionStackHandlerInterface
{
    public function addTransactionToStack(Transaction $transaction): int;

}
