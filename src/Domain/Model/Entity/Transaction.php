<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Domain\Model\Entity;

use Nbe\PhpBlocks\Domain\Config\Hash;

/**
 * Class Transaction
 *
 * @package Nbe\PhpBlocks\Domain\Model\Entity
 */
class Transaction
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
     * Transaction constructor.
     * @param Address $sender
     * @param Address $receiver
     * @param float $amount
     * @param float $timestamp
     */
    public function __construct(Address $sender, Address $receiver, float $amount, float $timestamp = null)
    {
        $this->sender = $sender;
        $this->receiver = $receiver;
        $this->amount = $amount;

        $this->timestamp = $timestamp ?? microtime(true);

        $this->hash = \hash(Hash::ALGO, microtime() . $timestamp . $sender->getHash() . $receiver->getHash() . $amount);
    }

    /**
     * @return \Nbe\PhpBlocks\Domain\Model\Entity\Address
     */
    public function getSender(): Address
    {
        return $this->sender;
    }

    /**
     * @return \Nbe\PhpBlocks\Domain\Model\Entity\Address
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
     *
     * @return \Nbe\PhpBlocks\Domain\Model\Entity\Transaction
     */
    public function setHash(string $hash): Transaction
    {
        $this->hash = $hash;

        return $this;
    }

}
