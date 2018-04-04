<?php
declare(strict_types=1);

namespace Nullabe\PhpBlocks\Domain\Model\Contract;

interface TransactionInterface
{
    function getSender(): AddressInterface;

    function getReceiver(): AddressInterface;

    function getAmount(): float;

    function getTimestamp(): float;

}
