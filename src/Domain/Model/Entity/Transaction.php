<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Domain\Model\Entity;

use Nbe\PhpBlocks\Domain\Model\Entity\Contract\AddressInterface;
use Nbe\PhpBlocks\Domain\Model\Entity\Contract\TransactionInterface;

final class Transaction implements TransactionInterface
{
    private $sender;

    private $receiver;

    private $amount;

    private $timestamp;

    public function __construct(AddressInterface $sender, AddressInterface $receiver, float $amount)
    {
        $this->sender = $sender;
        $this->receiver = $receiver;
        $this->amount = $amount;

        $this->timestamp = microtime(TRUE);
    }

    function getSender(): AddressInterface
    {
        return $this->sender;
    }

    function getReceiver(): AddressInterface
    {
        return $this->receiver;
    }

    function getAmount(): float
    {
        return $this->amount;
    }

    function getTimestamp(): float
    {
        return $this->timestamp;
    }

}