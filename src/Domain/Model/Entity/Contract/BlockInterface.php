<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Domain\Model\Entity\Contract;

interface BlockInterface
{
    public function getIndex(): int;

    public function getTimestamp(): float;

    public function getTransactions(): array;

    public function getProof(): int;

    public function getPreviousHash(): string;

}
