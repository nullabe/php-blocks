<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Domain\Model\Entity;

final class Transaction
{
    public $sender;

    public $receiver;

    public $amount;

    public $timestamp;

    public function __construct(Address $sender, Address $receiver, float $amount)
    {
        $this->sender = $sender;
        $this->receiver = $receiver;
        $this->amount = $amount;

        $this->timestamp = microtime(TRUE);
    }

    function getSender(): Address
    {
        return $this->sender;
    }

    function getReceiver(): Address
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
