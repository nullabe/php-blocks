<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Api;

use Nbe\PhpBlocks\Domain\Model\Entity\Transaction;

/**
 * Transaction interface
 */
interface TransactionInterface
{
    /**
     * Post Method, create new Transaction.
     *
     * @return mixed
     */
    public function postAction();

}
