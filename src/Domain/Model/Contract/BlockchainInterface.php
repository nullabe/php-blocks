<?php
declare(strict_types=1);

namespace Nullabe\PhpBlocks\Domain\Model\Contract;

interface BlockchainInterface
{
    static function getInstance(): BlockchainInterface;

    function getChain(): array;

    function getTransactionStack(): array;

    function getLastBlock(): ? BlockInterface;

    function addNewBlockToChain($block = null): BlockchainInterface;

    function addTransactionToStack($transaction): BlockchainInterface;

    static function hashBlock(): string;

}
