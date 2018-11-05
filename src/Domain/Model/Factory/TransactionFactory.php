<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Domain\Model\Factory;

use Nbe\PhpBlocks\Domain\Model\Entity\Address;
use Nbe\PhpBlocks\Domain\Model\Entity\Transaction;

/**
 * Class TransactionFactory
 *
 * @package Nbe\PhpBlocks\Domain\Model\Factory
 */
final class TransactionFactory
{

    /**
     * @param string $sender_hash
     * @param string $receiver_hash
     * @param float $amount
     *
     * @return \Nbe\PhpBlocks\Domain\Model\Entity\Transaction
     */
    public function __invoke(string $sender_hash, string $receiver_hash, float $amount): Transaction
    {
        $sender = new Address($sender_hash);
        $receiver = new Address($receiver_hash);

        return new Transaction($sender, $receiver, $amount);
    }

}
