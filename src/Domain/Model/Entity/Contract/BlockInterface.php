<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Domain\Model\Entity\Contract;

interface BlockInterface
{
    function getIndex(): int;

    function getTimestamp(): float;

    function getTransactions(): array;

    function getProof(): int;

    function getPreviousHash(): string;

}