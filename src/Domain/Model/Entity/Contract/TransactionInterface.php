<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Domain\Model\Entity\Contract;

interface TransactionInterface
{
    public function getSender(): AddressInterface;

    public function getReceiver(): AddressInterface;

    public function getAmount(): float;

    public function getTimestamp(): float;

}
