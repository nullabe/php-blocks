<?php

namespace Nullabe\PhpBlocks\Domain\Model;

class TransactionFactory
{
    public function __invoke(string $sender_id, string $receiver_id, float $amount)
    {
        $sender = new Address($sender_id);
        $receiver = new Address($receiver_id);

        return new Transaction($sender, $receiver, $amount);
    }

}
