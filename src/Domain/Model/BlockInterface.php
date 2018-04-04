<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Domain\Model;

interface BlockInterface
{
    function getIndex(): int;

    function getTimestamp(): float;

    function getTransactions(): array;

    function getProof(): int;

    function getPreviousHash(): string;

}
