<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Api;

use Nbe\PhpBlocks\Domain\Model\Entity\Contract\TransactionInterface;

interface PostNewTransactionInterface
{
    public function postNewTransaction(): TransactionInterface;

}
