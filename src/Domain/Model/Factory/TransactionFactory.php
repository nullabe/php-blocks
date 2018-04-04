<?php

namespace Nullabe\PhpBlocks\Domain\Model\Factory;

use Nullabe\PhpBlocks\Domain\Model\Address;
use Nullabe\PhpBlocks\Domain\Model\Transaction;

class TransactionFactory
{
    public function __invoke(string $sender_id, string $receiver_id, float $amount): Transaction
    {
        $sender = new Address($sender_id);
        $receiver = new Address($receiver_id);

        return new Transaction($sender, $receiver, $amount);
    }

}
