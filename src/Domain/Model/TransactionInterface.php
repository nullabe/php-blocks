<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Domain\Model;

interface TransactionInterface
{
    function getSender(): AddressInterface;

    function getReceiver(): AddressInterface;

    function getAmount(): float;

    function getTimestamp(): float;

}
