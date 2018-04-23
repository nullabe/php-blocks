<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Domain\Model\Entity;

/**
 * Transaction class
 */
final class Transaction
{
    /**
     * @var string
     */
    private $hash; 

    /**
     * @var Address
     */
    private $sender;

    /**
     * @var Address
     */
    private $receiver;

    /**
     * @var float
     */
    private $amount;

    /**
     * @var float
     */
    private $timestamp;

    /**
     * Custructor
     *
     * @param Address $sender
     * @param Address $receiver
     * @param float $amount
     */
    public function __construct(Address $sender, Address $receiver, float $amount)
    {
        $this->sender = $sender;
        $this->receiver = $receiver;
        $this->amount = $amount;

        $this->timestamp = microtime(TRUE);
        $this->hash = null;
    }

    /**
     * @return Address
     */
    public function getSender(): Address
    {
        return $this->sender;
    }

    /**
     * @return Address
     */
    public function getReceiver(): Address
    {
        return $this->receiver;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return float
     */
    public function getTimestamp(): float
    {
        return $this->timestamp;
    }

    /**
     * @return string
     */
    public function getHash(): string
    {
        return $this->hash;
    }

    /**
     * @param string $hash
     * @return Transaction
     */
    public function setHash(string $hash): Transaction
    {
        $this->hash = $hash;

        return $this;
    }

}
