<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Domain\Model\Handler\Contract;

use Nbe\PhpBlocks\Domain\Model\Entity\Transaction;

/**
 * Interface TransactionStackHandlerInterface
 *
 * @package Nbe\PhpBlocks\Domain\Model\Handler\Contract
 */
interface TransactionStackHandlerInterface
{

    /**
     * @param \Nbe\PhpBlocks\Domain\Model\Entity\Transaction $transaction
     *
     * @return int
     */
    public function addTransactionToStack(Transaction $transaction): int;

}
