<?php
declare(strict_types=1);

namespace Nbe\PhpBlocks\Domain\Model\Entity\Contract;

interface BlockchainInterface
{
    static function getInstance(): BlockchainInterface;

    function getChain(): array;

    function getTransactionStack(): array;

    function getLastBlock(): BlockInterface;

    function addNewBlockToChain(int $proof, string $previousHash = NULL): BlockInterface;

    function addTransactionToStack($transaction): int;

    static function hashBlock(BlockInterface $block): string;

}
