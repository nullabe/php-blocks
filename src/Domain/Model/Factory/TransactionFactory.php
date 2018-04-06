<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Domain\Model\Factory;

use Nbe\PhpBlocks\Domain\Model\Entity\Address;
use Nbe\PhpBlocks\Domain\Model\Entity\Transaction;

final class TransactionFactory
{
    public function __invoke(string $sender_id, string $receiver_id, float $amount): Transaction
    {
        $sender = new Address($sender_id);
        $receiver = new Address($receiver_id);

        return new Transaction($sender, $receiver, $amount);
    }

}
