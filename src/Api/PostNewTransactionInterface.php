<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Api;

use Nbe\PhpBlocks\Domain\Model\Entity\Transaction;

interface PostNewTransactionInterface
{
    public function postNewTransaction(): Transaction;

}
