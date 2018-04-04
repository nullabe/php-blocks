<?php
declare(strict_types=1);

namespace Nullabe\PhpBlocks\Domain\Model;

interface BlockchainInterface
{
    static function getInstance(): BlockchainInterface;

    function getChain(): array;

    function getTransactionStack(): array;

    function getLastBlock(): BlockInterface;

    function addNewBlockToChain(): BlockchainInterface;

    function addTransactionToStack($transaction): BlockchainInterface;

    static function hashBlock(): string;

}
